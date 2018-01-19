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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('profile');
    }

    public function handleOldScores(Request $request) {
        if (!Hash::check($request->post("password"), Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => ['Wrong password!'],
            ]);
        }
        if ($request->post("old-scores-action") == "delete") {
            $playerId = Auth::user()->id;
            $playerActivatedAt = Auth::user()->activated_at;
            Round::where("player_id", "=", $playerId)
                ->where("created_at", "<", $playerActivatedAt)->delete();
        }
    }
}