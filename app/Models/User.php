<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'users';

    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER  = 'user';

    protected $allowedFields = ['name', 'username', 'email', 'password', 'role'];
}
