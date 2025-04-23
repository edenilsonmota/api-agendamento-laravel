<?php

namespace App\Services;

use Exception;
use App\Core\Response;
use App\Models\UserModel;

//validação de dadosa antes de salvar no banco de dados
class UserService
{
    public function create(array $data)
    {
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception(Response::json(['error' => 'Email inválido'], 400));
        }

        if(strlen($data['password']) < 6) {
            throw new Exception(Response::json(['error' => 'A senha deve ter pelo menos 6 caracteres'], 400));
        }

        if ($data['name'] === '') {
            throw new Exception(Response::json(['error' => 'O nome não pode ser vazio'], 400));
        }

        return UserModel::createUser($data);
    }
}