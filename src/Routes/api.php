<?php

use App\Controllers\UserController;
use App\Core\Router;

# definir rotas
$router = new Router();

$router->get('/users', function (){
    $controller = new UserController();
    return $controller->index();
});


$router->post('/users', function (){
    $controller = new UserController();
    return $controller->create();
});

return $router;