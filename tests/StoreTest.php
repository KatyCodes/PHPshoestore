<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }
// Test your getters and setters.
        function test_getStoreName()
        {
            //Arrange
            $id = null;
            $name = "SW 5th";
            $test_store = new Store($name, $id);
            //Act
            $result = $test_store->getName();
            //Assert
            // id is null here, but that is not what we are testing. We are only interested in student name.
            $this->assertEquals($name, $result);
        }
        function test_setName()
        {
            //Arrange
            $id = null;
            $name = "SW 5th";
            $test_store = new Store($name, $id);

            $new_name = "SW Washington";
            //Act

            $test_store->setName($new_name);
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $name = "SW 5th";
            $test_store = new Store($name, $id);
            //Act
            $result = $test_store->getId();
            //Assert
            $this->assertEquals(1, $result); //make sure id returned is the one we put in, not null.
        }

        function test_save()
        {
            //Arrange
            $id = null;
            $name = "SW 5th";
            $test_store = new Store($name, $id);
            $test_store->save();
            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            // create more than one student to make sure getAll returns them all.
            $id = null;
            $name = "SW 5th";
            $test_store = new Store($name, $id);
            $test_store->save();

            $name2 = "SW Washington";
            $test_store2 = new Store($name2, $id);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function testUpdate()
        {
            //Arrange
            $id = null;
            $name = "SW 5th";
            $test_store = new Store($name, $id);
            $test_store->save();

            $new_name = "SW Washington";
            //Act
            $test_store->update($new_name);
            //Assert
            $this->assertEquals("SW Washington", $test_store->getName());
        }

        function testDelete()
        {
            //Arrange
            $id = null;
            $name = "SW 5th";
            $test_store = new Store($name, $id);
            $test_store->save();

            $name2 = "SW 5th";
            $test_store2 = new Store($name2, $id);
            $test_store2->save();

            //Act
            $test_store->delete();
            $result = Store::getAll();
            //Assert
            $this->assertEquals([$test_store2], $result);
        }

        function testFind()
        {
            //Arrange
            $id = null;
            $name = "SW 5th";
            $test_store = new Store($name, $id);
            $test_store->save();

            $name2 = "SW 5th";
            $test_store2 = new Store($name2, $id);
            $test_store2->save();


            //Act
            $result = Store::find($test_store->getId());
            //Assert
            $this->assertEquals($test_store, $result);
        }

        function test_addBrand()
        {
            //Arrange
            $id = null;
            $name = "SW 5th";
            $test_store = new Store($name, $id);
            $test_store->save();

            $brand = "Nike";
            $test_brand = new Brand($brand, $id);
            $test_brand->save();

            $brand2 = "Nike";
            $test_brand2 = new Brand($brand2, $id);
            $test_brand2->save();

            $test_store->addBrand($test_brand);

            $test_store->addBrand($test_brand2);

            //Act
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_getBrands()
        {
          //Arrange
          $id = null;
          $name = "SW 5th";
          $test_store = new Store($name, $id);
          $test_store->save();

          $brand = "Nike";
          $test_brand = new Brand($brand, $id);
          $test_brand->save();

          $brand2 = "Nike";
          $test_brand2 = new Brand($brand2, $id);
          $test_brand2->save();

          $test_store->addBrand($test_brand);


          //Act
          $result = $test_store->getBrands();

          //Assert
          $this->assertEquals([$test_brand], $result);
        }

    }
?>
