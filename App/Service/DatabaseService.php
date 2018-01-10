<?php

namespace App\Service;

class DatabaseService
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "19860116";
    private $dbname = "leaderboard";
    private $connection;

    private function __construct() {}

    public function getConnection() {
        if (empty($this->connection)) {
            $this->connection = new \PDO(
                "mysql:host=" . $this->servername . ";dbname=" . $this->dbname
                . ";charset=utf8",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->connection;
    }

    private static $instance;
    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}