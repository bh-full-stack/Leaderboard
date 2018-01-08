<?php

namespace App\Model;

use App\Exception\UserException;
use App\Service\DatabaseService;

class Round extends Model
{
    private $id;
    private $game;
    private $score;
    private $location_id;
    private $player_id;
    private $time;

    public function __set($name, $value)
    {
        if ($name == "game" && empty($value)) {
            throw (new UserException)->setCode(UserException::INVALID_GAME);
        }
        if ($name == "score" && $value == "") {
            throw (new UserException)->setCode(UserException::INVALID_SCORE);
        }
    }

    public function save() {
        $conn = DatabaseService::getInstance()->getConnection();
        $sql = "INSERT INTO rounds (game, score, location_id, player_id) 
                VALUES (:game, :score, :location_id, :player_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':game', $this->game);
        $stmt->bindParam(':score', $this->score);
        $stmt->bindParam(':location_id', $this->location_id);
        $stmt->bindParam(':player_id', $this->player_id);
        $stmt->execute();
        $this->id = $conn->lastInsertId();
        return $this;
    }
}
