<?php
    class Restaurant
    {
        private $name;
        private $price_range;
        private $description;
        private $cuisine_id;
        private $id;

        function __construct($name, $price_range, $description, $cuisine_id, $id = null)
        {
            $this->name = $name;
            $this->price_range = $price_range;
            $this->description = $description;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;
        }

        function setId()
        {
            $this->id = intval($id);
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setPriceRange($new_price_range)
        {
            $this->price_range = intval($new_price_range);
        }

        function getPriceRange()
        {
            return $this->price_range;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function setCuisineId($new_cuisine_id)
        {
            $this->cuisine_id = intval($new_cuisine_id);
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO restaurants (name, price_range, description, cuisine_id) VALUES ('{$this->getName()}', {$this->getPriceRange()}, '{$this->getDescription()}', {$this->getCuisineId()})");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $price_range = $restaurant['price_range'];
                $description = $restaurant['description'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];
                $new_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM restaurants;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        // function delete()
        // {
        //     $executed = $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id = {$this->getId()};");
        //     if (!$executed) {
        //         return false;
        //     } else {
        //         return true;
        //     }
        // }

        static function find($search_id)
        {
            $found_restaurant = null;
            $returned_restaurants = $GLOBALS['DB']->prepare("SELECT * FROM restaurants WHERE id = :id");
            $returned_restaurants->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_restaurants->execute();
            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $price_range = $restaurant['price_range'];
                $description = $restaurant['description'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];
                if ($id == $search_id) {
                    $found_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id, $id);
                }
            }
            return $found_restaurant;
        }
    }
?>
