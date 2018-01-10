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

        ob_start();
        $roundController->create();
        $outputBuffer = ob_get_contents();
        ob_end_clean();

        $result = json_decode($outputBuffer, true);

        $this->assertNotNull($result);

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
    public function it_rejects_invalid_parameter_with_http_code_400() {
        $roundController = new \App\Controller\RoundController();

        ob_start();
        $roundController->create();
        ob_end_clean();

        $this->assertEquals(400, http_response_code());
    }

    /**
     * @test
     */
    public function it_rejects_invalid_nick() {
        $_POST['game'] = 'Yoyo';
        $_POST['score'] = 521;

        $roundController = new \App\Controller\RoundController();

        ob_start();
        $roundController->create();
        $outputBuffer = ob_get_contents();
        ob_end_clean();

        $result = json_decode($outputBuffer, true);

        $this->assertEquals(20, $result['code']);
        $this->assertNotEmpty($result['message']);

        $this->assertEquals(400, http_response_code());
    }

    /**
     * @test
     */
    public function it_rejects_invalid_game() {
        $_POST['nick'] = 'Jumbo';

        $roundController = new \App\Controller\RoundController();

        ob_start();
        $roundController->create();
        $outputBuffer = ob_get_contents();
        ob_end_clean();

        $result = json_decode($outputBuffer, true);

        $this->assertEquals(21, $result['code']);
        $this->assertNotEmpty($result['message']);

        $this->assertEquals(400, http_response_code());
    }

    /**
     * @test
     */
    public function it_rejects_invalid_score() {
        $_POST['nick'] = 'Jumbo';
        $_POST['game'] = 'Yoyo';

        $roundController = new \App\Controller\RoundController();

        ob_start();
        $roundController->create();
        $outputBuffer = ob_get_contents();
        ob_end_clean();

        $result = json_decode($outputBuffer, true);

        $this->assertEquals(22, $result['code']);
        $this->assertNotEmpty($result['message']);

        $this->assertEquals(400, http_response_code());
    }
}