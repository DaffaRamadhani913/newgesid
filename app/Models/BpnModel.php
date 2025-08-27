<?php

namespace App\Models;

use CodeIgniter\Model;

class BpnModel extends Model
{
    protected $table = 'tb_bpn';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'username', 'password', 'role'];
    protected $useTimestamps = false;
}
