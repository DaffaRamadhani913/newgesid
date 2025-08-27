<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    public function getKota($id_provinsi)
    {
        return $this->db->table('tb_kota_kabupaten')
            ->where('id_provinsi', $id_provinsi)
            ->get()
            ->getResultArray();
    }

    public function getKecamatan($id_kota)
    {
        return $this->db->table('tb_kecamatan')
            ->where('id_kota', $id_kota)
            ->get()
            ->getResultArray();
    }

    public function getDesa($id_kecamatan)
    {
        return $this->db->table('tb_desa_kelurahan')
            ->where('id_kecamatan', $id_kecamatan)
            ->get()
            ->getResultArray();
    }
}
