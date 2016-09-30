<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Store.php';
    require_once __DIR__.'/../src/Brand.php';

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request; Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('home.html.twig', array('stores' => Store::getAll()));
    });

    $app->get('/store{id}', function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('brands' =>Brand::getAll(), 'store' => $store));
    });

    $app->post('/addBrand', function() use ($app) {
        $brand_name = $_POST['brand_name'];
        $brand = new Brand($brand_name);
        $brand->save();
        $store->addBrand($brand);
        return $app->redirect('/store{id}');
    });
    //
    // $app->patch('/edit_student/{id}', function($id) use ($app) {
    //     $student = Student::find($id);
    //     $new_name = $_POST['new_name'];
    //     $student->update($new_name);
    //     return $app->redirect('/student-list');
    // });
    //
    // $app->delete('/delete_student/{id}', function($id) use ($app) {
    //     $student = Student::find($id);
    //     $student->delete();
    //     return $app->redirect('/student-list');
    // });
    //
    // $app->post('/delete_all_students', function() use ($app) {
    //     Student::deleteAll();
    //     return $app->redirect('/');
    // });
    //
    // $app->get('/student_page/{id}', function($id) use ($app) {
    //     $student = Student::find($id);
    //     return $app['twig']->render('student-page.html.twig', array('student' => $student, 'courses' => $student->getCourses(), 'all_courses' => Course::getAll()));
    // });
    //
    // $app->post('/enroll_in_course/{id}', function($id) use ($app) {
    //     $course = Course::find($_POST['course_id']);
    //     $student = Student::find($id);
    //     $student->addCourses($course);
    //     return $app['twig']->render('student-page.html.twig', array('student' => $student, 'courses' => $student->getCourses(), 'all_courses' => Course::getAll()));
    // });


    return $app;
?>
