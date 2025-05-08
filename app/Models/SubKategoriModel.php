<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKategoriModel extends Model
{
    protected $table = 'sub_kategori'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_kategori',
        'nama_sub_kategori',
    ];

    public function getJenisNaskah()
    {
        $sql = "SELECT sk.id, sk.nama_sub_kategori
        FROM sub_kategori sk
        JOIN kategori k ON sk.id_kategori = k.id
        WHERE k.id = '1'";

        $query = $this->db->query($sql);
        return $query->getResult();
    }
}
