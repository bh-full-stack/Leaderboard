<?php

namespace App\Exception;

class UserException extends \Exception
{
    const DATABASE_ERROR = 10;
    const CONNECTION_FAILED = 11;
    const INVALID_NICK = 20;
    const INVALID_GAME = 21;
    const INVALID_SCORE = 22;
    const COMMUNICATION_ERROR = 23;
    const LOCATION_FAILED = 30;

    public function setCode(int $code) {
        $messages = [
            self::DATABASE_ERROR => "Database error",
            self::CONNECTION_FAILED => "Connection failed",
            self::INVALID_NICK => "Invalid nick",
            self::INVALID_GAME => "Invalid game",
            self::INVALID_SCORE => "Invalid score",
            self::LOCATION_FAILED => "Location detection has failed",
            self::COMMUNICATION_ERROR => "Communication error"
        ];
        $this->code = $code;
        $this->message = $messages[$code];
        return $this;
    }

    public function getHttpHeader() {
        if ($this->code >= 10 && $this->code < 20) {
            return "HTTP/1.0 500 Internal Server Error";
        }

        if ($this->code >= 20 && $this->code < 30) {
            return "HTTP/1.0 400 Bad Request";
        }

        if ($this->code >= 30 && $this->code < 40) {
            return "HTTP/1.0 500 Internal Server Error";
        }

        return "HTTP/1.0 500 Internal Server Error";
    }
}