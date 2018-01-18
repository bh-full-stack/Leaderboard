<?php

namespace Tests\Unit;

use App\Player;
use Tests\TestCase;

class PlayerTest extends TestCase
{

    /**
     * @test
     */
    public function it_can_use_fakers() {
        $player = factory(\App\Player::class)->make();
        $this->assertInstanceOf(\App\Player::class, $player);
    }

    /**
     * @test
     */
    public function it_can_list_top_players_by_game() {
        $actual = Player::listTopPlayersByGame();
        $this->assertCount(50, $actual);
        foreach ($actual as $actualItem) {
            $this->assertNotEmpty($actualItem->name);
            $this->assertNotEmpty($actualItem->game);
            $this->assertNotEmpty($actualItem->top_score);
            $this->assertNotEmpty($actualItem->number_of_rounds);
        }
    }
}