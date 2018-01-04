<?php

namespace App\Controller;
use App\Exception\UserException;
use App\Model\Player;
use App\Service\GeolocationService;

class ScoreAPIController {
    public function show() {}
    public function create() {
        try {
            $player = new Player;
            $locationData = $this->setLocation(GeolocationService::getLocation());
            $player->set([
                "nick" => $_POST['nick'],
                "game" => $_POST['game'],
                "score"=> $_POST['score'],
                "country" => $locationData["country"],
                "city" => $locationData["city"]
            ]);
            $player->save();

            if (strpos($_SERVER["HTTP_ACCEPT"], "application/json") !== false) {
                header("Access-Control-Allow-Origin: *");
                echo json_encode($player->getAttributes());
            } else {
                throw (new UserException)->setCode(UserException::COMMUNICATION_ERROR);
            }
        } catch (UserException $e) {
            header($e->getHttpHeader());
            if (strpos($_SERVER["HTTP_ACCEPT"], "application/json") !== false) {
                header("Access-Control-Allow-Origin: *");
                echo json_encode(["code" => $e->getCode(), "message" => $e->getMessage()]);
            } else {
                die($e->getMessage());
            }
        }
    }
    public function update() {}
    public function delete() {}
    public function list() {}

    private function setLocation(Location $location) {
        if (!$location->isValid()) {
            throw (new UserException)->setCode(UserException::LOCATION_FAILED);
        }
        return ["country"=>$location->country, "city"=>$location->city];
    }
}