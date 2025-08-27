<?php

namespace App\Models;

use CodeIgniter\Model;

class BpdModel extends Model
{
    protected $table = 'tb_bpd';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama','username', 'password', 'role', 'id_kota'];
    protected $useTimestamps = false;
}
