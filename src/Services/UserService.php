<?php

namespace App\Services;

use Exception;
use App\Core\Response;
use App\Models\UserModel;

/**
 * "Classe de serviço para gerenciar usuários."
 * @package App\Services
 */
class UserService
{
    public static function index()
    {
        return UserModel::getAllUsers();
    }

    public static function show($id)
    {
        if(!isset($id)) {
            throw new Exception(Response::json(['error' => 'ID não fornecido'], 400));
        }

        if(!is_numeric($id)) {
            throw new Exception(Response::json(['error' => 'ID inválido'], 400));
        }

        return UserModel::getById($id);
    }


    public static function create(array $data)
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

    public static function update($id, array $data)
    {
        if (!isset($id)) {
            throw new Exception(Response::json(['error' => 'ID não fornecido'], 400));
        }

        if(!is_numeric($id)) {
            throw new Exception(Response::json(['error' => 'ID inválido'], 400));
        }

        //retornar os campos que podem ser atualizados
        $fillable = (new UserModel())->getFillable();

        foreach ($data as $column => $value) {
            if (!in_array($column, $fillable)) {
                throw new \Exception(Response::json("Coluna $column não permitida para atualização", 400));
            }
        }

        return UserModel::updateUser($id, $data);


    }

    public static function delete($id)
    {
        if (!isset($id)) {
            throw new Exception(Response::json(['error' => 'ID não fornecido'], 400));
        }

        if(!is_numeric($id)) {
            throw new Exception(Response::json(['error' => 'ID inválido'], 400));
        }

        $user = UserModel::find($id);

        if (!$user) {
            throw new \Exception(Response::json(['error' => 'Usuário não encontrado'], 404));
        }

        return UserModel::deleteUser($id);
    }
}