<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\ProvinsiModel;
use App\Models\ArtikelModel;
use App\Models\AcaraModel;

class Bpw extends BaseController
{
    protected $memberModel;
    protected $provinsiModel;
    protected $artikelModel;

    protected $acaraModel;
    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->artikelModel = new ArtikelModel();
        $this->acaraModel = new AcaraModel();
    }

    public function index()
    {
        return view('admin/bpw/dashboard_view');
    }

    public function dataMember()
    {
        $idProvinsi = session()->get('id_provinsi');

        if (!$idProvinsi) {
            return redirect()->to('/login')->with('error', 'Provinsi tidak ditemukan di session');
        }

        $provinsi = $this->provinsiModel->find($idProvinsi);

        $members = $this->memberModel
            ->select('tb_members.*, tb_provinsi.nama_provinsi AS nama_provinsi')
            ->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_members.id_provinsi', 'left')
            ->where('tb_members.id_provinsi', $idProvinsi)
            ->findAll();

        return view('admin/bpw/members/list_view', [
            'members' => $members,
            'provinsi' => $provinsi,
        ]);
    }

    // ================== ARTIKEL ==================
    public function indexArtikel()
    {
        // filter artikel hanya untuk BPW (created_label sesuai provinsi user BPW ini)
        $provinsi = $this->provinsiModel->find(session()->get('id_provinsi'));
        $provinsiNama = $provinsi['nama_provinsi'] ?? 'BPW';

        $data['artikels'] = $this->artikelModel
            ->where('created_label', $provinsiNama)
            ->orderBy('tanggal_publikasi', 'DESC')
            ->findAll();

        return view('admin/bpw/artikel/index', $data);
    }

    public function buatArtikel()
    {
        return view('admin/bpw/artikel/buat', [
            'title' => 'Buat Artikel Baru'
        ]);
    }

    public function simpanArtikel()
    {
        $validation = \Config\Services::validation();

        if (
            !$this->validate([
                'judul' => 'required|min_length[3]',
                'konten' => 'required',
                'gambar' => 'is_image[gambar]|max_size[gambar,100]', // 100 KB
            ])
        ) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
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

        return redirect()->to('/admin/bpw/artikel')->with('success', 'Artikel berhasil diupload!');
    }

    public function deleteArtikel($id)
    {
        $artikel = $this->artikelModel->find($id);
        if ($artikel) {
            if (!empty($artikel['gambar']) && file_exists($artikel['gambar'])) {
                unlink($artikel['gambar']);
            }
            $this->artikelModel->delete($id);
            return redirect()->to('/admin/bpw/artikel')->with('success', 'Artikel berhasil dihapus!');
        }
        return redirect()->to('/admin/bpw/artikel')->with('error', 'Artikel tidak ditemukan.');
    }

    public function editArtikel($id)
    {
        $data['artikel'] = $this->artikelModel->find($id);
        if (!$data['artikel']) {
            return redirect()->to('/admin/bpw')->with('error', 'Artikel tidak ditemukan.');
        }
        return view('admin/bpw/artikel/edit', $data);
    }

    public function updateArtikel($id)
    {
        $artikel = $this->artikelModel->find($id);

        if (!$artikel) {
            return redirect()->to('/admin/bpw/artikel')->with('error', 'Artikel tidak ditemukan.');
        }

        $validation = \Config\Services::validation();

        if (
            !$this->validate([
                'judul' => 'required|min_length[3]',
                'konten' => 'required',
                'kategori' => 'required',
                'gambar' => 'if_exist|is_image[gambar]|max_size[gambar,100]',
            ])
        ) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
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

        return redirect()->to('/admin/bpw/artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    // =============== HELPERS ==================
    private function lookup(string $table, string $pk, $id, string $col): ?string
    {
        if (empty($id))
            return null;
        $db = \Config\Database::connect();
        $row = $db->table($table)->select($col)->where($pk, $id)->get()->getRowArray();
        return $row[$col] ?? null;
    }

    private function resolvePublisherLabel(): string
    {
        $role = strtolower((string) session()->get('role'));

        switch ($role) {
            case 'bpw': {
                $name = $this->lookup('tb_provinsi', 'id_provinsi', session()->get('id_provinsi'), 'nama_provinsi');
                return $name ?: 'BPW';
            }
            case 'bpd': {
                $name = $this->lookup('tb_kota_kabupaten', 'id_kota', session()->get('id_kota'), 'nama_kota');
                return $name ?: 'BPD';
            }
            case 'bpdes': {
                $name = $this->lookup('tb_desa_kelurahan', 'id_desa', session()->get('id_desa'), 'nama_desa');
                return $name ?: 'BPDes';
            }
            default:
                return 'BPW';
        }
    }

    public function indexAcara()
{
    $provinsi = $this->provinsiModel->find(session()->get('id_provinsi'));
    $provinsiNama = $provinsi['nama_provinsi'] ?? 'BPW';

    $acaras = $this->acaraModel
        ->where('created_label', $provinsiNama)
        ->orderBy('created_at', 'DESC')
        ->findAll();

    return view('admin/bpw/acara/index', ['acaras' => $acaras]);
}

    // Form tambah acara
    public function buatAcara()
    {
        return view('admin/bpw/acara/create');
    }

    // Simpan acara baru
    public function simpanAcara()
    {
        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads/events', $filename);
        } else {
            $filename = null;
        }

        $this->acaraModel->save([
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar' => $filename,
            'created_by' => session()->get('user_id'),
            'created_label' => $this->resolvePublisherLabel(), // ✅ Add this line
            'status' => 'pending'
        ]);

        return redirect()->to('/admin/bpw/acara')->with('success', 'Acara berhasil dibuat dan menunggu approval.');
    }
    // Form edit acara
    public function editAcara($id)
    {
        $acara = $this->acaraModel->find($id);

        if (!$acara || $acara['created_by'] != session()->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Acara tidak ditemukan');
        }

        return view('admin/bpw/acara/edit', ['acara' => $acara]);
    }

    // Update acara
    public function updateAcara($id)
    {
        $acara = $this->acaraModel->find($id);

        if (!$acara || $acara['created_by'] != session()->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Acara tidak ditemukan');
        }

        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads/events', $filename);
            if (file_exists('uploads/events/' . $acara['gambar'])) {
                unlink('uploads/events/' . $acara['gambar']);
            }
        } else {
            $filename = $acara['gambar'];
        }

        $this->acaraModel->update($id, [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar' => $filename,
            'status' => 'pending' // reset ke pending saat diupdate
        ]);

        return redirect()->to('/admin/bpw/acara')->with('success', 'Acara berhasil diperbarui dan menunggu approval.');
    }

    // Hapus acara
    public function deleteAcara($id)
    {
        $acara = $this->acaraModel->find($id);

        if (!$acara || $acara['created_by'] != session()->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Acara tidak ditemukan');
        }

        if (file_exists('uploads/events/' . $acara['gambar'])) {
            unlink('uploads/events/' . $acara['gambar']);
        }

        $this->acaraModel->delete($id);
        return redirect()->to('/admin/bpw/acara')->with('success', 'Acara berhasil dihapus.');
    }
}
