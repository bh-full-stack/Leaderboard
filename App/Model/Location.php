<?php

namespace App\Model;

use App\Service\DatabaseService;

class Location
{
    public $city;
    public $country;

    private function find() {
        $conn = DatabaseService::getInstance()->getConnection();
        $sql = "SELECT * FROM locations WHERE country=:country AND city=:city";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':city', $this->city);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fill(array $data) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    public function isValid() {
        return !empty($this->city) && !empty($this->country);
    }

    public function save() {
        if (empty($this->find())) {
            echo "If branch";
            $conn = DatabaseService::getInstance()->getConnection();
            $sql = "INSERT INTO locations (country, city) VALUES (:country, :city)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':country', $this->country);
            $stmt->bindParam(':city', $this->city);
            $stmt->execute();
        }
        return $this->find()[0]["id"];
    }
}
