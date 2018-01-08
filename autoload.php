<?php

spl_autoload_register(function ($className) {
    $path = "../" . str_replace("\\", "/", $className) . ".php";
    if (file_exists($path)) {
        include($path);
    }
});
