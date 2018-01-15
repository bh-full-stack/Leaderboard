<?php

namespace Tests\Unit;

use Tests\TestCase;

class GeolocationServiceTest extends TestCase
{

    /**
     * @test
     */
    public function it_can_resolve_an_ip_to_country_and_city()
    {
        $result = \App\Providers\GeolocationService::resolveIp("89.135.190.25");
        $this->assertEquals("Hungary", $result["country"]);
        $this->assertEquals("Budapest", $result["city"]);
    }

    /**
     * @test
     * @expectedException \App\Exceptions\UserException
     */
    public function it_throws_exception_on_invalid_client_ip()
    {
        \App\Providers\GeolocationService::resolveIp("invalidClientIp");
    }

    /**
     * @test
     * @expectedException \App\Exceptions\UserException
     */
    public function it_throws_exception_on_failed_API_connection()
    {
        $this->clientIp = "89.135.190.25";
        \App\Providers\GeolocationService::resolveIp("89.135.190.25", "invalidApiUrl");
    }
}