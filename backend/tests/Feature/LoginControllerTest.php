<?php

namespace Tests\Feature;

use App\Player;
use App\Profile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_can_log_in_a_user()
    {
        Mail::fake();

        $player = factory(Player::class)->make();
        $this->post(
            "api/register",
            [
                "player" => [
                    "name" => $player->name,
                    "email" => $player->email,
                    "password" => "secret"
                ]
            ]
        );

        $player = Player::getByName($player->name);
        $player->activation_code = 1234567;
        $player->save();

        $this->post("api/register/activate", ["activation_code" => $player->activation_code]);

        $player = $player->fresh();
        $this->post(
            "api/login",
            [
                "email" => $player->email,
                "password" => "secret"
            ]
        );
        $this->assertEquals($player, Auth::user());
    }

    /**
     * @test
     */
    public function it_rejects_login_attempts_with_invalid_credentials()
    {
        Session::start();
        Mail::fake();

        $player = factory(Player::class)->make();
        $this->post(
            "/register",
            [
                "name" => $player->name,
                "email" => $player->email,
                "password" => "secret",
                "password_confirmation" => "secret",
                "_token" => csrf_token()
            ]
        );

        $profile = new Profile();
        $profile->save();

        $player = Player::getByName($player->name);
        $player->activation_code = 1234567;
        $player->profile_id = $profile->id;
        $player->save();

        $this->get("/register/activation/1234567");

        $this->post(
            "/login",
            [
                "email" => "invalid email",
                "password" => "invalid password"
            ]
        );
        $this->assertNull(Auth::user());
    }

    /**
     * @test
     */
    public function it_rejects_unactivated_login_attempts()
    {

        Session::start();
        Mail::fake();

        $player = factory(Player::class)->make();
        $this->post(
            "/register",
            [
                "name" => $player->name,
                "email" => $player->email,
                "password" => "secret",
                "password_confirmation" => "secret",
                "_token" => csrf_token()
            ]
        );
        $profile = new Profile();
        $profile->save();

        $player = Player::getByName($player->name);
        $player->activation_code = 1234567;
        $player->profile_id = $profile->id;
        $player->save();

        $this->post(
            "/login",
            [
                "email" => $player->email,
                "password" => "secret"
            ]
        );
        $this->assertNull(Auth::user());
    }
}
