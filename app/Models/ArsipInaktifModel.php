<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipInaktifModel extends Model
{
    protected $table = 'arsip_inaktif';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'tahun',
        'id_box',
        'no_urut',
        'id_klasifikasi_surat',
        'id_kelompok_arsip',
        'indeks_berkas',
        'no_arsip',
        'tgl_arsip',
        'uraian_arsip',
        'id_jenis_arsip',
        'id_jenis_naskah',
        'id_tingkat_perkembangan',
        'id_jumlah_halaman',
        'id_sifat_arsip',
        'id_unit_pengelola',
        'path_arsip',
        'retensi_arsip',
        'keterangan',
        'ba_rc_itjen',
        'ba_rc_kemenkes',
        'is_deleted',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by'
    ];

    protected $useTimestamps = false; // karena pakai CURRENT_TIMESTAMP manual
    protected $returnType    = 'array';

    public function getallarsipinaktif()
    {
        $sql = "SELECT *
        FROM arsip_inaktif";
        $query = $this->db->query($sql);
        return $query->getResult();
    }
}
