<?php

namespace App\Core;
use App\Core\Response;

#criando um roteador simples
class Router
{
    private array $routes = [];

    public function get (string $uri, callable $callback)
    {
        $this->routes['GET'][$uri] = $callback;
    }

    public function post (string $uri, callable $callback)
    {
        $this->routes['POST'][$uri] = $callback;
    }

    public function put (string $uri, callable $callback)
    {
        $this->routes['PUT'][$uri] = $callback;
    }

    public function delete (string $uri, callable $callback)
    {
        $this->routes['DELETE'][$uri] = $callback;
    }


    /**
     * "Dispara a rota correspondente ao método e URI fornecidos."
     * @param string $method
     * @param string $uri
     * @return void
     */
    public function dispatch(string $method, string $uri)
    {
        $callback = $this->routes[$method][$uri] ?? null;

        if ($callback) {
            $data = $callback(); 
            Response::json($data);
        } else {
            Response::json(['error' => 'Not Found Router'], 404);
        }
    }
}