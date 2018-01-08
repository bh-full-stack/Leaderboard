<?php

namespace App\Model;

class Model
{
    public function fill(array $data) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }
}