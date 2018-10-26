<?php

require '../vendor/autoload.php';
include '../bootstrap.php';

use App\Models\Message;
//use App\Middleware\Logging as ChatterLogging;

$config = ['settings' => ['displayErrorDetails' => true]]; 
$app = new Slim\App($config);

//app->add(new AppLogging());

$app->get('/messages', function($request, $response, $args) {
    $_message = new Message();

    $messages = $_message->all();

    $payload = [];
    foreach($messages as $_msg) {
        $payload[$_msg->id] = ['body' => $_msg->body, 'user_id' => $_msg->user_id, 'created_at' => $_msg->created_at];
    }

    return $response->withStatus(200)->withJson($payload);
});




$app->get('/', function ($request, $response, $args) {
    return "This is a catch all route for the root that doesn't do anything useful.";
});

// Run app
$app->run();