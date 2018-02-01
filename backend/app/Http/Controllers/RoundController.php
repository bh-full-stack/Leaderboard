<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\UserException;
use App\Location;
use App\Player;
use App\Round;
use App\Providers\HttpService;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       return Player::listTopPlayersByGame(
           $request->get('game', 'all'),
           $request->get('sortBy', 'top_score'),
           $request->get('sortDirection', 'DESC')
       );
    }

    public function listGames() {
        return Round::getListOfGames();
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
            'name' => 'required',
            'game' => 'required',
            'score' => 'required|integer'
        ]);

        $clientIp = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
        $clientIp = '89.135.190.25';
        $location = Location::getByIp($clientIp);
        $location->saveOrFail();

        $player = Player::getByName($request->post('name'));
        $player->saveOrFail();

        $round = new Round();
        $round->game = $request->post('game');
        $round->score = $request->post('score');
        $round->location_id = $location->id;
        $round->player_id = $player->id;
        $round->save();

        return Round::with("player")->find($round->id);
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
