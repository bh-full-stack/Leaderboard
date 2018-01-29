<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SignUpActivation;
use App\Player;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Player
     */
    protected function create(array $data)
    {
        $player = new Player();
        $player->name = $data['name'];
        $player->email = $data['email'];
        $player->password = bcrypt($data['password']);
        $player->activation_code = rand(1000000, 9999999);
        $player->save();
        return $player;
    }

    public function update($player, array $data) {
        $player->email = $data["email"];
        $player->password = bcrypt($data["password"]);
        $player->activation_code = rand(1000000, 9999999);
        $player->save();
        return $player;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $player = Player::getByName($request->name);
        $nameExists = $player->exists;
        $emailMatches = ($player->email == $request->email);
        $emailExists = (Player::where("email", "=", $request->email)->count() > 0);
        $emailIsNull = is_null($player->email);

        if ($nameExists) {
            if ($emailMatches) {
                $player = $this->update($player, $request->all());
            } else {
                if ($emailExists) {
                    throw ValidationException::withMessages([
                        'email' => ['This email is already in use!'],
                    ]);
                } else {
                    if ($emailIsNull) {
                        $player = $this->update($player, $request->all());
                    } else {
                        throw ValidationException::withMessages([
                            'name' => ['This name is already in use!'],
                        ]);
                    }
                }
            }
        } else {
            if ($emailExists) {
                throw ValidationException::withMessages([
                    'email' => ['This email is already in use!'],
                ]);
            } else {
                $player = $this->create($request->all());
            }
        }

        Mail::to(["email" => $player->email])->send(new SignUpActivation($player));
        event(new Registered($player));

        return $this->registered($request, $player) ?: redirect($this->redirectPath());
    }

    public function activate($activation_code) {
        $player = Player::where("activation_code", "=", $activation_code)->first();
        if ($player) {
            $player->activate();
            return view("activation-success", ["player" => $player]);
        } else {
            return view("activation-failure");
        }
    }
}