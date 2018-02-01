<?php
namespace App\Http\Controllers\Auth;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class LoginController extends Controller
{
    private $player;

    public function __construct()
    {
        $this->player = new Player();
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid email or password!',
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create token!',
            ], 500);
        }
        return response()->json([
            'token' => $token,
            'player' => Auth::user()
        ]);
    }
}