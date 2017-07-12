<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Restaurant.php';
    require_once __DIR__.'/../src/Cuisine.php';


    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=restaurant';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post('/', function() use ($app) {
        $type = $_POST['type'];
        $cuisine = new Cuisine($type);
        $cuisine->save();

        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    // $app->get('/cuisines/{id}', function($id) use ($app) {
    //     $cuisine = Cuisine::find($id);
    //     return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    // });

    return $app;
?>
