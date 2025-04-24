<?php

use App\Controllers\UserController;
use App\Core\Router;

/**
 * Rotas da API
 */
$router = new Router();

/**
 * Grupo de rotas para usuários
 */
$router->group('/users', function ($router) {
    $router->get('/', fn () => (new UserController())->index());
    $router->get('/{id}', fn ($id) => (new UserController())->show($id));
    $router->post('/', fn () => (new UserController())->create());
    $router->patch('/{id}', fn ($id) => (new UserController())->update($id));
    $router->delete('/{id}', fn ($id) => (new UserController())->delete($id));
});


// Mais grupos podem ser definidos para outras funcionalidades


return $router;