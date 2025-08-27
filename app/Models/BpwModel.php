<?php

namespace App\Models;

use CodeIgniter\Model;

class BpwModel extends Model
{
    protected $table = 'tb_bpw';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama','username', 'password', 'role', 'id_provinsi'];
    protected $useTimestamps = false;
}
