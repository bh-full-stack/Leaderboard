<?php

namespace App\Http\Controllers;

use App\Mail\SignUpActivation;
use App\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SignUpController extends Controller
{
    public function index() {
        return view('sign-up');
    }

    public function store(Request $request) {
        $request->validate([
            'nick' => 'required|unique:players',
            'email' => 'required|email|unique:players',
            'password' => 'required|min:6'
        ]);

        $player = new Player();
        $player->nick = $request->input('nick');
        $player->email = $request->input('email');
        $player->password_hash = Hash::make($request->input('password'));
        $player->activation_code = rand(1000000, 9999999);
        $player->save();

        Mail::to(["email" => $player->email])
            ->send(new SignUpActivation($player));

        return view('sign-up');
    }

    public function activate($activation_code) {
        $player = Player::where("activation_code", "=", $activation_code)->first();
        if ($player) {
            $player->activated_at = Carbon::now();
            $player->save();

            return view("activation-success", ["player" => $player]);
        } else {
            return view("activation-failure");
        }
    }
}