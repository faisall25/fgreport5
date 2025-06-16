<?php

namespace App\Models;

use CodeIgniter\Model;

class IdentitasModel extends Model
{
    protected $table = 'identitas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'regu',
        'stock_keeper',
        'kasie',
        'spv'
    ];
}
