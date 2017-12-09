<?php
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use  Phalcon\Mvc\Model\Manager as ModelsManager;
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

include __DIR__. '/routes/routes.php';

$app->before(function() use ($app, $di)
{
        // var_dump($app->getRouter()->getMatchedRoute()->getPattern());
});

$app->after(function() use ($app)
{
    return $app->getReturnedValue();
});

$app->notFound(function() use ($app)
{
    throw new \OrderBook\Exceptions\HTTPException('routeNotFound', 404);
});

$app->handle();
// Retrieves all robots  
}
catch(\OrderBook\Exceptions\HTTPException $e)
{
    return $e;
}
catch(\Exceptions $e)
{
    return $e;
}

