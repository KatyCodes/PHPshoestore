<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }
// Test your getters and setters.
        function test_getBrandName()
        {
            //Arrange
            $id = null;
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name, $id);

            //Act
            $result = $test_brand->getBrandName();

            //Assert
            $this->assertEquals($brand_name, $result);
        }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals(1, $result);

        }

        function test_save()
        {
            //Arrange
            $id = null;
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name, $id);

            $test_brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $id = null;
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name, $id);
            $test_brand->save();


            $brand_name2 = "Addidas";
            $test_brand2 = new Brand($brand_name2, $id);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function testFind()
        {
            //Arrange
            $id = null;
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name, $id);
            $test_brand->save();


            $brand_name2 = "Addidas";
            $test_brand2 = new Brand($brand_name2, $id);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand->getId());
            //Assert
            $this->assertEquals($test_brand, $result);
        }

        function test_addStore()
        {
            //Arrange

            $id = null;
            $name = "SW 5th";
            $test_store = new Store($name, $id);
            $test_store->save();


            $name2 = "SW 5th";
            $test_store2 = new Store($name2, $id);
            $test_store2->save();

            $brand = "Nike";
            $test_brand = new Brand($brand, $id);
            $test_brand->save();

            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);

            //Act
            $result = $test_brand->getStores();


            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_getStores()
        {
            //Arrange
            $id = null;
            $name = "SW 5th";
            $test_store = new Store($name, $id);
            $test_store->save();


            $name2 = "SW 5th";
            $test_store2 = new Store($name2, $id);
            $test_store2->save();

            $brand = "Nike";
            $test_brand = new Brand($brand, $id);
            $test_brand->save();
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);


            //Act
            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

    }
?>
