<?php

use App\Controllers\UserController;
use App\Core\Router;

# definir rotas
$router = new Router();

$router->get('/users', function (){
    $controller = new UserController();
    return $controller->index();
});

$router->get('/users/{id}', function ($id){
    $controller = new UserController();
    return $controller->show($id);
});

$router->post('/users', function (){
    $controller = new UserController();
    return $controller->create();
});

$router->delete('/users/{id}', function ($id){
    $controller = new UserController();
    return $controller->delete($id);
});

return $router;