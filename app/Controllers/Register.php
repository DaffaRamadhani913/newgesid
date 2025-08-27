<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\UserModel;
use App\Models\ProvinsiModel;

class Register extends BaseController
{
    public function index()
    {
        $provinsiModel = new ProvinsiModel();
        $data['provinsi'] = $provinsiModel->findAll();

        // Ganti 'formulir' sesuai nama file view di /app/Views/
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

        // Pastikan file /app/Views/akunmember.php ada
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

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userModel = new UserModel();

        // 1. Insert ke tb_users DULU
        $userModel->insert([
            'username' => $username,
            'password' => $hashedPassword,
            'role' => 'member'
        ]);

        $userId = $userModel->getInsertID(); // ✅ ambil ID user baru

        // 2. Baru insert ke tb_members, dengan user_id
        $memberModel = new MemberModel();
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
            'status' => 'Pending'
        ]);

        $session->remove('formulir_data');

        return redirect()->to('/formulir/selesai');
    }


    public function selesai()
    {
        // Pastikan file /app/Views/selesai.php ada
        return view('pages/selesai');
    }
}
