<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$mongo = new \MongoDB\Client();
$container = new \Slim\Container;

/* Configuration */
$container['api_key'] = 'BBuRrgbQQEYEybhaWCzneVqzkE2eFCr';
$container['db'] = $mongo->agricool;


/* Import controllers (container needed) */
require '../controllers/cooltainers.php';

/* Create the app object */
$app = new \Slim\App($container);

/* Middleware : Auth before route */
$app->add(function($request, $response, $next) {
	error_log(print_r($request->getParsedBody(), true));
	$request_key = $request->getParsedBodyParam('key');
	$api_key = $this['api_key'];
	if ($request_key == $api_key)
		return $next($request, $response);
	else 
		return $response->withStatus(405);
});


/* Routes */

/* Cooltainers routes group */
$app->group('/cooltainers', function () {

	//List
	$this->get('[/]', '\CooltainersController:listItems');

	//Show
	$this->get('/{id}', '\CooltainersController:showItem');

	//Create
	$this->post('[/]', '\CooltainersController:createItem');
});

/* Obviously : run! */
$app->run();
