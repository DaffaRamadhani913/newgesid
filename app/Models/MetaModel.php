<?php

namespace App\Models;

use CodeIgniter\Model;

class MetaModel extends Model
{
    protected $table            = 'tb_meta';
    protected $primaryKey       = 'id_meta';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields    = [
        'nama_halaman',
        'deskripsi_halaman',
        'title',
        'meta_desc',
    ];

    // Jika kamu tidak pakai timestamps, set ini ke false
    protected $useTimestamps = false;

    // Validasi (opsional)
    protected $validationRules = [
        'nama_halaman'      => 'required|max_length[255]',
        'deskripsi_halaman' => 'required|max_length[255]',
        'title'             => 'permit_empty|string',
        'meta_desc'         => 'permit_empty|string',
    ];
}
