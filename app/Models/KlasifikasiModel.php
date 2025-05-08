<?php

namespace App\Models;

use CodeIgniter\Model;

class KlasifikasiModel extends Model
{
    protected $table = 'klasifikasi'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'fungsi',
        'pokok',
        'descpokok',
        'sub',
        'descsub',
        'subsub',
        'descsubsub',
    ];
}
