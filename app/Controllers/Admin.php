<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MemberModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $memberModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->memberModel = new MemberModel();
    }

    public function dashboard()
    {
        $data = [
            'jumlah_bpn'     => $this->userModel->where('role', 'BPN')->countAllResults(),
            'jumlah_bpw'     => $this->userModel->where('role', 'BPW')->countAllResults(),
            'jumlah_bpd'     => $this->userModel->where('role', 'BPD')->countAllResults(),
            'jumlah_bpdes'   => $this->userModel->where('role', 'BPDes')->countAllResults(),
            'jumlah_member'  => $this->memberModel->countAllResults(),
            'user_role'      => session()->get('role')
        ];

        return view('admin/dashboard', $data);
    }

    public function pengurus()
    {
        return view('admin/pengurus');
    }

    // ✅ GANTI NAMA 'member' AGAR TIDAK BINGUNG DENGAN 'manageMember'
    public function memberList()
    {
        $data['members'] = $this->memberModel->findAll();
        return view('admin/member/memberadmin', $data); // Pastikan file ini ADA
    }


    // =========================
    // CRUD Member
    // =========================

    public function manageMember()
    {
        $data['members'] = $this->memberModel->findAll();
        return view('admin/member/index', $data);
    }

    public function createMember()
    {
        return view('admin/member/create');
    }

    public function storeMember()
    {
        $email = $this->request->getPost('email');

        // ❗ Cegah duplikasi email
        if ($this->memberModel->where('email', $email)->countAllResults() > 0) {
            return redirect()->back()->with('error', 'Email sudah terdaftar.');
        }

        $this->memberModel->save([
            'nama'        => $this->request->getPost('nama'),
            'alamat'      => $this->request->getPost('alamat'),
            'telepon'     => $this->request->getPost('telepon'),
            'email'       => $email,
            'pekerjaan'   => $this->request->getPost('pekerjaan'),
            'foto_ktp'    => $this->request->getPost('foto_ktp'),
            'foto_wajah'  => $this->request->getPost('foto_wajah')
        ]);

        return redirect()->to('/admin/member');
    }

    public function editMember($id)
    {
        $data['member'] = $this->memberModel->find($id);
        return view('admin/member/edit', $data);
    }

    public function updateMember($id)
    {
        $this->memberModel->update($id, [
            'nama'        => $this->request->getPost('nama'),
            'alamat'      => $this->request->getPost('alamat'),
            'telepon'     => $this->request->getPost('telepon'),
            'email'       => $this->request->getPost('email'),
            'pekerjaan'   => $this->request->getPost('pekerjaan'),
            'foto_ktp'    => $this->request->getPost('foto_ktp'),
            'foto_wajah'  => $this->request->getPost('foto_wajah')
        ]);

        return redirect()->to('/admin/member');
    }

    public function deleteMember($id)
    {
        $this->memberModel->delete($id);
        return redirect()->to('/admin/member');
    }

    // =========================
    // Verifikasi Member
    // =========================

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

        return view('admin/bpn/verifikasi_member', ['members' => $members]);
    }

    // =========================
    // Dashboard Role
    // =========================

    public function superadmin()
    {
        $data = [
            'jumlah_bpn'     => $this->userModel->where('role', 'BPN')->countAllResults(),
            'jumlah_bpw'     => $this->userModel->where('role', 'BPW')->countAllResults(),
            'jumlah_bpd'     => $this->userModel->where('role', 'BPD')->countAllResults(),
            'jumlah_bpdes'   => $this->userModel->where('role', 'BPDes')->countAllResults(),
            'jumlah_member'  => $this->memberModel->countAllResults(),
            'user_role'      => session()->get('role')
        ];

        return view('admin/superadmin/dashboard_view', $data);
    }

    public function bpn()
    {
        return view('admin/bpn/dashboard_view');
    }

    public function bpw()
    {
        return view('admin/bpw/dashboard_view');
    }

    public function bpd()
    {
        return view('admin/bpd/dashboard_view');
    }

    public function bpdes()
    {
        return view('admin/bpdes/dashboard_view');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
