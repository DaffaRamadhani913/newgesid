<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'tb_admin';
    protected $primaryKey = 'admin_id';

    protected $allowedFields = [
        'admin_username', 'admin_password', 'admin_email',
        'admin_nama_lengkap', 'admin_role', 'admin_wilayah',
        'admin_status', 'admin_created_at', 'admin_updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'admin_created_at';
    protected $updatedField  = 'admin_updated_at';

    protected $returnType    = 'array';

    public function getActiveAdminByUsername($username)
    {
        return $this->where([
            'admin_username' => $username,
            'admin_status'   => 'active'
        ])->first();
    }

    
}
