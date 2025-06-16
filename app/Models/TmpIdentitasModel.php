<?php

namespace App\Models;

use CodeIgniter\Model;

class TmpIdentitasModel extends Model
{
    protected $table = 'tmpidentitas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'regu',
        'shift',
        'stock_keeper',
        'kasie',
        'spv',
        'login_time',
        'role'
    ];
}
