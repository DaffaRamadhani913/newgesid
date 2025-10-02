<?php

namespace App\Models;
use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'tb_members';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'nama',
        'alamat',
        'telepon',
        'email',
        'pekerjaan',
        'foto_ktp',
        'foto_wajah',
        'status',
        'id_provinsi',
        'id_kota',
        'id_kecamatan',
        'id_desa',
        'member_id' // ✅ tambahkan supaya bisa disimpan ke DB
    ];

    /**
     * Generate Member ID
     * Format: prov(2) + kota(2) + desa(4) + seq(5)
     */
    public function generateMemberId(array $data): string
    {
        $prov = str_pad($data['id_provinsi'], 2, "0", STR_PAD_LEFT);
        $kota = str_pad(substr($data['id_kota'], -2), 2, "0", STR_PAD_LEFT);
        $desa = str_pad(substr($data['id_desa'], -4), 4, "0", STR_PAD_LEFT);

        // Hitung jumlah member di desa ini
        $count = $this->where('id_desa', $data['id_desa'])->countAllResults() + 1;

        // Format urutan (5 digit)
        $seq = str_pad($count, 5, "0", STR_PAD_LEFT);

        // Gabungkan jadi member_id
        return $prov . $kota . $desa . $seq;
    }
}
