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

    public static function getByIp($clientIp) {
        $locationData = GeolocationService::resolveIp($clientIp);
        return self::getByCountryAndCity($locationData['country'], $locationData['city']);
    }

    public static function getByCountryAndCity($country, $city) {
        return self::firstOrNew(
            ['country' => $country, 'city' => $city]
        );
    }
}














