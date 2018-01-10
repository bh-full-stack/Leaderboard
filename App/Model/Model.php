<?php

namespace App\Model;

use App\Exception\UserException;
use App\Service\DatabaseService;

class Model
{
    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function fill(array $data) {
        foreach ($data as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
        return $this;
    }

    public function getAttributes() {
        return get_object_vars($this);
    }

    public function save() {
        try {
            $conn = DatabaseService::getInstance()->getConnection();
            $columns = get_object_vars($this);
            foreach ($columns as $column => $value) {
                if ($value == null) {
                    unset($columns[$column]);
                }
            }
            $givenColumns = implode(", ", array_keys($columns));
            $givenColumnValues = ":" . implode(", :", array_keys($columns));
            $sql = "INSERT INTO " . static::TABLE_NAME . " ($givenColumns) VALUES ($givenColumnValues)";
            $stmt = $conn->prepare($sql);
            foreach ($columns as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }
            $stmt->execute();
            $this->id = $conn->lastInsertId();
            return $this;
        } catch(\PDOException $e) {
            throw (new UserException())->setCode(UserException::DATABASE_ERROR);
        }
    }

    public static function deleteAll($table) {
        try {
            $conn = DatabaseService::getInstance()->getConnection();
            $sql = "DELETE FROM $table";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } catch(\PDOException $e) {
            throw (new UserException())->setCode(UserException::DATABASE_ERROR);
        }
    }
}