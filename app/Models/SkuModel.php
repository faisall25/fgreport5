<?php

namespace App\Models;

use CodeIgniter\Model;

class SkuModel extends Model
{
    protected $table = 'sku';
    protected $primaryKey = 'id_sku';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id_line',
        'id_sku',
        'nama_sku',
        'jml_karton',
        'nama_line',
        'isi_karton',
        'std_etiket'
    ];
}
