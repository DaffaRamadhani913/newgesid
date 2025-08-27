<?php

namespace App\Models;

use CodeIgniter\Model;

class BpdesModel extends Model
{
    protected $table = 'tb_bpdes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama','username', 'password', 'role', 'id_desa'];
    protected $useTimestamps = false;
}
