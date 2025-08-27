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
        // Fetch all BPN admins from tb_bpn
        $data['bpn_admins'] = $this->bpnModel->findAll();

        // Render the view (adjust path if your view is in a different folder)
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
    $bpnModel = new BpnModel();

    $data = [
        'nama'     => $this->request->getPost('nama'),
        'username' => $this->request->getPost('username'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'     => 'BPN'
    ];

    $bpnModel->insert($data);

    return redirect()->to('admin/superadmin/adminbpn')->with('success', 'Akun BPN berhasil dibuat');
}


    // Edit BPN Admin
    public function edit($id)
    {
        $bpnModel = new BpnModel();
        $data['bpn'] = $bpnModel->find($id);

        // Pastikan role tetap 'BPN' saat edit
        if ($data['bpn'] && empty($data['bpn']['role'])) {
            $data['bpn']['role'] = 'BPN';
        }

        return view('admin/superadmin/tampilan/pengurus/edit', $data);
    }


    // Update BPN Admin
    public function update($id)
{
    $bpnModel = new BpnModel();
    $bpn = $bpnModel->find($id);

    $data = [
        'nama'     => $this->request->getPost('nama'),
        'username' => $this->request->getPost('username'),
        'role'     => $bpn['role'] ?? 'BPN'
    ];

    $password = $this->request->getPost('password');
    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $bpnModel->update($id, $data);

    return redirect()->to('admin/superadmin/adminbpn')->with('success', 'Data berhasil diupdate');
}



    // Delete BPN Admin
    public function delete($id)
    {
        $bpnModel = new BpnModel();
        if ($bpnModel->delete($id)) {
            return redirect()->to('admin/superadmin/adminbpn')->with('success', 'Akun BPN berhasil dihapus');
        } else {
            return redirect()->to('admin/superadmin/adminbpn')->with('error', 'Gagal menghapus akun BPN');
        }
    }
}
