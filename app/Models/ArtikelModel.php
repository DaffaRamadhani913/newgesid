<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'tb_artikel';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'judul',
        'konten',
        'kategori',
        'gambar',
        'tanggal_publikasi',
        'status',
        'created_by',
        'created_label',   // ⬅️ add this
    ];


    // Auto-manage created_at and updated_at
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Default return type
    protected $returnType = 'array';

    /**
     * Get only approved articles for public page
     */
    public function getApprovedArticles()
    {
        return $this->where('status', 'approved')
            ->orderBy('tanggal_publikasi', 'DESC')
            ->findAll();
    }

    /**
     * Get pending articles for Superadmin verification
     */
    public function getPendingArticles()
    {
        return $this->where('status', 'pending')
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Get articles by category (only approved ones)
     */
    public function getByCategory($kategori)
    {
        return $this->where('status', 'approved')
            ->where('kategori', $kategori)
            ->orderBy('tanggal_publikasi', 'DESC')
            ->findAll();
    }
}
