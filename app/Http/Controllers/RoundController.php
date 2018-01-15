<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\UserException;
use App\Location;
use App\Player;
use App\Round;
use App\Providers\HttpService;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "Index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nick' => 'required|unique:players',
            'game' => 'required',
            'score' => 'required|integer'
        ]);

        header("Access-Control-Allow-Origin: *");
        try {
            $clientIp = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
