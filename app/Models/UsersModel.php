<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nama',
        'NIP',
        'password',
        'pangkat',
        'golongan',
        'jabatan',
        'dl',
        'gol',
        'role',
        'created_date'
    ];

    // Jika menggunakan timestamps, aktifkan
    protected $useTimestamps = true;
    protected $createdField = 'created_date';
    protected $updatedField = '';
    protected $deletedField = '';

    protected $validationMessages = [];
    protected $skipValidation = false;


    public function getUsers()
    {
        $sql = "SELECT *
        FROM users WHERE role = 1";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function checkpassword($id)
    {
        $sql = "SELECT password FROM users WHERE role = 1 AND id = ?";
        $query = $this->db->query($sql, [$id]);
        $user = $query->getRow();

        if ($user && password_verify('123456', $user->password)) {
            return true;
        }
        return false;
    }
}
