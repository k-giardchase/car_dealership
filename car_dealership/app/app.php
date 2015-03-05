<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    session_start();
    if(empty($_SESSION['total_cars'])) {
        $_SESSION['total_cars'] = array();
        }


    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


        $app->get("/", function() use ($app){

            return $app['twig']->render('search_car.twig');
        });

        $app->get("/search_result", function() use ($app) {
            // $porsche = new Car("2014 Porsche 911", 114991, 7684);
            // $ford = new Car("2011 Ford F450", 55995, 14241);
            // $lexus = new Car("2013 Lexus RX 350", 44700, 20000);
            // $mercedes = new Car("Mercedes Benz CLS550", 399000, 37979);

            // $cars = array($porsche, $ford, $lexus, $mercedes);
            $cars = array();
                foreach($cars as $car) {
                    if($car->worthBuying($_GET['price']) && ($car->worthMileage($_GET['miles']))) {
                        array_push($search_results, $car);
                    }
                }
                return $app['twig']->render('cars.twig', array('list_of_cars' => Car::getAll()));
            // return $app['twig']->render('cars.twig', array('list_of_cars' => $search_results));

        });

        $app->post("/create_car", function () use ($app) {
            $new_car = new Car($_POST['make_model'],$_POST['price'], $_POST['miles'], $_POST['photo']);
            $new_car->save();
            return $app['twig']->render('create_car.twig', array('cars' => Car::getAll()));

        });

        $app->post("/delete_cars", function() use ($app) {
            Car::deleteAll();

            return $app['twig']->render('delete_cars.php');
        });

    return $app;

?>
