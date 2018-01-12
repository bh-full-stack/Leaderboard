<?php

namespace App\Model;

use App\Exceptions\UserException;
use App\Providers\DatabaseService;

class Round extends Model
{
    const TABLE_NAME = "rounds";
    protected $id;
    protected $game;
    protected $score;
    protected $location_id;
    protected $player_id;
    protected $time;


    public function __set($name, $value)
    {
        if ($name == "game" && empty($value)) {
            throw (new UserException)->setCode(UserException::INVALID_GAME);
        }
        if ($name == "score" && $value == "") {
            throw (new UserException)->setCode(UserException::INVALID_SCORE);
        }
        $this->$name = $value;
    }

    public function load() {
        $conn = DatabaseService::getInstance()->getConnection();
        $sql = "SELECT * FROM rounds WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if (!isset($rows[0])) {
            throw new \Exception("Cannot load round by id");
        }
        $this->fill($rows[0]);
        return $this;
    }

    public static function getListOfGames() {
        $conn = DatabaseService::getInstance()->getConnection();
        $sql = "SELECT DISTINCT game FROM rounds";
        return $conn->query($sql)->fetchAll(\PDO::FETCH_COLUMN);
    }
}
