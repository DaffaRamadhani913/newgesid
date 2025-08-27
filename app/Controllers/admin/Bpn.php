<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\AduanModel;
use App\Models\ArtikelModel;
use App\Models\AcaraModel;

class Bpn extends BaseController
{
    protected $memberModel;
    protected $artikelModel;
    protected $acaraModel;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->artikelModel = new ArtikelModel();
        $this->acaraModel = new AcaraModel();
    }

    public function index()
    {
        return view('admin/bpn/dashboard_view');
    }

    public function dataMember()
    {
        $members = $this->memberModel
            ->select('tb_members.*, prov.nama_provinsi, kota.nama_kota, kec.nama_kecamatan, desa.nama_desa')
            ->join('tb_provinsi prov', 'prov.id_provinsi = tb_members.id_provinsi', 'left')
            ->join('tb_kota_kabupaten kota', 'kota.id_kota = tb_members.id_kota', 'left')
            ->join('tb_kecamatan kec', 'kec.id_kecamatan = tb_members.id_kecamatan', 'left')
            ->join('tb_desa_kelurahan desa', 'desa.id_desa = tb_members.id_desa', 'left')
            ->findAll();

        return view('admin/bpn/members/list_view', ['members' => $members]);
    }

    public function verifikasiMember()
    {
        $members = $this->memberModel
            ->select('tb_members.*, prov.nama_provinsi, kota.nama_kota, kec.nama_kecamatan, desa.nama_desa')
            ->join('tb_provinsi prov', 'prov.id_provinsi = tb_members.id_provinsi', 'left')
            ->join('tb_kota_kabupaten kota', 'kota.id_kota = tb_members.id_kota', 'left')
            ->join('tb_kecamatan kec', 'kec.id_kecamatan = tb_members.id_kecamatan', 'left')
            ->join('tb_desa_kelurahan desa', 'desa.id_desa = tb_members.id_desa', 'left')
            ->findAll();

        return view('admin/bpn/verifikasi_member', ['members' => $members]);
    }

    public function listAduan()
    {
        $aduanModel = new AduanModel();
        $aduan = $aduanModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/bpn/aduan/list_aduan', ['aduan' => $aduan]);
    }

    public function kirimAduan()
    {
        $aduanModel = new AduanModel();
        $aduanModel->save([
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Umpan balik berhasil dikirim.');
    }

    // ================== ARTIKEL ==================
    public function indexArtikel()
    {
        $artikels = $this->artikelModel
            ->where('created_label', $this->resolvePublisherLabel())
            ->orderBy('tanggal_publikasi', 'DESC')
            ->findAll();

        return view('admin/bpn/artikel/index', compact('artikels'));
    }

    public function buatArtikel()
    {
        return view('admin/bpn/artikel/buat', ['title' => 'Buat Artikel Baru']);
    }

    public function simpanArtikel()
    {
        if (
            !$this->validate([
                'judul' => 'required|min_length[3]',
                'konten' => 'required',
                'gambar' => 'is_image[gambar]|max_size[gambar,100]'
            ])
        ) {
            return redirect()->back()->withInput()->with('errors', \Config\Services::validation()->getErrors());
        }

        $file = $this->request->getFile('gambar');
        $gambarPath = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/artikel', $newName);
            $gambarPath = 'uploads/artikel/' . $newName;
        }

        $this->artikelModel->insert([
            'judul' => $this->request->getPost('judul'),
            'konten' => $this->request->getPost('konten'),
            'gambar' => $gambarPath,
            'tanggal_publikasi' => date('Y-m-d H:i:s'),
            'kategori' => $this->request->getPost('kategori'),
            'status' => 'pending',
            'created_by' => session()->get('user_id'),
            'created_label' => $this->resolvePublisherLabel(),
        ]);

        return redirect()->to('/admin/bpn/artikel')->with('success', 'Artikel berhasil diupload!');
    }

    public function editArtikel($id)
    {
        $artikel = $this->artikelModel->find($id);
        if (!$artikel || $artikel['created_by'] != session()->get('user_id')) {
            return redirect()->to('/admin/bpn/artikel')->with('error', 'Artikel tidak ditemukan.');
        }
        return view('admin/bpn/artikel/edit', ['artikel' => $artikel]);
    }

    public function updateArtikel($id)
    {
        $artikel = $this->artikelModel->find($id);
        if (!$artikel || $artikel['created_by'] != session()->get('user_id')) {
            return redirect()->to('/admin/bpn/artikel')->with('error', 'Artikel tidak ditemukan.');
        }

        if (
            !$this->validate([
                'judul' => 'required|min_length[3]',
                'konten' => 'required',
                'kategori' => 'required',
                'gambar' => 'if_exist|is_image[gambar]|max_size[gambar,100]'
            ])
        ) {
            return redirect()->back()->withInput()->with('errors', \Config\Services::validation()->getErrors());
        }

        $gambar = $this->request->getFile('gambar');
        $gambarPath = $artikel['gambar'];

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            if (!empty($artikel['gambar']) && file_exists($artikel['gambar'])) {
                unlink($artikel['gambar']);
            }
            $newName = $gambar->getRandomName();
            $gambar->move('uploads/artikel', $newName);
            $gambarPath = 'uploads/artikel/' . $newName;
        }

        $this->artikelModel->update($id, [
            'judul' => $this->request->getPost('judul'),
            'kategori' => $this->request->getPost('kategori'),
            'konten' => $this->request->getPost('konten'),
            'gambar' => $gambarPath
        ]);

        return redirect()->to('/admin/bpn/artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function deleteArtikel($id)
    {
        $artikel = $this->artikelModel->find($id);
        if (!$artikel || $artikel['created_by'] != session()->get('user_id')) {
            return redirect()->to('/admin/bpn/artikel')->with('error', 'Artikel tidak ditemukan.');
        }

        if (!empty($artikel['gambar']) && file_exists($artikel['gambar'])) {
            unlink($artikel['gambar']);
        }

        $this->artikelModel->delete($id);
        return redirect()->to('/admin/bpn/artikel')->with('success', 'Artikel berhasil dihapus!');
    }

    // ================== ACARA ==================
    public function indexAcara()
    {
        $acaras = $this->acaraModel
            ->where('created_label', $this->resolvePublisherLabel())
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('admin/bpn/acara/index', ['acaras' => $acaras]);
    }

    public function buatAcara()
    {
        return view('admin/bpn/acara/create');
    }

    public function simpanAcara()
    {
        $file = $this->request->getFile('gambar');
        $filename = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads/events', $filename);
        }

        $this->acaraModel->save([
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar' => $filename,
            'created_by' => session()->get('user_id'),
            'created_label' => 'BPN',
            'status' => 'pending'
        ]);

        return redirect()->to('/admin/bpn/acara')->with('success', 'Acara berhasil dibuat dan menunggu approval.');
    }

    public function editAcara($id)
    {
        $acara = $this->acaraModel->find($id);
        if (!$acara || $acara['created_by'] != session()->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Acara tidak ditemukan');
        }

        return view('admin/bpn/acara/edit', ['acara' => $acara]);
    }

    public function updateAcara($id)
    {
        $acara = $this->acaraModel->find($id);
        if (!$acara || $acara['created_by'] != session()->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Acara tidak ditemukan');
        }

        $file = $this->request->getFile('gambar');
        $filename = $acara['gambar'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($acara['gambar']) && file_exists('uploads/events/' . $acara['gambar'])) {
                unlink('uploads/events/' . $acara['gambar']);
            }
            $filename = $file->getRandomName();
            $file->move('uploads/events', $filename);
        }

        $this->acaraModel->update($id, [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar' => $filename,
            'status' => 'pending'
        ]);

        return redirect()->to('/admin/bpn/acara')->with('success', 'Acara berhasil diperbarui dan menunggu approval.');
    }

    public function deleteAcara($id)
    {
        $acara = $this->acaraModel->find($id);
        if (!$acara || $acara['created_by'] != session()->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Acara tidak ditemukan');
        }

        if (!empty($acara['gambar']) && file_exists('uploads/events/' . $acara['gambar'])) {
            unlink('uploads/events/' . $acara['gambar']);
        }

        $this->acaraModel->delete($id);
        return redirect()->to('/admin/bpn/acara')->with('success', 'Acara berhasil dihapus.');
    }

    private function resolvePublisherLabel(): string
    {
        return 'BPN'; // all BPN content uses this label
    }

}
