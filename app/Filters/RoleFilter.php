<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Pastikan user sudah login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil role dari session
        $userRole = strtolower($session->get('role'));

        // Jika filter dipanggil tanpa parameter
        if (!$arguments || empty($arguments[0])) {
            return redirect()->to('/')->with('error', 'Akses ditolak.');
        }

        // Ambil role yang diizinkan
        $allowedRoles = array_map('strtolower', $arguments);

        // Jika role user tidak ada di daftar allowedRoles
        if (!in_array($userRole, $allowedRoles)) {
            return redirect()->to('unauthorized')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak digunakan
    }
}
