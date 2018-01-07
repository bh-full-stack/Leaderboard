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
        if (isset($_GET['sort-by'])) Player::setListSorting($_GET['sort-by']);
        if (isset($_GET['sort-direction'])) Player::setListSorting(null, $_GET['sort-direction']);
        $playersData = Player::list();
        include "../templates/layout.php";
    }
}