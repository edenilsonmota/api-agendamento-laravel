<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Response;

class UserModel extends Model
{
    protected $table = 'users'; // Nome da tabela
    protected $fillable = ['name', 'email', 'password']; // Campos
    public $timestamps = true; // Habilita os timestamps (created_at e updated_at)

    public static function getAllUsers()
    {
        return self::select('id', 'name', 'email', 'status', 'created_at')
            //->where('status', 1) // Filtra apenas usuários ativos
            ->get();
    }

    public static function getById(int $id)
    {
        return self::select('id', 'name', 'email', 'status', 'created_at')
            ->where('id', $id)
            ->first();
    }

    public static function createUser(array $data)
    {
        $user = new self();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_BCRYPT); // Criptografa a senha
        $user->status = 1; // Define o status como ativo

        if (!$user->save()) {
            throw new \Exception(Response::json(["error" => "Erro ao criar usuário"], 500));
        }

        return $user;
    }
}