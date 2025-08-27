<?php

namespace App\Models;

use CodeIgniter\Model;

class SelayangModel extends Model
{
    protected $table = 'tb_selayang_pandang';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul',
        'pengantar',
        'latar_belakang',
        'tujuan',
        'ruang_lingkup',
        'gambar' // tambahkan kolom gambar
    ];
}
