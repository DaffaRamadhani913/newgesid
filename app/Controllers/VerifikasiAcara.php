<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AcaraModel;

class VerifikasiAcara extends BaseController
{
    protected $acaraModel;

    public function __construct()
    {
        $this->acaraModel = new AcaraModel();
    }

    public function index()
    {
        $data['acaras'] = $this->acaraModel->getAllAcaraForVerification();
        $data['title'] = 'Verifikasi Acara - Superadmin';
        return view('admin/superadmin/acara/verifikasi', $data);
    }




    public function approve($id)
    {
        $this->acaraModel->update($id, ['status' => 'approved']);
        return redirect()->to('/admin/superadmin/verifikasi-acara')->with('success', 'Acara telah disetujui.');
    }

    public function reject($id)
    {
        $this->acaraModel->update($id, ['status' => 'rejected']);
        return redirect()->to('/admin/superadmin/verifikasi-acara')->with('error', 'Acara telah ditolak.');
    }
}
