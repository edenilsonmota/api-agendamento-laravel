<?php

use Dotenv\Dotenv;
use App\Core\Router;

require __DIR__ . '/../vendor/autoload.php';

// Carrega o arquivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load(); 

// Carrega a configuração do banco de dados (inicializa o Eloquent)
require __DIR__ . '/../config/database.php';

// Carrega as rotas
$router = require __DIR__ . '/../src/Routes/api.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($method, $uri);
