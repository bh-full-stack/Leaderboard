<?php

class PlayerTest extends ATest
{
    /**
     * @test
     */
    public function its_non_public_properties_can_be_set() {
        $player = new \App\Model\Player();
        $player->nick = "Thomas";
        $player->email = "thomas@gmail.com";
        $this->assertEquals("Thomas", $player->nick);
        $this->assertEquals("thomas@gmail.com", $player->email);
    }

    /**
     * @test
     */
    public function it_can_fill_itself() {
        $player = new \App\Model\Player();
        $result = $player->fill(["id"=>10, "nick"=>"Thomas", "email"=>"thomas@gmail.com"]);
        $this->assertEquals(10, $player->id);
        $this->assertEquals("Thomas", $player->nick);
        $this->assertEquals("thomas@gmail.com", $player->email);
        $this->assertEquals($player, $result);
    }

    /**
     * @test
     */
    public function it_fills_the_given_attributes_only() {
        $player = new \App\Model\Player();
        $player->fill(["id"=>10, "nick"=>"Thomas"]);
        $this->assertEquals(10, $player->id);
        $this->assertEquals("Thomas", $player->nick);
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
        $player->nick = "Thomas";
        $this->assertTrue($player->isValid());
    }

    /**
     * @test
     */
    public function it_can_save_and_load_itself_by_id(){
        $player = new \App\Model\Player();
        $player->fill(["id"=>10, "nick"=>"Thomas", "email"=>"thomas@gmail.com"]);
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
    }

    /**
     * @test
     */
    public function it_can_save_and_load_itself_by_nick(){
        $player = new \App\Model\Player();
        $player->fill(["id"=>10, "nick"=>"Thomas", "email"=>"thomas@gmail.com"]);
        $result = $player->save();
        $this->assertEquals($player, $result);
        $this->assertNotEmpty($player->id);

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
     */
    public function it_can_list_all_records() {
        $seedController = new \App\Controller\SeedController();
        $seedController->seed(); // 50 record

        $playersData = \App\Model\Player::list();
        $numberOfRecords = count($playersData);
        $this->assertEquals( 50, $numberOfRecords);
    }
}