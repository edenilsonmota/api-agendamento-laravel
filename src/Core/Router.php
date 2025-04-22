<?php

namespace App\Core;

#criando um roteador simples
class Router
{
    private array $routes = [];

    public function get (string $uri, callable $callback)
    {
        $this->routes['GET'][$uri] = $callback;
    }

    public function dispatch(string $method, string $uri)
    {
        $callback = $this->routes[$method][$uri] ?? null;

        if ($callback) {
            $response = $callback();
            header('Content-Type: application/json');
            echo json_encode($response);
        }else {
            http_response_code(404);
            echo json_encode(['error' => 'Not Found Router']);
        }
    }
}