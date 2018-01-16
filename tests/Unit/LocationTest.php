<?php

namespace Tests\Unit;

use App\Location;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LocationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_can_resolve_ip() {
        $location = Location::getByIp("89.135.190.25");
        $this->assertInstanceOf(Location::class, $location);
        $this->assertEquals("Hungary", $location->country);
        $this->assertEquals("Budapest", $location->city);
    }

    /**
     * @test
     */
    public function it_can_get_location_by_country_and_city() {
        $location = Location::getByCountryAndCity("USA", "Budapest");
        $this->assertInstanceOf(Location::class, $location);
        $this->assertEmpty($location->id);
        $this->assertEquals("USA", $location->country);
        $this->assertEquals("Budapest", $location->city);

        $location->save();
        $location2 = Location::getByCountryAndCity("USA", "Budapest");
        $this->assertNotEmpty($location2->id);
        $this->assertEquals("USA", $location2->country);
        $this->assertEquals("Budapest", $location2->city);
    }
}