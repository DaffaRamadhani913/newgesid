<?php
namespace App\Models;
use CodeIgniter\Model;

class DesaModel extends Model
{
    protected $table = 'tb_desa_kelurahan';
    protected $primaryKey = 'id_desa';
    protected $allowedFields = ['id_kecamatan', 'nama_desa'];
}
