<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MemberModel;

class Superadmin extends BaseController
{
    protected $userModel;
    protected $memberModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->memberModel = new MemberModel();
    }

    // =======================
    // Dashboard Superadmin
    // =======================
    public function dashboard()
    {
        $data['jumlah_bpn'] = $this->userModel->where('role', 'BPN')->countAllResults();
        $data['jumlah_bpw'] = $this->userModel->where('role', 'BPW')->countAllResults();
        $data['jumlah_bpd'] = $this->userModel->where('role', 'BPD')->countAllResults();
        $data['jumlah_bpdes'] = $this->userModel->where('role', 'BPDes')->countAllResults();
        $data['jumlah_member'] = $this->memberModel->countAllResults();
        $data['user_role'] = session()->get('role');

        return view('admin/superadmin/dashboard_view', $data);
    }

    public function dataMember(){
        $members = $this->memberModel
            ->select('tb_members.*, 
                    prov.nama_provinsi as nama_provinsi, 
                    kota.nama_kota as nama_kota, 
                    kec.nama_kecamatan as nama_kecamatan, 
                    desa.nama_desa as nama_desa')
            ->join('tb_provinsi prov', 'prov.id_provinsi = tb_members.id_provinsi', 'left')
            ->join('tb_kota_kabupaten kota', 'kota.id_kota = tb_members.id_kota', 'left')
            ->join('tb_kecamatan kec', 'kec.id_kecamatan = tb_members.id_kecamatan', 'left')
            ->join('tb_desa_kelurahan desa', 'desa.id_desa = tb_members.id_desa', 'left')
            ->findAll();

        return view('admin/superadmin/members/list_view', ['members' => $members]);
    }

    // =======================
    // CRUD Pengurus
    // =======================
    public function managePengurus()
    {
        $data['pengurus'] = $this->userModel->findAll();
        return view('admin/superadmin/pengurus/index', $data);
    }

    public function createPengurus()
    {
        return view('admin/superadmin/pengurus/create');
    }

    public function storePengurus()
    {
        $this->userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => trim($this->request->getPost('password')),
            'role' => $this->request->getPost('role')
        ]);

        return redirect()->to('/admin/superadmin/pengurus');
    }

    public function editPengurus($id)
    {
        $data['pengurus'] = $this->userModel->find($id);
        return view('admin/superadmin/pengurus/edit', $data);
    }

    public function updatePengurus($id)
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'role' => $this->request->getPost('role')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = trim($password);
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/admin/superadmin/pengurus');
    }

    public function deletePengurus($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/admin/superadmin/pengurus');
    }

    // =======================
    // Verifikasi Member
    // =======================
    public function verifikasiMember()
    {
        $members = $this->memberModel
            ->select('tb_members.*, 
                      prov.nama as nama_provinsi, 
                      kota.nama as nama_kota, 
                      kec.nama as nama_kecamatan, 
                      desa.nama as nama_desa')
            ->join('tb_provinsi prov', 'prov.id_provinsi = tb_members.id_provinsi', 'left')
            ->join('tb_kota_kabupaten kota', 'kota.id_kota = tb_members.id_kota', 'left')
            ->join('tb_kecamatan kec', 'kec.id_kecamatan = tb_members.id_kecamatan', 'left')
            ->join('tb_desa_kelurahan desa', 'desa.id_desa = tb_members.id_desa', 'left')
            ->findAll();

        return view('admin/superadmin/verifikasi_member', ['members' => $members]);
    }

    // =======================
    // Logout
    // =======================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
