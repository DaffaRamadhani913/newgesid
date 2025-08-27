<?php

namespace App\Models;

use CodeIgniter\Model;

class AduanModel extends Model
{
    protected $table            = 'tb_aduan';
    protected $primaryKey       = 'id_aduan';
    protected $allowedFields    = ['judul', 'isi', 'lampiran', 'user_id', 'status'];
    protected $useTimestamps    = true;
}
