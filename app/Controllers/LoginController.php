<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        return view('admin/login');
    }

    public function loginPost()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input kosong
        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username dan password harus diisi');
        }

        // Cari user berdasarkan username
        $user = $this->userModel->where('username', $username)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }

        // Verifikasi password
        if (password_verify($password, $user['password'])) {

            // Jika role member dan status belum aktif, tolak login
            if (strtolower($user['role']) === 'member' && $user['status'] !== 'Aktif') {
                return redirect()->back()->with('error', 'Akun Anda belum diaktivasi. Silakan tunggu persetujuan admin.');
            }

            // Set session jika login berhasil
            session()->set([
                'user_id'  => $user['id'],
                'username' => $user['username'],
                'role'     => $user['role'],
                'isLoggedIn' => true
            ]);

            // Redirect sesuai role
            switch (strtolower($user['role'])) {
                case 'superadmin':
                    return redirect()->to('/superadmin/dashboard');
                case 'bpn':
                    return redirect()->to('/bpn/dashboard');
                case 'bpw':
                    return redirect()->to('/bpw/dashboard');
                case 'bpd':
                    return redirect()->to('/bpd/dashboard');
                case 'bpdes':
                    return redirect()->to('/bpdes/dashboard');
                case 'member':
                    return redirect()->to('/member/dashboard');
                default:
                    return redirect()->to('/admin/dashboard');
            }
        }

        // Jika password salah
        return redirect()->back()->with('error', 'Password salah');
    }
}
