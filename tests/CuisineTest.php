<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Cuisine.php';
    require_once 'src/Restaurant.php';

    $server = 'mysql:host=localhost:8889;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function testGetType()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);

            //Act
            $result = $test_cuisine->getType();

            //Assert
            $this->assertEquals($type, $result);
        }

        function testSetType()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $new_type = 'Chinese';

            //Act
            $test_cuisine->setType($new_type);
            $result = $test_cuisine->getType();

            //Assert
            $this->assertEquals('Chinese', $result);
        }

        function testSave()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);

            //Act
            $executed = $test_cuisine->save();

            //Assert
            $this->assertTrue($executed, "The cuisine was not saved to the database");
        }

        function testGetId()
        {
            //Arrange
            $type = 'Chinese';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            //Act
            $result = $test_cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testGetAll()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            $type_2 = 'Mexican';
            $test_cuisine_2 = new Cuisine($type_2);
            $test_cuisine_2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $type = 'American';
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            $type_2 = 'Mexican';
            $test_cuisine_2 = new Cuisine($type_2);
            $test_cuisine_2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testFind()
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
            $result = Restaurant::find($test_restaurant->getId());

            //Assert
            $this->assertEquals($test_restaurant, $result);
        }

        function testGetRestaurants()
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
            $result = $test_cuisine->getRestaurants();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant_2], $result);
        }
    }
?>
