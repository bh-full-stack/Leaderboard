<?php

class GeolocationServiceTest extends \PHPUnit\Framework\TestCase
{
    const CLIENTIP="89.135.190.25";
    const COUNTRY = "Hungary";
    const CITY = "Budapest";

    public function setUp()
    {
        require "../autoload.php";
    }

    /**
     * @test
     */
    public function it_can_resolve_an_ip_to_country_and_city()
    {
        $result = \App\Service\GeolocationService::resolveIp($this::CLIENTIP);
        $this->assertInternalType("array", $result);
        $this->assertArrayHasKey("country", $result);
        $this->assertArrayHasKey("city", $result);
        $this->assertEquals($this::COUNTRY, $result["country"]);
        $this->assertEquals($this::CITY, $result["city"]);
    }

    /**
     * @test
     * @expectedException \App\Exception\UserException
     */
    public function it_throws_exception_on_invalid_ip_or_failed_API_connection()
    {
        \App\Service\GeolocationService::resolveIp("invalidIP");
    }
}