<?php

namespace App;

use App\Providers\GeolocationService;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['country', 'city'];

    public function rounds() {
        return $this->hasMany('Round');
    }

    public function fillByIp($clientIp) {
        $this->fill(GeolocationService::resolveIp($clientIp));
    }

    public static function getByCountryAndCity($country, $city) {
        return self::firstOrNew(
            ['country' => $country, 'city' => $city]
        );
    }
}














