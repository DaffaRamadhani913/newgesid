<?php

namespace App\Controllers;

use App\Models\VisiMisiModel;
use CodeIgniter\Controller;

class AdminVisiMisiController extends BaseController
{
    protected $visiMisiModel;

    public function __construct()
    {
        $this->visiMisiModel = new VisiMisiModel();
    }

    public function index()
    {
        $data['visiMisi'] = $this->visiMisiModel->first();
        return view('admin/visi_misi/index', $data);
    }

    public function edit($id)
    {
        $data['visiMisi'] = $this->visiMisiModel->find($id);
        return view('admin/visi_misi/edit', $data);
    }

    public function update($id)
    {
        $this->visiMisiModel->update($id, [
            'visi' => $this->request->getPost('visi'),
            'misi' => $this->request->getPost('misi'),
        ]);
        return redirect()->to('/admin/visi-misi')->with('success', 'Data berhasil diperbarui.');
    }
}
