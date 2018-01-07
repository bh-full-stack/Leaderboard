<?php

namespace App\Model;

use App\Exception\UserException;
use App\Service\DatabaseService;

class Player
{
    private $email;
    private $nick;
    private $game;
    private $score;
    private $country;
    private $city;
    public static $sort = false;

    public function __set($name, $value)
    {
        if ($name == "nick" && empty($value)) {
            throw (new UserException)->setCode(UserException::INVALID_NICK);
        }
        if ($name == "game" && empty($value)) {
            throw (new UserException)->setCode(UserException::INVALID_GAME);
        }
        if ($name == "score" && $value == "") {
            throw (new UserException)->setCode(UserException::INVALID_SCORE);
        }
        $this->$name = $value;
    }

    public function setLocation(Location $location) {
        if (!$location->isValid()) {
            throw (new UserException)->setCode(UserException::LOCATION_FAILED);
        }
        $this->country = $location->country;
        $this->city = $location->city;
    }

    public function getAttributes() {
        return [
            "nick" => $this->nick,
            "score" => $this->score,
            "game" => $this->game,
            "country" => $this->country,
            "city" => $this->city
        ];
    }

    public function save() {
        try {
            $conn = DatabaseService::getInstance()->getConnection();
            $sql = "INSERT INTO players (email, nick, game, score, country, city) 
                VALUES (:email, :nick, :game, :score, :country, :city)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':nick', $this->nick);
            $stmt->bindParam(':game', $this->game);
            $stmt->bindParam(':score', $this->score);
            $stmt->bindParam(':country', $this->country);
            $stmt->bindParam(':city', $this->city);
            $stmt->execute();
        } catch(\PDOException $e) {
            error_log($e->getMessage());
            throw (new UserException)->setCode(UserException::DATABASE_ERROR);
        }
    }

    public static function list() {
        try {
            $conn = DatabaseService::getInstance()->getConnection();
            if (!isset($_GET["by"]) && !isset($_GET["direction"])) {
                $sql = "SELECT * FROM players";
                self::$sort = false;
            } elseif (($_GET["by"] == "nick" ||
                    $_GET["by"] == "game" ||
                    $_GET["by"] == "country" ||
                    $_GET["by"] == "city" ||
                    $_GET["by"] == "score") &&
                ($_GET["direction"] == "ASC" || $_GET["direction"] == "DESC"))
            {
                    $by = $_GET["by"];
                    $direction = $_GET["direction"];
                    $sql = "SELECT * FROM players ORDER BY $by $direction";
                    self::$sort = true;
            }
            return $conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            throw (new UserException)->setCode(UserException::DATABASE_ERROR);
        }
    }

    public static function sort($by, $direction) {
        try {
            $conn = DatabaseService::getInstance()->getConnection();
            $sql = "SELECT * FROM players ORDER BY $by $direction";
            return $conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            throw (new UserException)->setCode(UserException::DATABASE_ERROR);
        }
    }

    public static function deleteAll() {
        try {
            $conn = DatabaseService::getInstance()->getConnection();
            $sql = "DELETE FROM players";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } catch(\PDOException $e) {
            throw (new UserException)->setCode(UserException::DATABASE_ERROR);
        }
    }
}