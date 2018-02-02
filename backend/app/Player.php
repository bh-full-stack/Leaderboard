<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Player extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = ["name", "email", "has_deletable_rounds"];
    protected $hidden = ["password", "activation_code"];


    public function rounds() {
        return $this->hasMany(Round::class);
    }

    public function profile() {
        return $this->belongsTo(Profile::class);
    }



    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function activate() {
        $this->activated_at = Carbon::now();

        $oldRoundCount = Round::where("player_id", "=", $this->id)
            ->where("created_at", "<=", $this->activated_at)
            ->count();
        $this->has_deletable_rounds = ($oldRoundCount > 0);

        $this->save();
        
        return $this;
    }

    public static function getByName($name) {
        return self::firstOrNew(["name" => $name]);
    }

    public static function listTopPlayersByGame($game, $sortBy, $sortDirection) {
        $sql = DB::connection(env("DB_CONNECTION"))
            ->table("rounds")
            ->join("players", "rounds.player_id", "=", "players.id")
            ->select(
                "players.name",
                "rounds.game",
                DB::raw("count(rounds.id) as number_of_rounds"),
                DB::raw("max(rounds.score) as top_score")
            );

        if ($game != 'all') {
            $sql = $sql->where("game", "=", $game);
        }

        return $sql
            ->groupBy("rounds.player_id", "rounds.game")
            ->orderBy($sortBy, $sortDirection)
            ->get();
    }
}
