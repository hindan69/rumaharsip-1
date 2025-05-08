<?php

namespace App\Models;

use CodeIgniter\Model;

class KotakPenyimpananModel extends Model
{
    protected $table = 'kotak_penyimpanan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_user',
        'tahun',
        'no_kotak',
        'no_awal',
        'no_akhir',
        'created_at',
        'modified_at',
    ];

    protected $useTimestamps = false;
    protected $returnType    = 'array';
}
