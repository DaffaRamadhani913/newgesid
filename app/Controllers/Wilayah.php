<?php

namespace App\Controllers;

use App\Models\ProvinsiModel;
use App\Models\KotaModel;
use App\Models\KecamatanModel;
use App\Models\DesaModel;

class Wilayah extends BaseController
{
    public function getKota($idProvinsi)
    {
        $kotaModel = new \App\Models\KotaModel();
        $data = $kotaModel->where('id_provinsi', $idProvinsi)->findAll();
        return $this->response->setJSON($data);
    }

    public function getKecamatan($idKota)
    {
        $kecamatanModel = new \App\Models\KecamatanModel();
        $data = $kecamatanModel->where('id_kota', $idKota)->findAll();
        return $this->response->setJSON($data);
    }

    public function getDesa($idKecamatan)
    {
        $desaModel = new \App\Models\DesaModel();
        $data = $desaModel->where('id_kecamatan', $idKecamatan)->findAll();
        return $this->response->setJSON($data);
    }

}
