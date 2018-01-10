<?php

namespace App\Controller;

use App\Service\DatabaseService;

class MigrateController
{
    public function migrate($dbname) {
        $conn = DatabaseService::getInstance()->getConnection();
        $sql = "CREATE DATABASE $dbname";
        $conn->exec($sql);
        $sql = "USE $dbname";
        $conn->exec($sql);
        // TODO execute migrate.sql
        //exec("cat ../migrate.sql | mysql -h localhost -u root -pmob");
    }
}