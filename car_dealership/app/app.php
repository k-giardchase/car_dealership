<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    session_start();
    if(empty($_SESSION['list_of_cars'])){
        $_SESSION['list_of_cars'] = array();
        }


    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


    $app->get("/", function() use ($app){

        return $app['twig']->render('search_car.twig');
    });

    $app->get("search_result", function() use ($app) {
        $porsche = new Car("2014 Porsche 911", 114991, 7684);
        $ford = new Car("2011 Ford F450", 55995, 14241);
        $lexus = new Car("2013 Lexus RX 350", 44700, 20000);
        $mercedes = new Car("Mercedes Benz CLS550", 399000, 37979);

        $cars = array($porsche, $ford, $lexus, $mercedes);

        $search_results = array();
            foreach($cars as $car) {
                if($car->worthBuying($_GET['price']) && ($car->worthMileage($_GET['miles']))) {
                    array_push($search_results, $car);
                }
            }

        return $app['twig']->render('cars.twig', array('list_of_cars' => $search_results));

    });

    // $app->post("/new_car", function () use ($app) {
    //     $new_car = new Car($_POST['make_model'],$_POST['price'], $_POST['miles']);
    //
    //     return $app['twig']->render('create_car.twig');
    // });
    //
    return $app;

?>
