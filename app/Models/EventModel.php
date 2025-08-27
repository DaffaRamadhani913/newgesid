<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table            = 'tb_events';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['title', 'image'];
    
    // Aktifkan timestamps otomatis
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at'; // Tambahkan ini jika tabel punya kolom updated_at
}
