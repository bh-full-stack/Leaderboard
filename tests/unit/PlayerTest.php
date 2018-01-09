<?php

class PlayerTest extends \PHPUnit\Framework\TestCase
{
    public function setUp() {
        require "../autoload.php";
    }


    /**
     * @test
     */
    public function its_non_public_properties_can_be_set() {
    $player = new \App\Model\Player();
    $player->nick = "Peter";
    $this->assertEquals("Peter", $player->nick);
    }

    /**
     * @test
     */
    public function it_can_fill_itself() {
        $player = new \App\Model\Player();
        $result = $player->fill(["id"=>10, "nick"=>"Peter", "email"=>"peter@gmail.com"]);
        $this->assertEquals(10, $player->id);
        $this->assertEquals("Peter", $player->nick);
        $this->assertEquals("peter@gmail.com", $player->email);
        $this->assertEquals($player, $result);
    }

    /**
     * @test
     */
    public function it_fills_the_given_attributes_only() {
        $player = new \App\Model\Player();
        $player->fill(["id"=>10, "nick"=>"Peter"]);
        $this->assertEquals(10, $player->id);
        $this->assertEquals("Peter", $player->nick);
        $this->assertNull($player->email);
    }

    /**
     * @test
     */
    public function it_rejects_invalid_parameters(){
        $player = new \App\Model\Player();
        $player->fill(["nonExistent"=>10]);
        $this->assertObjectNotHasAttribute("nonExistent", $player);
    }

    /**
     * @test
     */
    public function it_can_validate_itself(){
        $player = new \App\Model\Player();
        $this->assertFalse($player->isValid());
        $player->nick = "Peter";
        $this->assertTrue($player->isValid());
    }

    /**
     * @test
     */
    public function it_can_save_and_load_itself_by_id_and_nick(){
        $player = new \App\Model\Player();
        $player->fill(["id"=>10, "nick"=>"Peter", "email"=>"peter@gmail.com"]);
        $result = $player->save();
        $this->assertEquals($player, $result);
        $this->assertNotEmpty($player->id);

        $newPlayer = new \App\Model\Player();
        $newPlayer->id = $player->id;
        $result = $newPlayer->load();
        $this->assertEquals($player->id, $newPlayer->id);
        $this->assertEquals($player->nick, $newPlayer->nick);
        $this->assertEquals($player->email, $newPlayer->email);
        $this->assertEquals($newPlayer, $result);

        $newPlayer = new \App\Model\Player();
        $newPlayer->nick = $player->nick;
        $result = $newPlayer->loadByNick();
        $this->assertEquals($player->id, $newPlayer->id);
        $this->assertEquals($player->nick, $newPlayer->nick);
        $this->assertEquals($player->email, $newPlayer->email);
        $this->assertEquals($newPlayer, $result);
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function it_throws_exception_on_loading_by_invalid_id() {
        $player = new \App\Model\Player();
        $player->load();
    }

    /**
     * @test
     * WARNING: Do not use on live DB, deletes all records!
     */
    public function it_can_list_all_records() {
        $seedController = new \App\Controller\SeedController();
        $seedController->seed(); // 50 record

        $playersData = \App\Model\Player::list();
        $numberOfRecords = count($playersData);
        $this->assertEquals( 50, $numberOfRecords);
    }
}