<?php

namespace App\Models;

use CodeIgniter\Model;

class SettTargetModel extends Model
{
    protected $table = 'setttarget';
    protected $primaryKey = 'id_sku';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id_sku',
        'nama_line',
        'nama_sku',
        'target',
        'keterangan',
        'id_line'
    ];
}
