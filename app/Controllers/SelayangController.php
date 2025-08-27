<?php

namespace App\Controllers;

use App\Models\SelayangModel;
use CodeIgniter\Controller;

class SelayangController extends BaseController
{
    protected $selayangModel;

    public function __construct()
    {
        $this->selayangModel = new SelayangModel();
    }

    public function index()
    {
        $data['title'] = 'Selayang Pandang';
        $data['selayang'] = $this->selayangModel->findAll();

        return view('admin/superadmin/tampilan/selayang/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Selayang Pandang';
        return view('admin/superadmin/tampilan/selayang/create', $data);
    }

    public function store()
    {
        // Proses upload gambar
        $file = $this->request->getFile('gambar');
        $namaFile = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/selayang', $namaFile);
        }

        $this->selayangModel->save([
            'judul'           => $this->request->getPost('judul'),
            'pengantar'       => $this->request->getPost('pengantar'),
            'latar_belakang'  => $this->request->getPost('latar_belakang'),
            'tujuan'          => $this->request->getPost('tujuan'),
            'ruang_lingkup'   => $this->request->getPost('ruang_lingkup'),
            'gambar'          => $namaFile
        ]);

        return redirect()->to('/admin/selayang-pandang')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Selayang Pandang';
        $data['selayang'] = $this->selayangModel->find($id);

        return view('admin/superadmin/tampilan/selayang/edit', $data);
    }

    public function update($id)
    {
        $dataToUpdate = [
            'judul'           => $this->request->getPost('judul'),
            'pengantar'       => $this->request->getPost('pengantar'),
            'latar_belakang'  => $this->request->getPost('latar_belakang'),
            'tujuan'          => $this->request->getPost('tujuan'),
            'ruang_lingkup'   => $this->request->getPost('ruang_lingkup')
        ];

        // Cek apakah ada gambar baru
        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/selayang', $namaFile);
            $dataToUpdate['gambar'] = $namaFile;
        }

        $this->selayangModel->update($id, $dataToUpdate);

        return redirect()->to('/admin/selayang-pandang')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->selayangModel->delete($id);
        return redirect()->to('/admin/selayang-pandang')->with('success', 'Data berhasil dihapus');
    }

    public function frontend()
    {
        $data['selayang'] = $this->selayangModel->findAll();
        return view('tentang_selayang_pandang', $data);
    }

    public function selayang()
{
    $model = new SelayangModel();
    $data['selayang'] = $model->findAll();
    return view('tentang/selayang_pandang', $data);
}

public function homeSelayang()
{
    $data['selayang'] = $this->selayangModel->findAll();
    return view('home_index', $data); // asumsi nama file view beranda adalah home_index.php
}


}
