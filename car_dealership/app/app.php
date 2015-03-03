<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    $app = new Silex\Application();

    $app->get("/", function() {
        return "Home";
    });

    $app->get("new_car_search", function() {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheeet' href='hhttps://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'/>
            <title>Find a Car</title>
        </head>
        <body>
            <div class='container'>
                <h1>Find a Car!</h1>
                <form action='car.php'>
                    <div class='form-group'>
                        <label for='price'>Enter Maximum Price:</label>
                        <input id='price' name='price' class='form-control' type='number'/>
                    </div>
                    <button type='submit' class='btn-success'>Submit</button>
                </form>
            </div>
        </body>

        </html>
        ";
    });

    $app->get("search_result", function() {
        
    });
    return $app;

?>
