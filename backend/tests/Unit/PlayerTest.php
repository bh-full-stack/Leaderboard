<?php

namespace Tests\Unit;

use App\Player;
use App\Round;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_can_use_fakers() {
        $player = factory(Player::class)->make();
        $this->assertInstanceOf(Player::class, $player);
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

    /**
     * @test
     */
    public function it_can_activate_itself_with_old_rounds() {
        $player = factory(Player::class)->create();
        factory(Round::class, 5)->create(["player_id" => $player->id]);

        $player->activate();

        $this->assertNotEmpty($player->activated_at);
        $this->assertTrue($player->has_deletable_rounds);
    }

    /**
     * @test
     */
    public function it_can_activate_itself_without_old_rounds() {
        $player = factory(Player::class)->create();

        $player->activate();

        $this->assertNotEmpty($player->activated_at);
        $this->assertFalse($player->has_deletable_rounds);
    }

    /**
     * @test
     * @expectedException \PDOException
     */
    public function its_name_is_case_insensitive() {
        $player = new Player;
        $player->name = "Nemecsek Ernő";
        $player->email = "nemecsekerno@example.com";
        $this->assertTrue($player->save());

        $player = new Player;
        $player->name = "nemecsek ernő";
        $player->email = "nemecsekerno@example.com";
        $this->assertFalse($player->save());
    }

    /**
     * @test
     * @expectedException \PDOException
     */
    public function its_email_is_case_insensitive() {
        $player = new Player;
        $player->name = "Nemecsek Ernő";
        $player->email = "nemecsekerno@example.com";
        $this->assertTrue($player->save());

        $player = new Player;
        $player->name = "Nemecsek Ernő";
        $player->email = "NemecsekErno@example.com";
        $this->assertFalse($player->save());
    }
}