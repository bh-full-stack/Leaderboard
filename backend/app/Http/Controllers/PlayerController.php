<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function __construct() {
        //
    }

    public function getPlayerByName(Request $request) {
        return Player::getByName($request->name);
    }
}