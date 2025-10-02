<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberCounterModel extends Model
{
    protected $table = 'member_counter';
    protected $primaryKey = 'id';
    protected $allowedFields = ['total'];
    public $useTimestamps = false;
}
