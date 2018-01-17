<?php
namespace App\Providers;

class GeolocationService
{
    public static function resolveIp($clientIp, $apiUrl = "http://ip-api.com/json/"): array {
        $jsonString = file_get_contents($apiUrl . $clientIp);
        $response = json_decode($jsonString, true);
        if ($response["status"] == "fail") {
            throw new \Exception();
        }
        return ["country"=>$response["country"], "city"=>$response["city"]];
    }
}