<?php
require 'model/Location.php';

class GeolocationService
{
    public static function getLocation(): Location {
        $clientIp = $_SERVER['REMOTE_ADDR'];
        $clientIp = '89.135.190.25';
        $jsonString = file_get_contents("http://ip-api.com/json/$clientIp");
        if ($jsonString === false) {
            throw (new UserException)->setCode(UserException::CONNECTION_FAILED);
        }
        return (new Location())->fill(json_decode($jsonString, true));
    }
}