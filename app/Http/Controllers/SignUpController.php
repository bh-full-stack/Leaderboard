<?php

namespace App\Http\Controllers;

use App\Mail\SignUpActivation;
use App\Player;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SignUpController extends Controller
{
    public function index() {
        dd('signuocont');
        return view('sign-up');
    }

    public function store(Request $request) {
        dd('signuocont');

        $request->validate([
            'name' => 'required|unique:players|max:255',
            'email' => 'required|email|unique:players|max:255',
            'password' => 'required|min:6|max:255'
        ]);

        $player = new Player();
        $player->name = $request->input('name');
        $player->email = $request->input('email');
        $player->password = bcrypt($request->input('password'));
        $player->activation_code = rand(1000000, 9999999);
        $player->save();

        Mail::to(["email" => $player->email])
            ->send(new SignUpActivation($player));

        return view('sign-up');
    }

    public function activate($activation_code) {
        dd('signuocont');

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
        dd('signuocont');

        if ($request->post("action") == "delete") {

        }
    }
}