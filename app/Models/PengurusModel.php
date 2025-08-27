<?php

namespace App\Models;

use CodeIgniter\Model;

class PengurusModel extends Model
{
    protected $table = 'tb_pengurus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'jabatan', 'deskripsi'];
    protected $useTimestamps = true;
}
