<?php

namespace App\Http\Controllers;

use App\Player;
use App\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('profile', ["player" => Auth::user()]);
    }

    public function handleOldScores(Request $request) {
        $player = Auth::user();

        if (!Hash::check($request->post("password"), $player->password)) {
            throw ValidationException::withMessages([
                'password' => ['Wrong password!'],
            ]);
        }

        switch ($request->post("old-scores-action")) {
            case "delete":
                Round::where("player_id", "=", $player->id)
                    ->where("created_at", "<=", $player->activated_at)
                    ->delete();
                $message = "Old scores of this account have been deleted!";
                break;
            case "keep":
                $message = "Old scores of this account have been kept!";
                break;
        }
        $player->has_deletable_rounds = false;
        $player->save();
        return ["player" => $player, "message" => $message];
    }

    public function getPlayerByName(Request $request) {
        return Player::getByName($request->name);
    }
}