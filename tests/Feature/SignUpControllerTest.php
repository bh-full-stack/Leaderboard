<?php

namespace Tests\Feature;

use App\Http\Controllers\SignUpController;
use App\Mail\SignUpActivation;
use App\Player;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
    public function it_can_sign_up_a_player() {
        Session::start();
        Mail::fake();

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
        $this->assertEquals(bcrypt("secret"), $newPlayer->password);
        $this->assertNotEmpty($newPlayer->activation_code);

        Mail::assertSent(SignUpActivation::class, function ($mail) use ($player) {
            return $mail->player->nick === $player->nick;
        });

        Mail::assertSent(SignUpActivation::class, function ($mail) use ($player) {
            return $mail->hasTo($player->email);
        });
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