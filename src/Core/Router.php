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

    public function patch (string $uri, callable $callback)
    {
        $this->routes['PATCH'][$uri] = $callback;
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
    public function dispatch(string $method, string $uri): void
    {
        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $route => $callback) {
            // Transforma {param} em regex
            $pattern = preg_replace('#\{[^}]+\}#', '([^/]+)', $route);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Remove o match completo
                $data = call_user_func_array($callback, $matches);
                Response::json($data);
                return;
            }
        }

        Response::json(['error' => 'Not Found Router'], 404);
    }

}