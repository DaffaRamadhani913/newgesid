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
        $data['title'] = 'Verifikasi Acara';
        return view('admin/superadmin/acara/verifikasi', $data);
    }

    public function approve($id)
    {
        $this->acaraModel->update($id, ['status' => 'approved']);

        // Redirect back to whatever URL the user came from
        return redirect()->back()->with('success', 'Acara telah disetujui.');
    }

    public function reject($id)
    {
        $this->acaraModel->update($id, ['status' => 'rejected']);

        // Redirect back to whatever URL the user came from
        return redirect()->back()->with('error', 'Acara telah ditolak.');
    }
}
