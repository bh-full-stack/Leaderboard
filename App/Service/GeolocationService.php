<?php
namespace App\Service;
use App\Exception\UserException;
use App\Model\Location;

class GeolocationService
{
    public static function resolveIp($clientIp): array {
        $jsonString = file_get_contents("http://ip-api.com/json/$clientIp");
        if ($jsonString === false) {
            throw (new UserException)->setCode(UserException::CONNECTION_FAILED);
        }
        $response = json_decode($jsonString, true);
        return ["country"=>$response["country"], "city"=>$response["city"]];
    }
}