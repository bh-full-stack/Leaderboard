<?php

namespace App\Model;

use App\Service\DatabaseService;
use App\Service\GeolocationService;

class Location extends Model
{
    protected $id;
    protected $city;
    protected $country;



    public function fillByIp($clientIp) {
        $this->fill(GeolocationService::resolveIp($clientIp));
    }

    private function loadByCountryAndCity() {
        $conn = DatabaseService::getInstance()->getConnection();
        $sql = "SELECT * FROM locations WHERE country=:country AND city=:city";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':city', $this->city);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if (!isset($rows[0])) {
            throw new \Exception("Cannot load location by country and city");
        }
        $this->fill($rows[0]);
        return $this;
    }

    public function isValid() {
        return !empty($this->city) && !empty($this->country);
    }

    public function load() {
        $conn = DatabaseService::getInstance()->getConnection();
        $sql = "SELECT * FROM locations WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if (!isset($rows[0])) {
            throw new \Exception("Cannot load location by id");
        }
        $this->fill($rows[0]);
        return $this;
    }

    public function save() {
        if (!$this->isValid()) {
            throw new \Exception("Cannot save invalid location");
        }
        try {
            $this->loadByCountryAndCity();
        } catch (\Exception $e) {
            $conn = DatabaseService::getInstance()->getConnection();
            $sql = "INSERT INTO locations (country, city) VALUES (:country, :city)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':country', $this->country);
            $stmt->bindParam(':city', $this->city);
            $stmt->execute();
            $this->id = $conn->lastInsertId();
        }
        return $this;
    }
}
