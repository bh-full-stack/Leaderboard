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
        $this->assertNotEmpty($newPlayer->activation_code);
    }

    /**
     * @test
     */
    public function it_can_activate_a_new_account() {
        $player = factory(Player::class)->make();
        $player->activation_code = 1234567;
        $player->save();

        $response = $this->get("/sign-up/activation/1234567");
        $response->assertStatus(200);
        $response->assertSeeText("your account has been activated!");

        $newPlayer = Player::find($player->id);
        $this->assertNotEmpty($newPlayer->activated_at);
    }

    /**
     * @test
     */
    public function it_can_handle_an_invalid_activation_code() {
        $response = $this->get("/sign-up/activation/1234567");
        $response->assertStatus(200);
        $response->assertSeeText("Invalid account!");
    }
}