<?php

namespace App\Controllers\admin\TambahAdmin;

use App\Controllers\BaseController;
use App\Models\BpnModel;

class BpnController extends BaseController
{
    protected $bpnModel;

    public function __construct()
    {
        $this->bpnModel = new BpnModel();
    }

    // Show all BPN Admins
    public function index()
    {
        $data['bpn_admins'] = $this->bpnModel->findAll();

        return view('admin/superadmin/tampilan/pengurus/index', $data);
    }

    // Form to create BPN Admin
    public function create()
    {
        return view('admin/superadmin/tampilan/pengurus/create');
    }

    // Store new BPN Admin
    public function store()
    {
        $data = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'), // added
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'BPN'
        ];

        $this->bpnModel->insert($data);

        return redirect()->to('admin/superadmin/adminbpn')->with('success', 'Akun BPN berhasil dibuat');
    }

    // Edit BPN Admin
    public function edit($id)
    {
        $data['bpn'] = $this->bpnModel->find($id);

        if ($data['bpn'] && empty($data['bpn']['role'])) {
            $data['bpn']['role'] = 'BPN';
        }

        return view('admin/superadmin/tampilan/pengurus/edit', $data);
    }

    // Update BPN Admin
    public function update($id)
    {
        $bpn = $this->bpnModel->find($id);

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'), // added
            'role'     => $bpn['role'] ?? 'BPN'
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->bpnModel->update($id, $data);

        return redirect()->to('admin/superadmin/adminbpn')->with('success', 'Data berhasil diupdate');
    }

    // Delete BPN Admin
    public function delete($id)
    {
        if ($this->bpnModel->delete($id)) {
            return redirect()->to('admin/superadmin/adminbpn')->with('success', 'Akun BPN berhasil dihapus');
        } else {
            return redirect()->to('admin/superadmin/adminbpn')->with('error', 'Gagal menghapus akun BPN');
        }
    }
}
