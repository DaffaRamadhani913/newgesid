<?php
namespace App\Models;
use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $table = 'tb_kota_kabupaten';
    protected $primaryKey = 'id_kota';
    protected $allowedFields = ['id_provinsi', 'nama_kota'];
}
