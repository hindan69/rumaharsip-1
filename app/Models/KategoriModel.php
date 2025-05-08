<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'id',
        'nama_kategori',
    ];

    public function getKategori()
    {
        $sql = "SELECT *
        FROM kategori";
        $query = $this->db->query($sql);
        return $query->getResult();
    }
}
