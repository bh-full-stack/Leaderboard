<?php

namespace App\Controller;
use App\Exception\UserException;
use App\Model\Player;
use App\Service\GeolocationService;

class ScoreAPIController {
    public function show() {}
    public function create() {
        try {
            $location = GeolocationService::getLocation();
            $player = new Player;
            $player->fillAttributes([
                "email" => $_POST['email'],
                "nick" => $_POST['nick'],
                "game" => $_POST['game'],
                "score" => $_POST['score'],
                "country" => $location->country,
                "city" => $location->city
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
}