<?php

namespace App\Controller;
use App\Exception\UserException;
use App\Model\Player;
use App\Model\Round;
use App\Service\GeolocationService;

class RoundController {
    public function show() {}
    public function create() {
        try {
            $location = GeolocationService::getLocation();

            $player = new Player();
            $player->nick = $_POST['nick'];
            $player->save();

            $round = new Round();
            $round->game = $_POST['game'];
            $round->score = $_POST['score'];
            $round->location_id = $location->id;
            $round->player_id = $player->id;
            $round->save();
        } catch (\Exception $e) {
            // @todo
        }

      /*  try {
            $player = new Player;
            $player->nick = $_POST['nick'];
            $player->game = $_POST['game'];
            $player->score = $_POST['score'];
            $player->setLocation(GeolocationService::getLocation());
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
        }*/
    }
    public function update() {}
    public function delete() {}
    public function list() {}
}