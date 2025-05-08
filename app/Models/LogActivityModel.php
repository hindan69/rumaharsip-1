<?php

namespace App\Models;

use CodeIgniter\Model;

class LogActivityModel extends Model
{
    protected $table = 'log_activity';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [

        'id_user',
        'role',
        'ip_address',
        'user_agent',
        'activity',
        'module',
        'method',
        'url',
        'request_data',
        'response_status',
        'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';
    protected $deletedField = '';


    protected $validationMessages = [];
    protected $skipValidation = false;

    public function getActivity()
    {
        $sql = "SELECT la.activity, la.module, la.method, la.ip_address, la.user_agent, la.role, la.created_at, u.nip, u.nama
                FROM `log_activity` la
                JOIN users u ON u.id = la.id_user";

        $query = $this->db->query($sql);
        return $query->getResult();
    }
}
