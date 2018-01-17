<?php

namespace Tests\Feature;

use App\Http\Controllers\SignUpController;
use App\Player;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class SignUpControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_can_show_sign_up_page() {
        $response = $this->get("/sign-up");
        $response->assertStatus(200);
        $response->assertSeeText("Sign Up");
        $response->assertSeeText("Password");
    }

    /**
     * @test
     */
    public function it_can_save_new_player() {
        Session::start();

        $player = factory(Player::class)->make();
        $response = $this->post(
            "/sign-up",
            [
                "nick" => $player->nick,
                "email" => $player->email,
                "password" => "secret",
                "_token" => csrf_token()
            ]
        );
        $response->assertStatus(200);

        $newPlayer = Player::where("nick", "=", $player->nick)->first();
        $this->assertNotEmpty($newPlayer->id);
        $this->assertEquals($player->nick, $newPlayer->nick);
        $this->assertEquals($player->email, $newPlayer->email);
        $this->assertTrue(Hash::check("secret", $newPlayer->password_hash));
    }
}