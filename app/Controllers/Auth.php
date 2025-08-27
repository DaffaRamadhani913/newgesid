<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SuperadminModel;
use App\Models\BpnModel;
use App\Models\BpwModel;
use App\Models\BpdModel;
use App\Models\BpdesModel;
use App\Models\MemberModel;
use App\Models\ProvinsiModel;
use App\Models\KotaKabupatenModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('admin/login');
    }

    public function loginPost()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $account = null;
        $role = null;

        // 1️⃣ Check Superadmin
        $model = new SuperadminModel();
        $account = $model->where('username', $username)->first();
        if ($account) {
            $role = 'superadmin';
        }

        // 2️⃣ Check BPN
        if (!$account) {
            $model = new BpnModel();
            $account = $model->where('username', $username)->first();
            if ($account) {
                $role = 'bpn';
            }
        }

        // 3️⃣ Check BPW
        if (!$account) {
            $model = new BpwModel();
            $account = $model->where('username', $username)->first();
            if ($account) {
                $role = 'bpw';
            }
        }

        // 4️⃣ Check BPD (Kota/Kabupaten)
        if (!$account) {
            $model = new BpdModel();
            $account = $model->where('username', $username)->first();
            if ($account) {
                $role = 'bpd';
            }
        }

        // 5️⃣ Check BPDes
        if (!$account) {
            $model = new BpdesModel();
            $account = $model->where('username', $username)->first();
            if ($account) {
                $role = 'bpdes';
            }
        }

        // 6️⃣ Check Member (tb_users)
        if (!$account) {
            $model = new UserModel();
            $account = $model->where('username', $username)->first();
            if ($account) {
                $role = 'member';
            }
        }

        // If no account found
        if (!$account) {
            return redirect()->to('/login')->with('error', 'Username atau password salah');
        }

        // 7️⃣ Verify password
        if (!password_verify($password, $account['password'])) {
            return redirect()->to('/login')->with('error', 'Username atau password salah');
        }

        // 8️⃣ Extra check for member status
        if ($role === 'member') {
            $member = (new MemberModel())->where('user_id', $account['id'])->first();

            if (!$member) {
                return redirect()->to('/login')->with('error', 'Data member tidak ditemukan.');
            }

            if ($member['status'] !== 'Aktif') {
                return redirect()->to('/login')->with('error', 'Akun Anda belum aktif. Mohon hubungi admin.');
            }

            // Save member_id in session
            session()->set('member_id', $member['id']);
        }

        // 9️⃣ Set session base data
        session()->set([
            'user_id'    => $account['id'],
            'username'   => $account['username'],
            'role'       => $role,
            'isLoggedIn' => true
        ]);

        // 🔟 Redirect based on role & add extra info
        switch ($role) {
            case 'superadmin':
                return redirect()->to('/admin/superadmin');

            case 'bpn':
                return redirect()->to('/admin/bpn');

            case 'bpw':
                // Save provinsi for BPW
                session()->set('id_provinsi', $account['id_provinsi']);
                return redirect()->to('/admin/bpw');

            case 'bpd':
                // Save kota/kabupaten for BPD (NOT kecamatan)
                session()->set('id_kota', $account['id_kota']);
                return redirect()->to('/admin/bpd');

            case 'bpdes':
                // Save desa for BPDes
                session()->set('id_desa', $account['id_desa']);
                return redirect()->to('/admin/bpdes');

            case 'member':
                return redirect()->to('/memberadmin');

            default:
                return redirect()->to('/admin/dashboard');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
