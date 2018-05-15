<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use  Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Registry;

// function errorHandler($code, $error_message)
// {
//     throw new \OrderBook\Exceptions\HTTPException($error_message, '500');
// }
// set_error_handler('errorHandler', 2147483647);
// use \OrderBook\Exceptions\HTTPException;
try {
  // Use Loader() to autoload our model
$loader = new Loader();

$loader->registerNamespaces(
    [
        'OrderBook\Models' => __DIR__ . '/models/'
        , 'OrderBook\Controllers' => __DIR__ . '/controllers/'
        , 'OrderBook\Utils' => __DIR__.'/utils/'
        , 'OrderBook\Exceptions' => __DIR__.'/exceptions/'
    ]
);

$loader->register();

$di = new FactoryDefault();

// Set up the database service
$di->set(
    'db',
    function () {
        return new PdoMysql(
            [
                'host'     => 'localhost',
                'username' => 'root',
                'password' => '',
                'dbname'   => 'order_book',
            ]
        );
    }
);

$di->set('security', function()
{
    return new \OrderBook\Controllers\Security();
});
//Created a class registry that will save 
//the information and you can access the data
// threw all the classes (static method)
$di->set('registry', function()
{
    return new \Phalcon\Registry();
}, true);


$di->setShared('requestBody', function()
{
    $in = file_get_contents('php://input');
    $in = json_decode($in, true);
    return $in;
});

// $di->set(
//     "modelsManager",
//     function() {
//         return new ModelsManager();
//     }
// );

// Create and bind the DI to the application
$app = new Micro($di);

// include __DIR__. '/routes/routes.php';
include __DIR__. '/routes/routes.php';
$app->before(function() use ($app, $di)
{
    // var_dump($app->getRouter()->getMatchedRoute()->getPattern());
    // exit();
    if($app->getRouter()->getMatchedRoute()->getPattern() == '/orders/verify/{id}')
    {
        // return true;
    }
    else
    {
        $security = $di->getSecurity();
        $role = $security->checkAccess(['email' => $app->request->getServer('PHP_AUTH_USER'), 'password' => $app->request->getServer('PHP_AUTH_PW')]);
        return $role;
    }
});



$app->notFound(function() use ($app)
{
    // throw new \OrderBook\Exceptions\HTTPException('routeNotFound', 404);
});

$app->after(function() use ($app)
{
    return $app->getReturnedValue();
});

$app->handle();
// Retrieves all robots  
}
catch(\OrderBook\Exceptions\HTTPException $e)
{
    $e->send();
}
catch(\Exceptions $e)
{
    $e->send();
}

