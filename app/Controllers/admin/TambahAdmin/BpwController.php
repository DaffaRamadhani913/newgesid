<?php

namespace App\Controllers\admin\TambahAdmin;

use App\Controllers\BaseController;
use App\Models\BpwModel;
use App\Models\ProvinsiModel;

class BpwController extends BaseController
{
    protected $bpwModel;
    protected $provinsiModel;

    public function __construct()
    {
        $this->bpwModel = new BpwModel();
        $this->provinsiModel = new ProvinsiModel();
    }

    // Show all BPW Admins
    public function index()
    {
        // Join tb_bpw with tb_provinsi to get provinsi name
        $data['bpw_admins'] = $this->bpwModel
            ->select('tb_bpw.*, tb_provinsi.nama_provinsi')
            ->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_bpw.id_provinsi', 'left')
            ->findAll();

        return view('admin/bpn/tampilan/pengurus/index', $data);
    }

    public function create()
    {
        $data['provinsi'] = $this->provinsiModel->findAll();
        return view('admin/bpn/tampilan/pengurus/create', $data);
    }

    public function store()
    {
        $data = [
            'nama'        => $this->request->getPost('nama'),
            'username'    => $this->request->getPost('username'),
            'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'        => 'BPW',
            'id_provinsi' => $this->request->getPost('id_provinsi')
        ];

        $this->bpwModel->insert($data);

        return redirect()->to('admin/bpn/adminbpw')->with('success', 'Akun BPW berhasil dibuat');
    }

    public function edit($id)
    {
        $data['bpw'] = $this->bpwModel->find($id);
        $data['provinsi'] = $this->provinsiModel->findAll();

        if ($data['bpw'] && empty($data['bpw']['role'])) {
            $data['bpw']['role'] = 'BPW';
        }

        return view('admin/bpn/tampilan/pengurus/edit', $data);
    }

    public function update($id)
    {
        $bpw = $this->bpwModel->find($id);

        $data = [
            'nama'        => $this->request->getPost('nama'),
            'username'    => $this->request->getPost('username'),
            'role'        => $bpw['role'] ?? 'BPW',
            'id_provinsi' => $this->request->getPost('id_provinsi')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->bpwModel->update($id, $data);

        return redirect()->to('admin/bpn/adminbpw')->with('success', 'Data BPW berhasil diupdate');
    }

    public function delete($id)
    {
        if ($this->bpwModel->delete($id)) {
            return redirect()->to('admin/bpn/adminbpw')->with('success', 'Akun BPW berhasil dihapus');
        } else {
            return redirect()->to('admin/bpn/adminbpw')->with('error', 'Gagal menghapus akun BPW');
        }
    }
}
