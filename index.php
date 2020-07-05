<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require './init.php';

$app = new \Slim\App;

require_once './routes/articles.php';
$app->run();