<?php

namespace App\Models;

use CodeIgniter\Model;

class AcaraModel extends Model
{
    protected $table = 'tb_acara';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'judul',
        'deskripsi',
        'gambar',
        'created_by',     // e.g., user id
        'created_label',  // admin name stored directly
        'status',
        'created_at',
        'updated_at'
    ];

    // Auto-manage created_at and updated_at
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Default return type
    protected $returnType = 'array';

    /**
     * Get pending acara for Superadmin verification
     */
    public function getPendingAcara()
    {
        return $this->where('status', 'pending')
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Get approved acara for public display
     */
    public function getApprovedAcara()
    {
        return $this->where('status', 'approved')
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getAllAcaraForVerification()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

}
