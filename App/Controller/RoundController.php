<?php

namespace App\Controller;
use App\Exception\UserException;
use App\Model\Location;
use App\Model\Player;
use App\Model\Round;
use App\Service\HttpService;

class RoundController {
    public function show() {}
    public function create() {
        header("Access-Control-Allow-Origin: *");
        try {
            $clientIp = $_SERVER['REMOTE_ADDR'];
            $clientIp = '89.135.190.25';
            $location = new Location();
            $location->fillByIp($clientIp);
            $location->save();

            $player = new Player();
            $player->nick = HttpService::getPostVar('nick');
            $player->save();

            $round = new Round();
            $round->game = HttpService::getPostVar('game');
            $round->score = HttpService::getPostVar('score');
            $round->location_id = $location->id;
            $round->player_id = $player->id;
            $round->save();

            echo json_encode($round->getAttributes());
        } catch (UserException $e) {
            header($e->getHttpHeader());
            echo json_encode(["code" => $e->getCode(), "message" => $e->getMessage()]);
        } catch (\Exception $e) {
            header("HTTP/1.0 500 Internal Server Error");
            error_log($e);
            echo json_encode(["code" => 0, "message" => "Unknown system error"]);
        }
    }
    public function update() {}
    public function delete() {}
    public function list() {}
}