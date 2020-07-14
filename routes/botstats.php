<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/stats', function (Request $request, Response $response) {
    try {
        $botStats = new BotStats();
        $data = $botStats->get();
        unset($data->id);
        return$response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withJson($data, 200,JSON_FORCE_OBJECT);
    } catch (PDOException $e) {
        $data = ["success"=> false, "message"=> $e->getMessage()];
        return $response->withJson($data, 500);
    }
});

$app->post('/stats/botContacted', function (Request $request, Response $response) {
    try {
        $botStats = new BotStats();
        $data = $botStats->incrementContacted();
        unset($data->id);
        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withJson($data);
    } catch (PDOException $e) {
        $data = ["success"=> false, "message"=> $e->getMessage()];
        return $response->withJson($data, 500);
    }
});

$app->post('/stats/botChatStarted', function (Request $request, Response $response) {
    try {
        $botStats = new BotStats();
        $data = $botStats->incrementChatStarted();
        unset($data->id);
        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withJson($data);
    } catch (PDOException $e) {
        $data = ["success"=> false, "message"=> $e->getMessage()];
        return $response->withJson($data, 500);
    }
});

$app->post('/stats/botChatInterrupted', function (Request $request, Response $response) {
    try {
        $botStats = new BotStats();
        $data = $botStats->incrementChatInterrupted();
        unset($data->id);
        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withJson($data);
    } catch (PDOException $e) {
        $data = ["success"=> false, "message"=> $e->getMessage()];
        return $response->withJson($data, 500);
    }
});

$app->post('/stats/botSupportTickets', function (Request $request, Response $response) {
    try {
        $botStats = new BotStats();
        $data = $botStats->incrementSupportTickets();
        unset($data->id);
        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withJson($data);
    } catch (PDOException $e) {
        $data = ["success"=> false, "message"=> $e->getMessage()];
        return $response->withJson($data, 500);
    }
});