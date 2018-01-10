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
    }

    /**
     * @test
     */
    public function it_can_fill_itself() {
        $round = new \App\Model\Round();
        $result = $round->fill([
            "id" => 4,
            "game"=>"Tetris",
            "score" => 500,
            "player_id" => 2,
            "location_id" => 3,
            "time" => "1000"
        ]);
        $this->assertEquals(4, $round->id);
        $this->assertEquals("Tetris", $round->game);
        $this->assertEquals(500, $round->score);
        $this->assertEquals(2, $round->player_id);
        $this->assertEquals(3, $round->location_id);
        $this->assertEquals("1000", $round->time);
        $this->assertEquals($round, $result);
    }

    /**
     * @test
     */
    public function it_fills_the_given_attributes_only() {
        $round = new \App\Model\Round();
        $round->fill([
            "id" => 4,
            "game"=>"Tetris",
            "score" => 500
        ]);
        $this->assertEquals(4, $round->id);
        $this->assertEquals("Tetris", $round->game);
        $this->assertEquals(500, $round->score);
        $this->assertNull($round->player_id);
        $this->assertNull($round->location_id);
        $this->assertNull($round->time);
    }

    /**
     * @test
     */
    public function it_rejects_invalid_parameters(){
        $round = new \App\Model\Round();
        $round->fill([
            "nonExistent" => 4
        ]);
        $this->assertObjectNotHasAttribute("nonExistent", $round);
    }

    /**
     * @test
     */
    public function it_can_save_and_load_itself(){

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

        $newRound = new \App\Model\Round();
        $newRound->id = $round->id;
        $result = $newRound->load();

        $this->assertEquals($round->id, $newRound->id);
        $this->assertEquals($round->game, $newRound->game);
        $this->assertEquals($round->score, $newRound->score);
        $this->assertEquals($round->player_id, $newRound->player_id);
        $this->assertEquals($round->location_id, $newRound->location_id);
        $this->assertNotEmpty($newRound->time);
        $this->assertEquals($newRound, $result);
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function it_throws_exception_on_loading_by_invalid_id() {
        $round = new \App\Model\Round();
        $round->load();
    }
}