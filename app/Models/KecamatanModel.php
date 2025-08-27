<?php
namespace App\Models;
use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table = 'tb_kecamatan';
    protected $primaryKey = 'id_kecamatan';
    protected $allowedFields = ['id_kota', 'nama_kecamatan'];
}
