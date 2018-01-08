<?php

namespace App\Model;

use App\Exception\UserException;
use App\Service\DatabaseService;

class Player extends Model
{
    public $id;
    public $nick;
    public $email;


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

    private function loadByNick() {
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
            $conn = DatabaseService::getInstance()->getConnection();
            $sql = "INSERT INTO players (nick, email) VALUES (:nick, :email)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nick', $this->nick);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $this->id = $conn->lastInsertId();
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