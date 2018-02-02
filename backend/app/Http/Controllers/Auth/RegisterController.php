<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SignUpActivation;
use App\Player;
use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            'password' => 'required|min:6'
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
        $this->validator($request['player'])->validate();

        $player = Player::getByName($request['player']['name']);
        $nameExists = $player->exists;
        $emailMatches = ($player->email == $request->email);
        $emailExists = (Player::where("email", "=", $request->email)->count() > 0);
        $emailIsNull = is_null($player->email);

        if ($nameExists) {
            if ($emailMatches) {
                $player = $this->update($player, $request['player']);
            } else {
                if ($emailExists) {
                    throw ValidationException::withMessages([
                        'email' => ['This email is already in use!'],
                    ]);
                } else {
                    if ($emailIsNull) {
                        $player = $this->update($player, $request['player']);
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
                $player = $this->create($request['player']);
            }
        }

        if (!is_null($request['introduction'])) {
            $profile = new Profile();
            $profile->introduction = $request['introduction'];
            $profile->save();
            $player->profile_id = $profile->id;
            $player->save();
        }

        Mail::to(["email" => $player->email])->send(new SignUpActivation($player));
        event(new Registered($player));

        return $player;
    }

    public function activate(Request $request) {
        if (empty($request->activation_code)) {
            throw new HttpException(400, "Activation failed: activation code is missing");
        }
        $player = Player::where("activation_code", "=", $request->activation_code)->first();
        if (!$player) {
            throw new HttpException(404, "Activation failed: wrong activation code");
        }
        if ($player->activated_at) {
            throw new HttpException(410, "Activation failed: already activated");
        }
        $player->activate();
        return $player;
    }
}