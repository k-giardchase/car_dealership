<?php

    require_once __DIR__."/../vendor/autoload.php";

    $app = new Silex\Application();

    $app->get("/hello", function() {
        return "Hello friend!";
    });

    $app->get("/goodbye", function() {
        return "Goodbye friend!";
    });

    return $app;

?>
