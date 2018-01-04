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

    public function set($values) {
        if (empty($values["nick"])) {
            throw (new UserException)->setCode(UserException::INVALID_NICK);
        }
        if (empty($values["game"])) {
            throw (new UserException)->setCode(UserException::INVALID_GAME);
        }
        if ((!isset($values["score"])) || ($values["score"] == "")) {
            throw (new UserException)->setCode(UserException::INVALID_SCORE);
        }
        if (empty($values["country"])) {
            $values["country"] = NULL;
        }
        if (empty($values["city"])) {
            $values["city"] = NULL;
        }
        if (empty($values["email"])) {
            $values["email"] = NULL;
        }

        $this->nick = $values["nick"];
        $this->game = $values["game"];
        $this->score = $values["score"];
        $this->country = $values["country"];
        $this->city = $values["city"];
        $this->email = $values["email"];

        return $this;
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
            $sql = "SELECT * FROM players";
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