<?php

class RoundTest extends \PHPUnit\Framework\TestCase
{
    public function setUp() {
        require "../autoload.php";
    }

    /**
     * @test
     */
    public function it_can_set_itself_through_magic_method()
    {
        $round = new \App\Model\Round();
        $round->id = 4;
        $round->game = "Tetris";
        $round->score = 500;
        $round->location_id = 2;
        $round->player_id = 3;
        $round->time = "1000";

        $this->assertEquals(4, $round->id);
        $this->assertEquals("Tetris", $round->game);
        $this->assertEquals(500, $round->score);
        $this->assertEquals(2, $round->location_id);
        $this->assertEquals(3, $round->player_id);
        $this->assertEquals("1000", $round->time);
    }

    /**
     * @test
     * @expectedException \App\Exception\UserException
     */
    public function it_throws_user_exception_when_setting_invalid_game() {

        $round = new \App\Model\Round();
        $round->id = 4;
        $round->game = null;
        $round->score = 500;
        $round->location_id = 2;
        $round->player_id = 3;
        $round->time = "1000";

    }

    /**
     * @test
     * @expectedException \App\Exception\UserException
     */
    public function it_throws_user_exception_when_setting_invalid_score() {

        $round = new \App\Model\Round();
        $round->id = 4;
        $round->game = "Tetris";
        $round->score = "";
        $round->location_id = 2;
        $round->player_id = 3;
        $round->time = "1000";

    }

    /**
     * @test
     */
    public function it_can_save_itself(){

        $round = new \App\Model\Round();
        $round->fill([
            "game"=>"Tetris",
            "score" => 500,
            "player_id" => 2,
            "location_id" => 3
        ]);
        $result = $round->save();
        $this->assertEquals($round, $result);
        $this->assertNotEmpty($round->id);
        //$this->assertNotEmpty($round->time);
    }


}