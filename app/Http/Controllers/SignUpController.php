<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function index() {
        return view('layout', [
            "page" => "sign-up"
        ]);
    }
    public function create(Request $request) {
        $request->validate([
            'nick' => 'required|unique:players',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $player = new Player();
        $player->nick = $request->input('nick');
        $player->email = $request->input('email');
        $player->password_hash = Hash::make($request->input('password'));
        $player->save();
        return view('layout', [
            "page" => "sign-up"
        ]);
    }
}