<?php

class AbstractTest extends \PHPUnit\Framework\TestCase
{
    public function setUp() {
        require "../autoload.php";
        $controller = new \App\Controller\SeedController();
        $controller->seed();
    }
    /**
     * @test
     */
    public function tearDown()
    {
        \App\Model\Model::deleteAll("players");
        \App\Model\Model::deleteAll("locations");
        \App\Model\Model::deleteAll("rounds");;
    }
}


