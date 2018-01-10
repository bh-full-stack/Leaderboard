<?php
namespace App\Service;
use App\Exception\UserException;
use App\Model\Location;

class GeolocationService
{
    public static function resolveIp($clientIp): array {
        try {
            $jsonString = file_get_contents("http://ip-api.com/json/$clientIp");
            $response = json_decode($jsonString, true);
            if ($response["status"] == "fail") {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            throw (new UserException)->setCode(UserException::CONNECTION_FAILED);
        }
        return ["country"=>$response["country"], "city"=>$response["city"]];
    }
}