<?php

require 'vendor/autoload.php';
date_default_timezone_set("America/Sao_Paulo");

$app = new Slim\App();

$app->get('/hello/{name}', function ($request, $response, $args) {
    return $response->getBody()->write("Olá, " . $args['name']);
});

$app->get('/date/', function ($request, $response, $args) {
    return $response->getBody()->write( date("h:i:sa") );
});

$app->get('/', function ($request, $response, $args) {
    return $response->getBody()->write( 'This is Home' );
});

$app->run();