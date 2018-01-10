<?php

namespace App\Model;

use App\Exception\UserException;
use App\Service\DatabaseService;

class Round extends Model
{
    const TABLE_NAME = "rounds";
    protected $id;
    protected $game;
    protected $score;
    protected $location_id;
    protected $player_id;
    protected $time;


    public function __set($name, $value)
    {
        if ($name == "game" && empty($value)) {
            throw (new UserException)->setCode(UserException::INVALID_GAME);
        }
        if ($name == "score" && $value == "") {
            throw (new UserException)->setCode(UserException::INVALID_SCORE);
        }
        $this->$name = $value;
    }

    public function save() {
        parent::save();
        return $this;
    }
}
