<?php

namespace App\Model;

use App\Exceptions\UserException;
use App\Providers\DatabaseService;

class Player extends Model
{
    const TABLE_NAME = "players";
    protected $id;
    protected $nick;
    protected $email;
    protected $password_hash;

    public function __set($name, $value)
    {
        if ($name == "nick" && empty($value)) {
            throw (new UserException)->setCode(UserException::INVALID_NICK);
        }
        $this->$name = $value;
    }

    public function isValid() {
        return !empty($this->nick);
    }

    public function loadByNick() {
        $conn = DatabaseService::getInstance()->getConnection();
        $sql = "SELECT * FROM players WHERE nick=:nick";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nick', $this->nick);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if (!isset($rows[0])) {
            throw new \Exception("Cannot load player by nick");
        }
        $this->fill($rows[0]);
        return $this;
    }

    public function load() {
        $conn = DatabaseService::getInstance()->getConnection();
        $sql = "SELECT * FROM players WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if (!isset($rows[0])) {
            throw new \Exception("Cannot load player by id");
        }
        $this->fill($rows[0]);
        return $this;
    }

    public function save() {
        if (!$this->isValid()) {
            throw new \Exception("Cannot save invalid player");
        }
        try {
            $this->loadByNick();
        } catch (\Exception $e) {
            parent::save();
        }
        return $this;
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

    public static function listTopPlayersByGame() {
        try {
            $conn = DatabaseService::getInstance()->getConnection();
            $sql = "SELECT
                        players.nick, 
                        rounds.game, 
                        MAX(rounds.score) AS top_score, 
                        COUNT(rounds.id) AS number_of_rounds
                    FROM rounds
                    JOIN players
                        ON rounds.player_id = players.id
                    GROUP BY rounds.player_id, rounds.game";
            return $conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            throw (new UserException)->setCode(UserException::DATABASE_ERROR);
        }
    }
}