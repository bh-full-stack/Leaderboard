<?php

namespace App\Http\Controllers\Auth;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordChangeController extends Controller
{
    private $player;

    public function changePassword(Request $request) {
        $this->player = Player::find($request['player']['id']);

        if (!Hash::check($request['currentPassword'], $this->player->password)) {
            throw ValidationException::withMessages([
                'currentPassword' => ['Wrong password!'],
            ]);
        }

        $this->player->password = bcrypt($request['player']['password']);
        $this->player->save();

        return $this->player;
    }
}
