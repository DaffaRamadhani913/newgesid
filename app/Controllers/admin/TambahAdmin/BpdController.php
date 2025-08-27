<?php

namespace App\Controllers\admin\TambahAdmin;

use App\Controllers\BaseController;
use App\Models\BpdModel;
use App\Models\KotaModel;

class BpdController extends BaseController
{
    protected $bpdModel;
    protected $kotaModel;

    public function __construct()
    {
        $this->bpdModel = new BpdModel();
        $this->kotaModel = new KotaModel();
    }

    // Show all BPD Admins
    public function index()
    {
        // Join tb_bpd with tb_kota_kabupaten to get kota name
        $data['bpd_admins'] = $this->bpdModel
            ->select('tb_bpd.*, tb_kota_kabupaten.nama_kota')
            ->join('tb_kota_kabupaten', 'tb_kota_kabupaten.id_kota = tb_bpd.id_kota', 'left')
            ->findAll();

        return view('admin/bpw/tampilan/pengurus/index', $data);
    }

    public function create()
    {
        $data['kota'] = $this->kotaModel->findAll();
        return view('admin/bpw/tampilan/pengurus/create', $data);
    }

    public function store()
    {
        $data = [
            'nama'      => $this->request->getPost('nama'),
            'username'  => $this->request->getPost('username'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'      => 'BPD',
            'id_kota'   => $this->request->getPost('id_kota')
        ];

        $this->bpdModel->insert($data);

        return redirect()->to('admin/bpw/adminbpd')->with('success', 'Akun BPD berhasil dibuat');
    }

    public function edit($id)
    {
        $data['bpd'] = $this->bpdModel->find($id);
        $data['kota'] = $this->kotaModel->findAll();

        if ($data['bpd'] && empty($data['bpd']['role'])) {
            $data['bpd']['role'] = 'BPD';
        }

        return view('admin/bpw/tampilan/pengurus/edit', $data);
    }

    public function update($id)
    {
        $bpd = $this->bpdModel->find($id);

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'role'     => $bpd['role'] ?? 'BPD',
            'id_kota'  => $this->request->getPost('id_kota')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->bpdModel->update($id, $data);

        return redirect()->to('admin/bpw/adminbpd')->with('success', 'Data BPD berhasil diupdate');
    }

    public function delete($id)
    {
        if ($this->bpdModel->delete($id)) {
            return redirect()->to('admin/bpw/adminbpd')->with('success', 'Akun BPD berhasil dihapus');
        } else {
            return redirect()->to('admin/bpw/adminbpd')->with('error', 'Gagal menghapus akun BPD');
        }
    }
}
