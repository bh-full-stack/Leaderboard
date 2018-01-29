<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoundControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_can_save_round() {
        $response = $this->post(
            '/api/rounds',
            [
                'name' => 'Jancsi',
                'game' => 'Yoyo',
                'score' => '69'
            ]
        );
        $response->assertStatus(200);
        $result = $response->json();

        $this->assertNotEmpty($result['id']);
        $this->assertEquals('Yoyo', $result['game']);
        $this->assertEquals('69', $result['score']);
        $this->assertNotEmpty($result['location_id']);
        $this->assertNotEmpty($result['player_id']);
        $this->assertNotEmpty($result['created_at']);
    }

    /**
     * @test
     */
    public function it_rejects_invalid_parameter_with_http_code_422() {
        $response = $this->post('/api/rounds', [], ['Accept' => 'application/json']);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function it_rejects_invalid_name() {
        $response = $this->post(
            '/api/rounds',
            ['game' => 'Yoyo', 'score' => '521'],
            ['Accept' => 'application/json']
        );
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function it_rejects_invalid_game() {
        $response = $this->post(
            '/api/rounds',
            ['name' => 'Jane', 'score' => '521'],
            ['Accept' => 'application/json']
        );
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function it_rejects_invalid_score() {
        $response = $this->post(
            '/api/rounds',
            ['game' => 'Yoyo', 'name' => 'Jane'],
            ['Accept' => 'application/json']
        );
        $response->assertStatus(422);
    }
}
