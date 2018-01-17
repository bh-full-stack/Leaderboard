<?php

namespace App\Http\Controllers;

use App\Mail\SignUpActivation;
use App\Player;
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
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //dd("hello");

        $player = new Player();
        $player->nick = $request->input('nick');
        $player->email = $request->input('email');
        $player->password_hash = Hash::make($request->input('password'));
        $player->save();

        Mail::to(["email" => "leaderboard@mailinator.com"])
            ->send(new SignUpActivation($player));

        return view('sign-up');
    }
}