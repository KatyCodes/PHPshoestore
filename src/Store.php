<?php
    class Store
    {
        private $id;
        private $name;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }
//getters & setters
        function getId()
        {
            return $this->id;
        }
        function getName()
        {
            return $this->name;
        }
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

//methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function addBrand($brand)
        {
            // $GLOBALS['DB']->exec("INSERT INTO students_courses (course_id, student_id) VALUES ({$course->getId()}, {$this->getId()});");
        }

        function getBrands()
        {
            // $returned_courses = $GLOBALS['DB']->query("SELECT courses.* FROM students
            //     JOIN students_courses ON (students_courses.student_id = students.id)
            //     JOIN courses ON (courses.id = students_courses.course_id)
            //     WHERE students.id = {$this->getId()};");
            //
            // $courses = array();
            //
            // foreach($returned_courses as $course) {
            //     $course_name = $course['course_name'];
            //     $course_number = $course['course_number'];
            //     $id = $course['id'];
            //     $new_course = new Course($course_name, $course_number, $id);
            //     array_push($courses, $new_course);
            // }
            // return $courses;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }

//static methods
        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach($stores as $store) {
                $id = $store->getId();
                if ($id == $search_id) {
                    $found_store = $store;
                }
            }
           return $found_store;
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_stores as $store) {
                $name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM stores;");
        }
    }
?>
