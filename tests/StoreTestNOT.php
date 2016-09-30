<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
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

        // function test_addBrand()
        // {
        //     //Arrange
        //
        //     $id = null;
        //     $name = "SW 5th";
        //     $test_store = new Store($name, $id);
        //     $test_store->save();
        //
        //     $brand = "SW Washington";
        //     $test_brand = new Brand($brand, $id);
        //     $test_bran->save();
        //
        //     //Act
        //     $result = Store::getAll();
        //
        //     //Assert
        //     $this->assertEquals([$test_store, $test_store2], $result);
        // }

        // function test_getAllCourses()
        // {
        //     //Arrange
        //     // create more than one course to make sure getAll returns them all.
        //     $course_name = "History";
        //     $course_number = "HIS101";
        //     $test_course = new Course($course_name, $course_number);
        //     $test_course->save();
        //
        //     $course_name1 = "Math";
        //     $course_number1 = "MT101";
        //     $test_course1 = new Course($course_name, $course_number);
        //     $test_course1->save();
        //
        //     $name = "KatyCodes";
        //     $enrollment_date = "2016-09-06";
        //     $test_student = new Student($name, $enrollment_date);
        //     $test_student->save();
        //     $test_student->addCourses($test_course);
        //
        //
        //     //Act
        //     $result = $test_student->getCourses();
        //     //Assert
        //     $this->assertEquals([$test_course], $result);
        // }

    }
?>
