<?php

/**
 * Class RoundControllerTest
 * @runTestsInSeparateProcesses
 */
class RoundControllerTest extends \PHPUnit\Framework\TestCase
{
    public function setUp() {
        require "../autoload.php";
    }

    /**
     * @test
     */
    public function it_gives_back_a_valid_json() {
        $_POST['nick'] = 'Jane';
        $_POST['game'] = 'Yoyo';
        $_POST['score'] = 521;

        $roundController = new \App\Controller\RoundController();

        $roundController->create();

        $result = json_decode($this->getActualOutput(), true);

        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('game', $result);
        $this->assertArrayHasKey('score', $result);
        $this->assertArrayHasKey('location_id', $result);
        $this->assertArrayHasKey('player_id', $result);
        $this->assertArrayHasKey('time', $result);

        //$this->assertEquals($_POST['nick'], $result['nick']);
        $this->assertNotEmpty($result['id']);
        $this->assertEquals($_POST['game'], $result['game']);
        $this->assertEquals($_POST['score'], $result['score']);
        $this->assertNotEmpty($result['location_id']);
        $this->assertNotEmpty($result['player_id']);
        $this->assertNull($result['time']);
    }

    /**
     * @test
     */
    public function it_reject_invalid_parameter_with_Http_code_400() {
        $roundController = new \App\Controller\RoundController();

        $roundController->create();

        $this->assertEquals(400, http_response_code());
    }

    /**
     * @test
     * @expectedException
     */
    public function it_rejects_invalid_nick() {
        $_POST['game'] = 'Yoyo';
        $_POST['score'] = 521;

        $roundController = new \App\Controller\RoundController();

        $roundController->create();

        $result = json_decode($this->getActualOutput(), true);

        $this->assertArrayHasKey('code', $result);
        $this->assertArrayHasKey('message', $result);

        $this->assertEquals(20, $result['code']);
        $this->assertEquals(400, http_response_code());
    }
    /**
     * @test
     * @expectedException
     */
    public function it_rejects_invalid_game() {
        $_POST['nick'] = 'Jumbo';

        $roundController = new \App\Controller\RoundController();

        $roundController->create();

        $result = json_decode($this->getActualOutput(), true);

        $this->assertArrayHasKey('code', $result);
        $this->assertArrayHasKey('message', $result);

        $this->assertEquals(21, $result['code']);
        $this->assertEquals(400, http_response_code());
    }
    /**
     * @test
     * @expectedException
     */
    public function it_rejects_invalid_score() {
        $_POST['nick'] = 'Jumbo';
        $_POST['game'] = 'Yoyo';

        $roundController = new \App\Controller\RoundController();

        $roundController->create();

        $result = json_decode($this->getActualOutput(), true);

        $this->assertArrayHasKey('code', $result);
        $this->assertArrayHasKey('message', $result);

        $this->assertEquals(22, $result['code']);
        $this->assertEquals(400, http_response_code());
    }
}