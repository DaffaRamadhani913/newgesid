<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\UserModel;
use App\Models\ProvinsiModel;

class Register extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $counter = $db->query("SELECT total FROM member_counter WHERE id = 1")->getRow();

        // Jika sudah 1000 member, tutup pendaftaran
        if ($counter && $counter->total >= 1000) {
            return view('pages/pendaftaran-ditutup'); // buat view sederhana untuk pesan
        }

        $provinsiModel = new ProvinsiModel();
        $data['provinsi'] = $provinsiModel->findAll();

        return view('pages/formulir-pendaftaran', $data);
    }


    public function saveFinalRegistration()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|valid_email',
            'pekerjaan' => 'required',
            'foto_ktp' => 'uploaded[foto_ktp]|max_size[foto_ktp,2048]|is_image[foto_ktp]',
            'foto_wajah' => 'uploaded[foto_wajah]|max_size[foto_wajah,2048]|is_image[foto_wajah]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $id_provinsi = $this->request->getPost('id_provinsi');
        $id_kota = $this->request->getPost('id_kota');
        $id_kecamatan = $this->request->getPost('id_kecamatan');
        $id_desa = $this->request->getPost('id_desa');

        if (!$id_provinsi || !$id_kota || !$id_kecamatan || !$id_desa) {
            return redirect()->back()->withInput()->with('error', 'Silakan lengkapi data wilayah hingga Desa/Kelurahan.');
        }

        // Simpan file upload
        $ktpFile = $this->request->getFile('foto_ktp');
        $wajahFile = $this->request->getFile('foto_wajah');

        $ktpName = $ktpFile->getRandomName();
        $wajahName = $wajahFile->getRandomName();

        $ktpFile->move('assets/images/verifikasi/ktp', $ktpName);
        $wajahFile->move('assets/images/verifikasi/wajah', $wajahName);

        $session = session();
        $session->set('formulir_data', [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $this->request->getPost('email'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'foto_ktp' => $ktpName,
            'foto_wajah' => $wajahName,
            'id_provinsi' => $id_provinsi,
            'id_kota' => $id_kota,
            'id_kecamatan' => $id_kecamatan,
            'id_desa' => $id_desa,
        ]);

        return redirect()->to(base_url('formulir/akun'));
    }

    public function akun()
    {
        $session = session();
        if (!$session->get('formulir_data')) {
            return redirect()->to('formulir-pendaftaran')->with('error', 'Silakan isi formulir terlebih dahulu.');
        }

        return view('pages/akunmember');
    }

    public function submit()
    {
        $session = session();
        $biodata = $session->get('formulir_data');

        if (!$biodata) {
            return redirect()->to('formulir')->with('error', 'Data tidak ditemukan. Silakan ulangi formulir.');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirm = $this->request->getPost('password_confirm');

        if ($password !== $confirm) {
            return redirect()->back()->with('error', 'Password tidak cocok');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // 🔒 1. Lock row in member_counter
        $counter = $db->query("SELECT total FROM member_counter WHERE id = 1 FOR UPDATE")->getRow();

        if ($counter->total >= 1000) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Pendaftaran sudah ditutup. Kuota 1000 member telah terpenuhi.');
        }

        // 🔑 2. Insert user
        $userModel = new UserModel();
        $userModel->insert([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'member'
        ]);
        $userId = $userModel->getInsertID();

        // 👤 3. Generate and insert member
        $memberModel = new MemberModel();

        // Generate unique Member ID
        $memberId = $memberModel->generateMemberId([
            'id_provinsi' => $biodata['id_provinsi'],
            'id_kota' => $biodata['id_kota'],
            'id_desa' => $biodata['id_desa'],
        ]);

        // Insert new member
        $memberModel->insert([
            'user_id' => $userId,
            'nama' => $biodata['nama'],
            'alamat' => $biodata['alamat'],
            'telepon' => $biodata['telepon'],
            'email' => $biodata['email'],
            'pekerjaan' => $biodata['pekerjaan'],
            'foto_ktp' => $biodata['foto_ktp'],
            'foto_wajah' => $biodata['foto_wajah'],
            'id_provinsi' => $biodata['id_provinsi'],
            'id_kota' => $biodata['id_kota'],
            'id_kecamatan' => $biodata['id_kecamatan'],
            'id_desa' => $biodata['id_desa'],
            'member_id' => $memberId,
            'status' => 'Pending'
        ]);


        // 🔢 4. Update counter
        $db->query("UPDATE member_counter SET total = total + 1 WHERE id = 1");

        $db->transComplete();

        $session->remove('formulir_data');

        return redirect()->to('/formulir/selesai');
    }

    public function selesai()
    {
        return view('pages/selesai');
    }
}
