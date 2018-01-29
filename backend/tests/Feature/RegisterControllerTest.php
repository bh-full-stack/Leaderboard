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

class RegisterControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_can_show_sign_up_page() {
        $response = $this->get("/register");
        $response->assertStatus(200);
        $response->assertSeeText("Confirm password");
    }

    /**
     * @test
     */
    public function it_can_register_a_player() {
        Session::start();
        Mail::fake();

        $player = factory(Player::class)->make();
        $response = $this->post(
            "/register",
            [
                "name" => $player->name,
                "email" => $player->email,
                "password" => "secret",
                "password_confirmation" => "secret",
                "_token" => csrf_token()
            ]
        );
        $response->assertStatus(302);

        $newPlayer = Player::where("name", "=", $player->name)->first();
        $this->assertNotEmpty($newPlayer->id);
        $this->assertEquals($player->name, $newPlayer->name);
        $this->assertEquals($player->email, $newPlayer->email);
        $this->assertTrue(Hash::check("secret", $newPlayer->password));
        $this->assertNotEmpty($newPlayer->activation_code);

        Mail::assertSent(SignUpActivation::class, function ($mail) use ($player) {
            return $mail->player->name === $player->name;
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

        $response = $this->get("/register/activation/1234567");
        $response->assertStatus(200);
        $response->assertSeeText("your account has been activated!");

        $newPlayer = Player::find($player->id);
        $this->assertNotEmpty($newPlayer->activated_at);
    }

    /**
     * @test
     */
    public function it_can_handle_an_invalid_activation_code() {
        $response = $this->get("/register/activation/1234567");
        $response->assertStatus(200);
        $response->assertSeeText("Invalid account!");
    }
}