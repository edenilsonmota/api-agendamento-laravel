<?php

namespace App\Controllers;
use App\Services\UserService;
use App\Core\Request;
use App\Core\Response;
use Exception;

class UserController
{
    public function index()
    {
        
        // return Response::json([
        //     'users' => [
        //         ['id' => 1, 'name' => 'John Doe'],
        //         ['id' => 2, 'name' => 'Jane Doe'],
        //     ]
        // ]);
    }

    public function show($id)
    {
        // Code to show a single user
    }

    /**
     * "Cria um novo usuário com os dados fornecidos."
     * @return void
     */
    public function create()
    {
        // Pega os dados do corpo da requisição JSON
        $name = Request::input('name'); 
        $email = Request::input('email'); 
        $password = Request::input('password');

    
        // Criação do usuário
        $userService = new UserService();
        try {
            $user = $userService->create([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);
            return Response::json($user);// Retorna o usuário criado em formato JSON

        } catch (Exception $e) {
            return Response::json(['error' => "Erro ao criar usuário: " . $e->getMessage()]); // Retorna o erro em formato JSON
        }
    }

    public function update($id)
    {
        // Code to update an existing user
    }

    public function delete($id)
    {
        // Code to delete a user
    }
}
