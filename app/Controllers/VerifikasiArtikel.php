<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class VerifikasiArtikel extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
    }

    // Show all pending articles
    public function index()
    {
        $data['artikel'] = $this->artikelModel->findAll(); // show all articles
        return view('admin/superadmin/artikel/verifikasi', $data);
    }


    // Approve an article
    public function approve($id)
    {
        $artikelModel = new ArtikelModel();
        $artikel = $artikelModel->find($id);

        if (!$artikel) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
        }

        // selalu update status ke approved
        $artikelModel->update($id, [
            'status' => 'approved'
        ]);

        return redirect()->back()->with('success', 'Artikel berhasil disetujui.');
    }

    // Reject an article
    public function reject($id)
    {
        $artikelModel = new ArtikelModel();
        $artikel = $artikelModel->find($id);

        if (!$artikel) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
        }

        // selalu update status ke rejected
        $artikelModel->update($id, [
            'status' => 'rejected'
        ]);

        return redirect()->back()->with('success', 'Artikel berhasil ditolak.');
    }
}
