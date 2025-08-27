<?php

namespace App\Models;

use CodeIgniter\Model;

class SuperadminModel extends Model
{
    protected $table = 'tb_superadmin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'role'];
    protected $useTimestamps = false;
}
