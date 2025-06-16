<?php

namespace App\Models;

use CodeIgniter\Model;

class LineModel extends Model
{
    protected $table = 'line';
    protected $primaryKey = 'id_line';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id_line',
        'nama_line'
    ];
}
