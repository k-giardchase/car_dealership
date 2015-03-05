<?php

    class Car
    {
        private $make_model;
        private $price;
        private $miles;
        private $image;

        function __construct($make_model, $price, $miles, $image)
        {
            $this->make_model = $make_model;
            $this->price = $price;
            $this->miles = $miles;
            $this->image = $image;
        }

        function worthBuying($max_price)
        {
            return $this->price < ($max_price + 100 );
        }

        function worthMileage($max_mileage)
        {
            return $this->miles < ($max_mileage + 100);
        }

        function setMakeModel($new_make_model)
        {
            $this->make_model = $new_make_model;
        }

        function setPrice($new_price)
        {
            $this->price = $new_price;
        }

        function setMiles($new_miles)
        {
            $this->miles = $new_miles;
        }

        function getMakeModel()
        {
            return $this->make_model;
        }

        function getPrice()
        {
            return $this->price;
        }

        function getMiles()
        {
            return $this->miles;
        }

        function getImage()
        {
            return $this->image;
        }

        function setNewImage($new_image)
        {
            $this->image = $new_image;
        }

        function save()
        {
            array_push($_SESSION['total_cars'], $this);
        }

        static function getAll()
        {
            return $_SESSION['total_cars'];
        }
        static function deleteAll()
        {
            $_SESSION['total_cars'] = array();
        }
    }





?>
