<?php

// UP software - PHP version  8 -> php -S localhost:8080 -t public

use Webjump\Desafio\Controller\InterfaceControllerRequest;
use \Webjump\Desafio\Infrastructure\Persistence\Table;

require_once(__DIR__ . '/../vendor/autoload.php');

Table::createTable();

$path = $_SERVER['PATH_INFO'];
$routes = require __DIR__ . '/../config/routes.php';

if(!array_key_exists($path, $routes)) {
    http_response_code(404);
    exit();
}

/**
 * Class controller Variable $routesController is a name of a class
 * @var InterfaceControllerRequest $controller
 */
$routesController = $routes[$path];
$controller = new $routesController();
$controller->processRequest();