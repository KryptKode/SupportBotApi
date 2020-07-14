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

$app->get('/keywords', function(Request $request, Response $response) {
     try {
        $article = new Article();

        $articles = $article->getAllKeyWords();
        return $response->withJson($articles, 200);
    } catch(PDOException $e) {
        $data = ["success"=> false, "message"=> $e->getMessage()];
        return $response->withJson($data, 500);
    }
});


$app->post('/articles', function(Request $request, Response $response) {
    try {
        $body = $request->getParsedBody();
        if($body && array_key_exists('description', $body)){
            $article = new Article();
            $description = $body['description'];
            $userKeywords = Keyword::getKeywords($description);
            $data = $article->getArticles($userKeywords);
            shuffle($data);
            $data = array_slice($data, 0, 3);
            return $response->withJson($data, 200)->withAddedHeader("Access-Control-Allow-Origin", "*");
        }else{
            $result = ["success"=>false, "message"=>"Description is required"];
            return $response->withJson($result, 400);
        }
    } catch(PDOException $e) {
        $data = ["success"=> false, "message"=> $e->getMessage()];
        return $response->withJson($data, 500);
    }
});

$app->post('/articles/helped', function(Request $request, Response $response) {
    try {
        $queryParams = $request->getQueryParams();
        if(array_key_exists('id', $queryParams)){
            $id = $queryParams['id'];
            $article = new Article();
            $result = $article->incrementHelpedCount($id);
            $result = ["success"=> $result, "message"=> $result ? "" : "Could not update help count"];
            return $response->withJson($result, 200);
        }else{
            $result = ["success"=>false, "message"=>"ID is required"];
            return $response->withJson($result, 400);
        }
    } catch(PDOException $e) {
        $data = ["success"=> false, "message"=> $e->getMessage()];
        return $response->withJson($data, 500);
    }
});

$app->put('/articles/notHelped', function(Request $request, Response $response) {
    try {
        $queryParams = $request->getQueryParams();
        if(array_key_exists('id', $queryParams)){
            $id = $queryParams['id'];
            $article = new Article();
            $result = $article->incrementNotHelpedCount($id);
            $result = ["success"=> $result, "message"=> $result ? "" : "Could not update count"];
            return $response->withJson($result, 200);
        }else{
            $result = ["success"=>false, "message"=>"ID is required"];
            return $response->withJson($result, 400);
        }
    } catch(PDOException $e) {
        $data = ["success"=> false, "message"=> $e->getMessage()];
        return $response->withJson($data, 500);
    }
});