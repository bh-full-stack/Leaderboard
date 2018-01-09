<?php

class GeolocationServiceTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        require "../autoload.php";
        $this->clientIp = '89.135.190.25';
        $this->country = "Hungary";
        $this->city = "Budapest";
    }

    /**
     * @test
     */
    public function it_can_resolve_an_ip_to_country_and_city()
    {
        $result = \App\Service\GeolocationService::resolveIp($this->clientIp);
        $this->assertInternalType("array", $result);
        $this->assertArrayHasKey("country", $result);
        $this->assertArrayHasKey("city", $result);
        $this->assertEquals($this->country, $result["country"]);
        $this->assertEquals($this->city, $result["city"]);
    }

    /**
     * @test
     * @expectedException \App\Exception\UserException
     */
    public function it_throws_exception_on_invalid_ip_or_failed_API_connection()
    {
        $this->clientIp ="invalidIP";
        \App\Service\GeolocationService::resolveIp($this->clientIp);
    }
}