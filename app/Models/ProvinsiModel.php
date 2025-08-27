<?php

namespace App\Models;
use CodeIgniter\Model;


class ProvinsiModel extends Model
{
    protected $table            = 'tb_provinsi';
    protected $primaryKey       = 'id_provinsi';
    protected $allowedFields    = ['nama'];
    protected $useTimestamps    = false;

    // Jika kamu ingin menggunakan return sebagai array, bisa aktifkan ini:
    protected $returnType       = 'array';
}
