<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//get all cards
$app->get('/articles', function(Request $request, Response $response) {
    try {
        $article = new Article();
        $articles = $article->get();
        return $response->withJson($articles, 200);
    } catch(PDOException $e) {
        $data = ["success"=> false, "message"=> $e->getMessage()];
        return $response->withJson($data, 500);
    }
});