<?php

namespace App\Models;

use CodeIgniter\Model;

class TemplateModel extends Model
{
    protected $table = 'tb_template';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'deskripsi', 'file_template'];
    protected $useTimestamps = true;
}
