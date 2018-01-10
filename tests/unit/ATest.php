<?php

class ATest extends \PHPUnit\Framework\TestCase
{
    public function setUp() {
        require "../autoload.php";
        \App\Service\DatabaseService::getInstance()->setDbName("leaderboard_test");
    }

    public function tearDown()
    {
        \App\Model\Model::deleteAll("players");
        \App\Model\Model::deleteAll("locations");
        \App\Model\Model::deleteAll("rounds");;
    }
}