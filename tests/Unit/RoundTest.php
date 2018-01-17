<?php

namespace Tests\Unit;

use App\Round;
use Tests\TestCase;

class RoundTest extends TestCase
{

    /**
     * @test
     */
    public function it_can_list_games() {
        $result = Round::getListOfGames();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $result);
        foreach ($result as $key => $value) {
            $this->assertInternalType("integer", $key);
            $this->assertInternalType("string", $value);
        }
    }
}