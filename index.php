<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require './init.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new \Slim\App($configuration);

require_once './routes/articles.php';
require_once './routes/botstats.php';

//$c = $app->getContainer();
//$c['phpErrorHandler'] = function ($c) {
//    return function ($request, $response, $error) use ($c) {
//        return $response->withStatus(500)
//            ->withHeader('Content-Type', 'text/html')
//            ->write('Something went wrong!');
//    };
//};

$app->run();
