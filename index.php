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

$app->get('/cryptocurrency/{name}', function ($request, $response, $args) {

	$json = json_decode( file_get_contents( 'https://www.bitstamp.net/api/v2/ticker/'.$args['name'].'/') );
    return $response->getBody()->write(  $json->bid . '$' );
});

$app->get('/', function ($request, $response, $args) {
    return $response->getBody()->write( 'This is Home' );
});

$app->run();