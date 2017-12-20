<?php

class Player
{
    public $nick;
    public $game;
    public $score;
    public $country;
    public $city;


    public function save() {
        $servername = "localhost";
        $username = "root";
        $password = "mob";
        $dbname = "leaderboard";

        try {
            if ($this->nick == "") {
                throw new Exception("Invalid name");
            }
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
            return true;
        } catch(Exception $e) {
            return false;
        }
    }
}