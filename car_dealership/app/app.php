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
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Find a Car</title>
        </head>
        <body>
            <div class='container'>
                <h1>Find a Car!</h1>
                <form action='/search_result'>
                    <div class='form-group'>
                        <label for='price'>Enter Maximum Price:</label>
                        <input id='price' name='price' class='form-control' type='number'/>
                    </div>
                    <div class='form-group'>
                        <label for='miles'>Enter Maximum Mileage:</label>
                        <input id='miles' name='miles' class='form-control' type='number'/>
                    </div>
                    <button type='submit' class='btn-success'>Submit</button>
                </form>
            </div>
        </body>

        </html>
        ";
    });

    $app->get("search_result", function() {
        $porsche = new Car("2014 Porsche 911", 114991, 7684);
        $ford = new Car("2011 Ford F450", 55995, 14241);
        $lexus = new Car("2013 Lexus RX 350", 44700, 20000);
        $mercedes = new Car("Mercedes Benz CLS550", 399000, 37979);

        $cars = array($porsche, $ford, $lexus, $mercedes);

        $cars_matching_search = array ();
            foreach($cars as $car) {
                if($car->worthBuying($_GET['price']) && ($car->worthMileage($_GET['miles']))) {
                    array_push($cars_matching_search, $car);
                }
            }

        if (empty($cars_matching_search)) {
            return 'There are no cars that meet your search criteria.  Please try again.';
        } else {
            $output = "";
            foreach ($cars_matching_search as $car) {
                $output = $output . "
                <!DOCTYPE html>
                <html>
                <head>
                    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
                    <title>Find a Car</title>
                </head>
                <body>
                    <div class='container'>
                        <h2>" . $car->getMakeModel() . "</h2>
                        <ul>
                            <li>Price: " . $car->getPrice() . "</li>
                            <li>Mileage: " . $car->getMiles() . "</li>
                        </ul>
                    </div>
                </body>
                </html>
                ";
            }

            return $output;
            
        }

    });

    return $app;

?>
