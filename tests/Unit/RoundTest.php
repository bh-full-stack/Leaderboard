<?php

namespace Tests\Unit;

use App\Round;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoundTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_list_games() {
        $result = Round::getListOfGames();
        $this->markTestIncomplete();
    }
}