<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = 'notifikasi'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_user',
        'id_transaksi',
        'status',
        'is_read',
        'created_date',
    ]; // Kolom yang bisa diisi

    public function getNotifikasiById($id_user)
    {
        $sql = "SELECT n.*
        FROM notifikasi n
        WHERE n.id_user = $id_user";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getNotifikasiNavbar($id_user)
    {
        $sql = "SELECT n.*
        FROM notifikasi n
        WHERE n.id_user = $id_user
        ORDER BY n.created_at DESC
        LIMIT 5";
        $query = $this->db->query($sql);
        return $query->getResult();
    }
}
