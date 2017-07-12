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
    }
?>
