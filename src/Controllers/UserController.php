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
         return Response::json(UserService::index()); // Retorna todos os usuários em formato JSON
    }

    /**
     * Retorna um usuário específico em formato JSON
     * @param $id
     * @return null
     * @throws Exception
     */
    public function show($id)
    {
        return Response::json(UserService::show($id));
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


        try {
            $user = UserService::create([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);

            return Response::json($user); // Retorna o usuário criado em formato JSON

        } catch (Exception $e) {
            return Response::json(['error' => "Erro ao criar usuário: " . $e->getMessage()]); // Retorna o erro em formato JSON
        }
    }

    /** update (patch)
     * @param $id
     * @return null
     */
    public function update($id)
    {
        $data = Request::json(); // Pega todos os dados do corpo da requisição JSON

        try {
            $user = UserService::update($id, $data);
            return Response::json($user);
        } catch (Exception $e) {
            return Response::json(['error' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    /** delete
     * @param $id
     * @return null
     * @throws Exception
     */
    public function delete($id)
    {
        return Response::json(UserService::delete($id)); // Retorna a resposta da exclusão em formato JSON
    }
}
