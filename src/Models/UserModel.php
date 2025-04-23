<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Nome da tabela no banco de dados
    protected $fillable = ['name', 'email', 'password']; // Campos que podem ser preenchidos em massa
    public $timestamps = true; // Habilita os timestamps (created_at e updated_at)

    public static function createUser(array $data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return self::create(attributes: $data);
    }
}