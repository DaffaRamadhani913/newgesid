<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\AcaraModel;

class Home extends BaseController
{
    protected $artikelModel;
    protected $acaraModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
        $this->acaraModel = new AcaraModel();
    }

    public function index()
    {
        // Ambil 4 artikel terbaru
        $latestArticles = $this->artikelModel
            ->orderBy('tanggal_publikasi', 'DESC')
            ->limit(4)
            ->findAll();

        // Ambil 3 acara terbaru (untuk homepage)
        $latestAcara = $this->acaraModel
            ->where('status', 'approved') // optional, if you track approval
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->findAll();

        return view('pages/homepage', [
            'title' => 'Beranda - GESID',
            'latestArticles' => $latestArticles,
            'acaras' => $latestAcara
        ]);
    }

    public function about()
    {
        return view('pages/about', ['title' => 'Tentang GESID']);
    }

    public function latarBelakang()
    {
        return view('pages/latar-belakang', ['title' => 'Latar Belakang']);
    }

    public function visiMisi()
    {
        return view('pages/visi-misi', ['title' => 'Visi & Misi']);
    }

    public function pengurusBpn()
    {
        return view('pages/pengurus-bpn', ['title' => 'Pengurus BPN']);
    }

    public function artikel()
    {
        return view('pages/artikel', ['title' => 'Artikel']);
    }

    public function artikelkategori($id)
    {
        $kategori_nama = [
            1 => 'Lingkungan & Keberlanjutan',
            2 => 'Pertanian & Ekonomi'
        ];

        return view('pages/artikel-kategori', [
            'title' => "Kategori " . ($kategori_nama[$id] ?? 'Tidak Diketahui'),
            'kategori_id' => $id,
            'kategori_nama' => $kategori_nama[$id] ?? 'Tidak Diketahui'
        ]);
    }

    public function detailKategori($kategori_id, $id)
    {
        $kategoriNama = $kategori_id == 1 ? 'Budaya Desa' : 'Kegiatan Desa';

        $artikel = [
            'judul' => "Acara Desa - $kategoriNama $id",
            'tanggal' => '8 Agustus 2025',
            'kategori' => $kategoriNama,
            'gambar' => "assets/img/artikel/kategori-$kategori_id-$id.jpg",
            'konten' => "Deskripsi lengkap untuk $kategoriNama ke-$id. Kegiatan ini melibatkan warga dalam berbagai acara sosial, seni, dan budaya."
        ];

        return view('artikel/detail', compact('artikel'));
    }

    public function artikelDetail($id)
    {
        $artikel = [
            'judul' => "Kegiatan Desa $id",
            'tanggal' => '5 Agustus 2025',
            'kategori' => 'Umum',
            'gambar' => "assets/img/artikel/desa-$id.jpg",
            'konten' => "Deskripsi lengkap kegiatan desa $id."
        ];

        return view('pages/artikel-detail', compact('artikel'));
    }

    public function event()
    {
        return view('pages/event', ['title' => 'Event']);
    }

    public function halamanMember()
    {
        return view('pages/member', ['title' => 'Halaman Member']);
    }

    public function caraDaftar()
    {
        return view('pages/cara-daftar', ['title' => 'Cara Daftar']);
    }

    public function formulirPendaftaran()
    {
        return view('pages/formulir-pendaftaran', ['title' => 'Formulir Pendaftaran']);
    }

    public function contact()
    {
        return view('pages/contact', ['title' => 'Contact']);
    }

    public function login()
    {
        return view('pages/login', ['title' => 'Login']);
    }
}
