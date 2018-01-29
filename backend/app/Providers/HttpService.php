<?php

namespace App\Providers;


class HttpService
{
    public static function getPostVar($key) {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }
}