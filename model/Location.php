<?php

class Location
{
    private $as;
    public $city;
    public $country;
    private $countryCode;
    private $isp;
    private $lat;
    private $lon;
    private $org;
    private $query;
    private $region;
    private $regionName;
    private $status;
    private $timezone;
    private $zip;

    public function fill(array $data) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    public function isValid() {
        return $this->status == "success";
    }
}
