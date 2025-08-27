<?php

namespace App\Models;

use CodeIgniter\Model;

class ResponsModel extends Model
{
    protected $table = 'tb_respons';
    protected $primaryKey = 'id_respons';
    protected $allowedFields = ['id_aduan', 'judul', 'isi', 'lampiran'];
    protected $useTimestamps = true;
}
