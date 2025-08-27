<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
    }

    // List all approved articles
    public function index()
    {
        $data = [
            'title' => 'Artikel - GESID',
            'artikel' => $this->artikelModel->getApprovedArticles()
        ];

        return view('pages/artikel', $data);
    }

    // List articles by category
    public function kategori($id)
    {
        $kategori_nama = [
            1 => 'Lingkungan & Keberlanjutan',
            2 => 'Pertanian & Ekonomi'
        ];

        $kategori = $kategori_nama[$id] ?? null;

        if (!$kategori) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Kategori tidak ditemukan");
        }

        $data = [
            'title' => "Kategori: $kategori",
            'kategori_id' => $id,
            'kategori_nama' => $kategori,
            'artikel' => $this->artikelModel->getByCategory($kategori)
        ];

        return view('pages/artikel-kategori', $data);
    }

    // Detail of a single article
    public function detail($id)
    {
        $artikel = $this->artikelModel->find($id);

        if (!$artikel || $artikel['status'] !== 'approved') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Artikel tidak ditemukan");
        }

        $data = [
            'title'   => $artikel['judul'],
            'artikel' => $artikel
        ];

        return view('pages/artikel-detail', $data);
    }
}
