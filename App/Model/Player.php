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

    private static $listOrderBy = "nick";
    private static $listOrderDirection = "ASC";

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

    public static function setListSorting($sort = null, $direction = null) {
        if (!is_null($sort)) self::$listOrderBy = $sort;
        if (!is_null($direction) && ($direction == "ASC" || $direction == "DESC"))
            self::$listOrderDirection = $direction;
    }

    public static function list() {
        try {
            $conn = DatabaseService::getInstance()->getConnection();
            $sql = "SELECT * FROM players ORDER BY
                      CASE :sort WHEN 'nick' THEN nick
                                 WHEN 'game' THEN game 
                                 WHEN 'score' THEN LENGTH(score)
                                 else nick END " . self::$listOrderDirection . ",
                      CASE :sort WHEN 'score' THEN score END " . self::$listOrderDirection;
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':sort', self::$listOrderBy, \PDO::PARAM_STR);
            //$stmt->bindValue(':dir', self::$listOrderDirection, \PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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