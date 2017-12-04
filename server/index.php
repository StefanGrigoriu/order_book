<?php
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

// Use Loader() to autoload our model
$loader = new Loader();

$loader->registerNamespaces(
    [
        'OrderBook\Models' => __DIR__ . '/models/',
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


// Create and bind the DI to the application
$app = new Micro($di);
// Retrieves all robots
$app->get(
    '/api/users',
    function () {
        echo 'shaworma';
        // Operation to fetch all the robots
    }
);

// Searches for robots with $name in their name
$app->get(
    '/api/users/search/{name}',
    function ($name) {
        // Operation to fetch robot with name $name
    }
);

// Retrieves robots based on primary key
$app->get(
    '/api/users/{id:[0-9]+}',
    function ($id) {
        // Operation to fetch robot with id $id
    }
);

// Adds a new robot
$app->post(
    '/api/users',
    function () use ($app) 
    {
        $users = $app->request->getJsonRawBody();
        $phql = 'INSERT INTO OrderBook\Models\Users (name, email, password) VALUES (:name:, :email:, :password:)';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'name' => $users->name,
                'email' => $users->email,
                'password' => $users->password
            ]
        );

        // Create a response
        $response = new Response();

        // Check if the insertion was successful
        if ($status->success() === true) 
        {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');

            $users->id = $status->getModel()->id_user;

            $response->setJsonContent(
                [
                    'status' => 'OK',
                    'data'   => $users,
                ]
            );
        } 
        else 
        {
            // Change the HTTP status
            $response->setStatusCode(409, 'Conflict');

            // Send errors to the client
            $errors = [];

            foreach ($status->getMessages() as $message) {
                $errors[] = $message->getMessage();
            }

            $response->setJsonContent(
                [
                    'status'   => 'ERROR',
                    'messages' => $errors,
                ]
            );
        }

        return $response;
    }
);

// Updates robots based on primary key
$app->put(
    '/api/users/{id:[0-9]+}',
    function ($id) {
        // Operation to update a robot with id $id
    }
);

// Deletes robots based on primary key
$app->delete(
    '/api/users/{id:[0-9]+}',
    function ($id) {
        // Operation to delete the robot with id $id
    }
);

$app->handle();



