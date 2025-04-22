<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = require __DIR__ . '/../src/Routes/api.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($method, $uri);
