<?php

class LocationTest extends MyTest
{
    /**
     * @test
     */
    public function it_can_fill_itself() {
        $location = new \App\Model\Location();
        $result = $location->fill(["id"=>16, "country"=>"Hungary", "city"=>"Budapest"]);
        $this->assertEquals(16, $location->id);
        $this->assertEquals("Hungary", $location->country);
        $this->assertEquals("Budapest", $location->city);
        $this->assertEquals($location, $result);
    }

    /**
     * @test
     */
    public function it_fills_the_given_attributes_only() {
        $location = new \App\Model\Location();
        $location->fill(["id"=>16, "country"=>"Hungary"]);
        $this->assertEquals(16, $location->id);
        $this->assertEquals("Hungary", $location->country);
        $this->assertNull($location->city);
    }

    /**
     * @test
     */
    public function it_rejects_invalid_parameters(){
        $location = new \App\Model\Location();
        $location->fill(["nonExistent"=>16]);
        $this->assertObjectNotHasAttribute("nonExistent", $location);
    }

    /**
     * @test
     */
    public function it_can_validate_itself(){
        $location = new \App\Model\Location();
        $this->assertFalse($location->isValid());
        $location->country = "Hungary";
        $this->assertFalse($location->isValid());
        $location->city = "Budapest";
        $this->assertTrue($location->isValid());
    }

    /**
     * @test
     */
    public function it_can_save_and_load_itself(){
        $location = new \App\Model\Location();
        $location->fill(["country"=>"Hungary", "city" => "Budapest"]);
        $result = $location->save();
        $this->assertEquals($location, $result);
        $this->assertNotEmpty($location->id);

        $newLocation = new \App\Model\Location();
        $newLocation->id = $location->id;
        $result = $newLocation->load();
        $this->assertEquals($location->id, $newLocation->id);
        $this->assertEquals($location->country, $newLocation->country);
        $this->assertEquals($location->city, $newLocation->city);
        $this->assertEquals($newLocation, $result);
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function it_throws_exception_on_loading_by_invalid_id() {
        $location = new \App\Model\Location();
        $location->load();
    }
}