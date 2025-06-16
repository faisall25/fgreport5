<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'username', 'password', 'role', 'is_active'];
    protected $useTimestamps = false;

    protected $returnType = 'array';

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]',
        'password' => 'required|min_length[4]',
        'role'     => 'required|in_list[monitor, fgstock, kasie, admin]'
    ];
}
