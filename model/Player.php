<?php

class Player
{
    private $nick;
    private $game;
    private $score;
    private $country;
    private $city;

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
        $servername = "localhost";
        $username = "root";
        $password = "mob";
        $dbname = "leaderboard";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO players (nick, game, score, country, city) 
                VALUES (:nick, :game, :score, :country, :city)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nick', $this->nick);
            $stmt->bindParam(':game', $this->game);
            $stmt->bindParam(':score', $this->score);
            $stmt->bindParam(':country', $this->country);
            $stmt->bindParam(':city', $this->city);
            $stmt->execute();
        } catch(PDOException $e) {
            throw (new UserException)->setCode(UserException::DATABASE_ERROR);
        }
    }

    public static function list() {
        $servername = "localhost";
        $username = "root";
        $password = "mob";
        $dbname = "leaderboard";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM players";
            return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw (new UserException)->setCode(UserException::DATABASE_ERROR);
        }
    }
}