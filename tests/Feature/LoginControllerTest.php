<?php

namespace Tests\Feature;

use App\Player;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_rejects_unactivated_login_attempts()
    {
        $this->markTestIncomplete();
    }
}
