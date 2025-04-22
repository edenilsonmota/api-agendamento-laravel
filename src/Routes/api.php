<?php

use App\Controllers\UserController;
use App\Core\Router;

# definir rotas
$router = new Router();

$router->get('/users', function (){
    $controller = new UserController();
    return $controller->index();
});


return $router;