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
        }
    }
    public function update() {}
    public function delete() {}
    public function list() {
        $sortBy = isset($_GET['sort-by']) ? $_GET['sort-by'] : null;
        $sortDir = isset($_GET['sort-dir']) ? $_GET['sort-dir'] : null;
        $playersData = Player::list($sortBy, $sortDir);
        include "../templates/layout.php";
    }
}