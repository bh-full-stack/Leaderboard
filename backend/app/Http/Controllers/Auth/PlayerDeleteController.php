<?php

namespace App\Http\Controllers\Auth;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PlayerDeleteController extends Controller
{
    public $player;

    public function deletePlayer(Request $request) {
        $this->player = Player::findOrFail($request['player']['id']);

        if (!Hash::check($request['player']['password'], $this->player->password)) {
            throw ValidationException::withMessages([
                'password' => ['Wrong password!'],
            ]);
        }

        $this->player->delete();
        return ['message' => 'Your account has been deleted.'];
    }
}
