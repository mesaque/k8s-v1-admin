<?php

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


$app->get('/weather/{zipcode}', function ($request, $response, $args) {

	//http://api.openweathermap.org/data/2.5/weather?appid=3ae974851721111da5d957e6eb3082af&zip=35022280,br
	//zip=35022280,br

	$json = json_decode( file_get_contents( 'http://api.openweathermap.org/data/2.5/weather?appid=3ae974851721111da5d957e6eb3082af&zip=' .$args['zipcode'] ) );
    return $response->getBody()->write(  $json );
});


$app->get('/', function ($request, $response, $args) {
    return $response->getBody()->write( 'This is Home' );
});

$app->run();