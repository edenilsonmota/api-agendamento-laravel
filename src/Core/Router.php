<?php

namespace App\Core;

/**
 * "Classe de roteamento para gerenciar as rotas da aplicação."
 */
class Router
{
    private array $routes = [];
    private string $currentGroupPrefix = '';

    public function get (string $uri, callable $callback)
    {
        $this->routes['GET'][$this->currentGroupPrefix . $uri] = $callback;
    }

    public function post (string $uri, callable $callback)
    {
        $this->routes['POST'][$this->currentGroupPrefix . $uri] = $callback;
    }

    public function put (string $uri, callable $callback)
    {
        $this->routes['PUT'][$this->currentGroupPrefix . $uri] = $callback;
    }

    public function patch (string $uri, callable $callback)
    {
        $this->routes['PATCH'][$this->currentGroupPrefix . $uri] = $callback;
    }

    public function delete (string $uri, callable $callback)
    {
        $this->routes['DELETE'][$this->currentGroupPrefix . $uri] = $callback;
    }

    public function group (string $prefix, callable $callback)
    {
        $previousPrefix = $this->currentGroupPrefix;
        $this->currentGroupPrefix .= $prefix;

        $callback($this); // Executa o bloco de definição de rotas

        $this->currentGroupPrefix = $previousPrefix; // Restaura o prefixo anterior
    }

    public function dispatch(string $method, string $uri): void
    {
        // Remove query string e barra final (menos se for apenas '/')
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $route => $callback) {
            $pattern = preg_replace('#\{[^}]+\}#', '([^/]+)', $route);
            $pattern = "#^" . rtrim($pattern, '/') . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                $data = call_user_func_array($callback, $matches);
                \App\Core\Response::json($data);
                return;
            }
        }

        \App\Core\Response::json(['error' => 'Not Found Router'], 404);
    }

}
