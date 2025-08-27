<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\AduanModel;
use CodeIgniter\Controller;

class MemberController extends BaseController
{
    protected $memberModel;
    protected $aduanModel;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->aduanModel = new AduanModel();
    }

    // ========================
    // ADMIN / PENGELOLA MEMBER
    // ========================

    public function index()
    {
        $data['members'] = $this->memberModel->findAll();
        return view('member/index', $data);
    }

    public function activate($id)
    {
        $member = $this->memberModel->find($id);
        if ($member) {
            $this->memberModel->update($id, ['status' => 'Aktif']);
            return redirect()->back()->with('success', 'Member berhasil diaktifkan.');
        }
        return redirect()->back()->with('error', 'Member tidak ditemukan.');
    }

    public function deactivate($id)
    {
        $member = $this->memberModel->find($id);
        if ($member) {
            $this->memberModel->update($id, ['status' => 'Nonaktif']);
            return redirect()->back()->with('success', 'Member berhasil dinonaktifkan.');
        }
        return redirect()->back()->with('error', 'Member tidak ditemukan.');
    }

    public function view($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_members m');
        $builder->select('m.*, 
            prov.nama_provinsi AS nama_provinsi, 
            kota.nama_kota AS nama_kota, 
            kec.nama_kecamatan AS nama_kecamatan, 
            desa.nama_desa AS nama_desa');
        $builder->join('tb_provinsi prov', 'prov.id_provinsi = m.id_provinsi', 'left');
        $builder->join('tb_kota_kabupaten kota', 'kota.id_kota = m.id_kota', 'left');
        $builder->join('tb_kecamatan kec', 'kec.id_kecamatan = m.id_kecamatan', 'left');
        $builder->join('tb_desa_kelurahan desa', 'desa.id_desa = m.id_desa', 'left');
        $builder->where('m.id', $id);

        $query = $builder->get();
        $data['member'] = $query->getRowArray();

        return view('member/view_detail', $data);
    }

    // ================
    // DASHBOARD MEMBER
    // ================

    public function dashboard()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('tb_members m');
        $builder->select('m.*, 
            prov.nama_provinsi AS nama_provinsi, 
            kota.nama_kota AS nama_kota, 
            kec.nama_kecamatan AS nama_kecamatan, 
            desa.nama_desa AS nama_desa');
        $builder->join('tb_provinsi prov', 'prov.id_provinsi = m.id_provinsi', 'left');
        $builder->join('tb_kota_kabupaten kota', 'kota.id_kota = m.id_kota', 'left');
        $builder->join('tb_kecamatan kec', 'kec.id_kecamatan = m.id_kecamatan', 'left');
        $builder->join('tb_desa_kelurahan desa', 'desa.id_desa = m.id_desa', 'left');
        $builder->where('m.user_id', $userId);

        $query = $builder->get();
        $member = $query->getRowArray();

        if (!$member) {
            return redirect()->to('/login')->with('error', 'Data member tidak ditemukan.');
        }

        return view('member/dashboard_view', ['member' => $member]);
    }

    // ============
    // FORM ADUAN
    // ============

    public function aduanForm()
    {
        $session = session();
        if (!$session->get('user_id')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('member/aduan_form');
    }

    public function kirimAduan()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $rules = [
            'judul' => 'required|min_length[3]',
            'isi' => 'required|min_length[10]',
            'lampiran' => 'permit_empty|max_size[lampiran,2048]|ext_in[lampiran,jpg,jpeg,png,pdf,doc,docx]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan semua kolom terisi dengan benar.');
        }

        $lampiran = $this->request->getFile('lampiran');
        $lampiranName = null;

        if ($lampiran && $lampiran->isValid() && !$lampiran->hasMoved()) {
            $lampiranName = $lampiran->getRandomName();
            $lampiran->move('uploads/aduan', $lampiranName);
        }

        $data = [
            'user_id' => $userId,
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'lampiran' => $lampiranName,
            'status' => 'Menunggu',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->aduanModel->insert($data);

        return redirect()->to('/member/aduan')->with('success', 'Aduan berhasil dikirim.');
    }

    public function respons()
{
    $session = session();
    $userId = $session->get('user_id');

    $aduanModel = new \App\Models\AduanModel();

    // Get member's aduan with left join respons (so we can show respons if exists)
    $aduan = $aduanModel
        ->select('tb_aduan.*, tb_respons.judul as resp_judul, tb_respons.isi as resp_isi, tb_respons.lampiran as resp_lampiran')
        ->join('tb_respons', 'tb_respons.id_aduan = tb_aduan.id_aduan', 'left')
        ->where('tb_aduan.user_id', $userId)
        ->orderBy('tb_aduan.created_at', 'DESC')
        ->findAll();

    return view('member/respons', ['aduan' => $aduan]);
}




    // ===================
// PROFIL MEMBER
// ===================

    public function profile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $member = $this->memberModel
            ->where('user_id', $userId)
            ->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Data profil tidak ditemukan.');
        }

        return view('member/profile_view', [
            'member' => $member
        ]);
    }

    public function updateProfile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $member = $this->memberModel->where('user_id', $userId)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Data profil tidak ditemukan.');
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $this->memberModel->update($member['id'], $data);

        return redirect()->to('/member/profil')->with('success', 'Profil berhasil diperbarui.');
    }

}
