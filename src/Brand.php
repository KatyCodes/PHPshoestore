<?php
    class Brand
    {
        private $id;
        private $brand_name;

        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }
//getters & setters
        function getId()
        {
            return $this->id;
        }

        function getBrandName()
        {
            return $this->brand_name;
        }

        //methods
        function save()
       {
        //     $GLOBALS['DB']->exec("INSERT INTO brands (brand_name, store_id) VALUES ('{$this->getBrandName()}', '{$this->getStoreId()}');");
        //     $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function addStore($store)
        {
            // $GLOBALS['DB']->exec("INSERT INTO brands_stores (course_id, student_id) VALUES ({$this->getId()}, {$student->getId()});");
        }

        function getStudents()
        {
            // $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses
            //     JOIN students_courses ON (students_courses.course_id = courses.id)
            //     JOIN students ON (students.id = students_courses.student_id)
            //     WHERE courses.id = {$this->getId()};");
            //
            // $students = array();
            //
            // foreach($returned_students as $student) {
            //     $name = $student['name'];
            //     $enrollment_date = $student['enrollment_date'];
            //     $id = $student['id'];
            //     $new_student = new Student($name, $enrollment_date, $id);
            //     array_push($students, $new_student);
            // }
            // return $students;
        }


        static function find($search_id)
        {
          //   $found_course = null;
          //   $courses = Course::getAll();
          //   foreach($courses as $course) {
          //       $course_id = $course->getId();
          //       if ($course_id == $search_id) {
          //           $found_course = $course;
          //       }
          //   }
          //  return $found_course;
        }


//static methods
        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
            $courses = array();
            foreach($returned_courses as $course) {
                $course_name = $course['course_name'];
                $course_number = $course['course_number'];
                $id = $course['id'];
                $new_course = new Course($course_name, $course_number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM courses;");
        }
    }
?>
