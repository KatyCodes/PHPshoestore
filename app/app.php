<?php

    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Store.php';
    require_once __DIR__.'/../src/Brand.php';

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

      $server = 'mysql:host=localhost:8889;dbname=shoes';
      $username = 'root';
      $password = 'root';
      $DB = new PDO($server, $username, $password);


    use Symfony\Component\HttpFoundation\Request; Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('home.html.twig', array('stores' => Store::getAll(),  'brands' => Brand::getAll()));
    });

    $app->get('/store{id}', function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render("store.html.twig", array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });


    $app->post('/store{id}/addBrand', function($id) use ($app) {
        $brand = new Brand($_POST['brand']);
        $brand->save();
        $store = Store::find($id);
        $store->addBrand($brand);
        $brands = $store->getBrands();
        return $app['twig']->render('store.html.twig', array('brand' => $brands, 'store' => $store, 'all_brands' => Brand::getAll()));
    });

    $app->post('/addStore', function() use ($app) {
        $store_name = $_POST['store_name'];
        $new_store = new Store($store_name);
        $new_store->save();
        return $app['twig']->render('home.html.twig', array('brands' =>Brand::getAll(), 'store' => $new_store, 'stores' => Store::getAll()));
    });

    $app->post('/addBrand', function() use ($app){
        $brand_name = $_POST['brand'];
        $new_brand= new Brand($brand_name);
        $new_brand->save();
        return $app['twig']->render('home.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->get('/brand{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'all_stores' => $brand->getStores(), 'stores' => Store::getAll()));
    });

    $app->post('/brand{id}/addBrand', function($id) use ($app){
        $store = Store::find($_POST['store']);
        $brand = Brand::find($id);
        $brand->addStore($store);
        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'all_stores' => $brand->getStores(), 'stores' => Store::getAll(), 'brands' => Brands::getAll()));
    });

    $app->patch("/store/{id}/edit", function($id) use ($app) {
        $name = $_POST['new_name'];
        $store = Store::find($id);
        $store->update($name);
        $brands = $store->getBrands();
        return $app['twig']->render('store.html.twig', array('brands' => $brands, 'store' => $store));
      });

      $app->delete("/store/{id}/delete", function($id) use ($app) {
          $store = Store::find($id);
          $store->delete();
          $brands = $store->getBrands();
          return $app['twig']->render('home.html.twig', array('brands' => $brands, 'store' => $store, 'stores' => Store::getAll()));
        });

      $app->delete("/storeDeleteAll", function() use ($app) {
          $store = Store::deleteAll();
          return $app['twig']->render('home.html.twig', array('stores' => Store::getAll(),  'brands' => Brand::getAll()));
        });

      $app->delete("/brandDeleteAll", function() use ($app) {
          $brand = Brand::deleteAll();
          return $app['twig']->render('home.html.twig', array('stores' => Store::getAll(),  'brands' => Brand::getAll()));
        });

    return $app;
?>
