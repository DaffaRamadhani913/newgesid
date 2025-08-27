<?php

namespace App\Models;

use CodeIgniter\Model;

class VisiMisiModel extends Model
{
    protected $table            = 'tb_visi_misi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['visi', 'misi'];
    
    // Aktifkan timestamp otomatis
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
