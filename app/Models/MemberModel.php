<?php

namespace App\Models;
use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'tb_members';
    protected $primaryKey = 'id';
    protected $allowedFields = [
    'user_id', 'nama', 'alamat', 'telepon', 'email', 'pekerjaan', 'foto_ktp', 'foto_wajah', 'status', 'id_provinsi', 'id_kota', 'id_kecamatan', 'id_desa'
];

}
