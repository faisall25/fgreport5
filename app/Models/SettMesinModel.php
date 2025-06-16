<?php

namespace App\Models;

use CodeIgniter\Model;

class SettMesinModel extends Model
{
    protected $table = 'settmesin';
    protected $primaryKey = 'id_sku';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id_sku',
        'nama_sku',
        'jml_mesin',
        'speed',
        'downtime'
    ];
}
