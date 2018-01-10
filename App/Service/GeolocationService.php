<?php
namespace App\Service;
use App\Exception\UserException;

class GeolocationService
{
    private static $clientIp;
    private static $ApiUrl;

    public static function resolveIp($clientIp, $ApiUrl = "http://ip-api.com/json/"): array {
        try {
            self::$clientIp = $clientIp;
            self::$ApiUrl = $ApiUrl;
            $jsonString = file_get_contents(self::$ApiUrl . self::$clientIp);
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