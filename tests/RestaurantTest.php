<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Restaurant.php';
    require_once 'src/Cuisine.php';

    $server = 'mysql:host=localhost:8889;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function testGetName()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = 'EatMe';
            $price_range = 1;
            $description = 'Family-Friendly dining with meat';
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = 'EatMe';
            $price_range = 1;
            $description = 'Family-Friendly dining with meat';
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            $new_name = 'BiteMe';

            //Act
            $test_restaurant->setName($new_name);
            $result = $test_restaurant->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function testGetPriceRange()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = 'EatMe';
            $price_range = 1;
            $description = 'Family-Friendly dining with meat';
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getPriceRange();

            //Assert
            $this->assertEquals($price_range, $result);
        }

        function testSetPriceRange()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = 'EatMe';
            $price_range = 1;
            $description = 'Family-Friendly dining with meat';
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            $new_price_range = 3;

            //Act
            $test_restaurant->setPriceRange($new_price_range);
            $result = $test_restaurant->getPriceRange();

            //Assert
            $this->assertEquals($new_price_range, $result);
        }

        function testGetDescription()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = 'EatMe';
            $price_range = 1;
            $description = 'Family-Friendly dining with meat';
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getDescription();

            //Assert
            $this->assertEquals($description, $result);
        }

        function testSetDescription()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = 'EatMe';
            $price_range = 1;
            $description = 'Family-Friendly dining with meat';
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            $new_description = 'Family-UNFriendly vegetarian delights';

            //Act
            $test_restaurant->setDescription($new_description);
            $result = $test_restaurant->getDescription();

            //Assert
            $this->assertEquals($new_description, $result);
        }

        function testGetCuisineId()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = 'EatMe';
            $price_range = 1;
            $description = 'Family-Friendly dining with meat';
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals($cuisine_id, $result);
        }

        function testSetCuisineId()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = 'EatMe';
            $price_range = 1;
            $description = 'Family-Friendly dining with meat';
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            $new_cuisine_id = 3;

            //Act
            $test_restaurant->setCuisineId($new_cuisine_id);
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals($new_cuisine_id, $result);
        }

        function testSave()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = "EatMe";
            $price_range = 2;
            $description = "Family-Friendly dining with meat";
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            //Act
            $executed = $test_restaurant->save();

            //Assert
            $this->assertTrue($executed, "Restaurant not saved to database");
        }

        function testGetId()
        {
            //Arrange
            $type = 'French';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = 'MangeMoi';
            $price_range = 3;
            $description = 'Notre nourriture est bonne';
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testGetAll()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = "EatMe";
            $price_range = 2;
            $description = "Family-Friendly dining with meat";
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            $name_2 = "EatEverything";
            $price_range_2 = 1;
            $description_2 = "Buffet meat";
            $test_restaurant_2 = new Restaurant($name_2, $price_range_2, $description_2, $cuisine_id);
            $test_restaurant_2->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = "EatMe";
            $price_range = 2;
            $description = "Family-Friendly dining with meat";
            $test_restaurant = new Restaurant($name, $price_range, $description, $cuisine_id);
            $test_restaurant->save();

            $name_2 = "EatEverything";
            $price_range_2 = 1;
            $description_2 = "Buffet meat";
            $test_restaurant_2 = new Restaurant($name_2, $price_range_2, $description_2, $cuisine_id);
            $test_restaurant_2->save();

            //Act
            Restaurant::deleteAll();
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

    }

?>
