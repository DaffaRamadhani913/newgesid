<?php

namespace App\Controllers;

use App\Models\VisiMisiModel;

class VisiMisiController extends BaseController
{
    protected $visiMisiModel;

    public function __construct()
    {
        $this->visiMisiModel = new VisiMisiModel();
    }

    // ===== FRONTEND - TAMPILKAN VISI MISI =====
    public function index()
    {
        $data['visiMisi'] = $this->visiMisiModel->first(); // ambil 1 data
        return view('tentang_visi_misi', $data); // jika file-nya ada di Views langsung

    }

    // ===== ADMIN - TAMPILKAN VISI MISI (READ) =====
    public function adminIndex()
    {
        $data['visiMisi'] = $this->visiMisiModel->first();
        return view('admin/superadmin/tampilan/visi_misi/index', $data);
    }

    // ===== ADMIN - TAMPILKAN FORM EDIT VISI MISI =====
    public function edit()
    {
        $data['visiMisi'] = $this->visiMisiModel->first();
        return view('admin/superadmin/tampilan/visi_misi/edit', $data);
    }

    // ===== ADMIN - SIMPAN PERUBAHAN VISI MISI =====
    public function update()
    {
        $id  = $this->request->getPost('id');
        $visi = $this->request->getPost('visi');
        $misi = $this->request->getPost('misi');

        // Validasi sederhana
        if (!$visi || !$misi) {
            return redirect()->back()->with('error', 'Visi dan Misi tidak boleh kosong.');
        }

        // Simpan data
        $this->visiMisiModel->save([
            'id'   => $id,
            'visi' => $visi,
            'misi' => $misi,
        ]);

        return redirect()->to('/admin/visi-misi')->with('success', 'Visi & Misi berhasil diperbarui.');
    }
}
