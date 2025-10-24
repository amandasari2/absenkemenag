<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'role'];

    public function login($username)
    {
        return $this->where('username', $username)->first();
    }
}
