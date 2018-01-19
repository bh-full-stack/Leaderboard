<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SignUpActivation;
use App\Player;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'name' => 'required|unique:players|max:255',
            'email' => 'required|email|unique:players',
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

        Mail::to(["email" => $player->email])
            ->send(new SignUpActivation($player));

        return $player;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    public function activate($activation_code) {
        $player = Player::where("activation_code", "=", $activation_code)->first();
        if ($player) {
            $player->activated_at = Carbon::now();
            $player->save();
            $roundCount = $player->rounds()->count();

            return view(
                "activation-success",
                [
                    "player" => $player,
                    "roundCount" => $roundCount
                ]
            );
        } else {
            return view("activation-failure");
        }
    }

    public function handleOldScores(Request $request) {
        if ($request->post("action") == "delete") {

        }
    }
}
