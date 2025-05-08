<?php

namespace App\Models;

use CodeIgniter\Model;

class TemplateSuratModel extends Model
{
    protected $table = 'template_surat';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id',
        'id_kategori',
        'id_sub_kategori',
        'nama_template',
        'ukuran_file',
        'path_file',
        'retensi_arsip',
        'is_deleted',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by'
    ];

    protected $useTimestamps = false; // karena pakai CURRENT_TIMESTAMP manual
    protected $returnType    = 'array';

    public function getTemplateSurat()
    {
        $sql = "SELECT k.id id_kategori, sk.id, sk.nama_sub_kategori, ts.nama_template, ts.ukuran_file, ts.retensi_arsip, ts.path_file, ts.is_deleted
        FROM sub_kategori sk
        JOIN kategori k ON sk.id_kategori = k.id
        LEFT JOIN template_surat ts ON sk.id = ts.id_sub_kategori
        WHERE k.id = '1'";

        $query = $this->db->query($sql);
        return $query->getResult();
    }
}
