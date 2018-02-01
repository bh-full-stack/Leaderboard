<?php

namespace Tests\Feature;

use App\Player;
use App\Round;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_can_delete_old_scores()
    {
        $player = factory(Player::class)->create();
        $this->actingAs($player);
        factory(Round::class, 5)->create(["player_id" => $player->id]);
        $player->activate();

        $this->assertAuthenticatedAs($player);
        $token = JWTAuth::fromUser($player);

        $this->post(
            "api/profile/handle-old-scores",
            [
                "old-scores-action" => "delete",
                "password" => "secret"
            ],
            [
                "Authorization" => "Bearer $token"
            ]
        );

        $this->assertEquals(0, $player->rounds()->count());
    }

    /**
     * @test
     */
    public function it_can_keep_old_scores()
    {
        $player = factory(Player::class)->create();
        $this->actingAs($player);
        factory(Round::class, 5)->create(["player_id" => $player->id]);
        $player->activate();

        $this->assertAuthenticatedAs($player);

        $this->post("/profile", ["old-scores-action" => "keep", "password" => "secret"]);

        $this->assertEquals(5, $player->rounds()->count());
    }
}
