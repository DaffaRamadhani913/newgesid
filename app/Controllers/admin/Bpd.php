<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\AduanModel;
use App\Models\ResponsModel;
use App\Models\KotaModel;
use App\Models\ArtikelModel;
use App\Models\AcaraModel;

class Bpd extends BaseController
{
    protected $memberModel;
    protected $kotaModel;
    protected $artikelModel;

    protected $acaraModel;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->kotaModel = new KotaModel();
        $this->artikelModel = new ArtikelModel();
        $this->acaraModel = new AcaraModel();

    }

    public function index()
    {
        return view('admin/bpd/dashboard_view');
    }

    public function dataMember()
    {
        $idKota = session()->get('id_kota');

        if (!$idKota) {
            return redirect()->to('/login')->with('error', 'Kota tidak ditemukan di session');
        }

        $kota = $this->kotaModel->find($idKota);

        $members = $this->memberModel
            ->select('tb_members.*, tb_kota_kabupaten.nama_kota AS nama_kota')
            ->join('tb_kota_kabupaten', 'tb_kota_kabupaten.id_kota = tb_members.id_kota', 'left')
            ->where('tb_members.id_kota', $idKota)
            ->findAll();

        return view('admin/bpd/members/list_view', [
            'members' => $members,
            'kota' => $kota,
        ]);
    }

    // ================== ADUAN ==================
    public function listAduan()
    {
        $aduanModel = new AduanModel();
        $data['aduan'] = $aduanModel->orderBy('created_at', 'DESC')->findAll();

        return view('admin/bpd/aduan/list_aduan', $data);
    }

    public function kirimRespons($id_aduan)
    {
        $responsModel = new ResponsModel();
        $aduanModel = new AduanModel();

        $lampiranFile = $this->request->getFile('lampiran');
        $lampiranName = null;

        if ($lampiranFile && $lampiranFile->isValid() && !$lampiranFile->hasMoved()) {
            $lampiranName = $lampiranFile->getRandomName();
            $lampiranFile->move(FCPATH . 'uploads/lampiran', $lampiranName);
        }

        $responsModel->save([
            'id_aduan' => $id_aduan,
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'lampiran' => $lampiranName
        ]);

        $aduanModel->update($id_aduan, ['status' => 'Selesai']);

        return redirect()->back()->with('success', 'Aduan telah direspons');
    }

    // ================== ARTIKEL ==================
    public function indexArtikel()
    {
        $data['title'] = 'Kelola Artikel';

        // ✅ Use the same resolvePublisherLabel() logic for filtering
        $publisherLabel = $this->resolvePublisherLabel();

        $data['artikels'] = $this->artikelModel
            ->where('created_label', $publisherLabel)
            ->orderBy('tanggal_publikasi', 'DESC')
            ->findAll();

        return view('admin/bpd/artikel/index', $data);
    }

    public function buatArtikel()
    {
        return view('admin/bpd/artikel/buat', [
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
                'gambar' => 'is_image[gambar]|max_size[gambar,100]',
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

        return redirect()->to('/admin/bpd/artikel')->with('success', 'Artikel berhasil diupload!');
    }

    public function deleteArtikel($id)
    {
        $artikel = $this->artikelModel->find($id);

        if ($artikel) {
            // ✅ Use absolute path (FCPATH) for safety
            if (!empty($artikel['gambar']) && file_exists(FCPATH . $artikel['gambar'])) {
                unlink(FCPATH . $artikel['gambar']);
            }

            $this->artikelModel->delete($id);
        }

        return redirect()->to('/admin/bpd/artikel')->with('success', 'Artikel berhasil dihapus');
    }

    public function editArtikel($id)
    {
        $data['artikel'] = $this->artikelModel->find($id);
        if (!$data['artikel']) {
            return redirect()->to('/admin/bpd')->with('error', 'Artikel tidak ditemukan.');
        }
        return view('admin/bpd/artikel/edit', $data);
    }

    public function updateArtikel($id)
    {
        $artikel = $this->artikelModel->find($id);

        if (!$artikel) {
            return redirect()->to('/admin/bpd/artikel')->with('error', 'Artikel tidak ditemukan.');
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

        return redirect()->to('/admin/bpd/artikel')->with('success', 'Artikel berhasil diperbarui!');
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
                return 'BPD';
        }
    }

    public function indexAcara()
    {
        $publisherLabel = $this->resolvePublisherLabel(); // e.g., Kota name for BPD

        $acaras = $this->acaraModel
            ->where('created_label', $publisherLabel)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('admin/bpd/acara/index', ['acaras' => $acaras]);
    }


    // Form tambah acara
    public function buatAcara()
    {
        return view('admin/bpd/acara/create');
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

        return redirect()->to('/admin/bpd/acara')->with('success', 'Acara berhasil dibuat dan menunggu approval.');
    }
    // Form edit acara
    public function editAcara($id)
    {
        $acara = $this->acaraModel->find($id);

        if (!$acara || $acara['created_by'] != session()->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Acara tidak ditemukan');
        }

        return view('admin/bpd/acara/edit', ['acara' => $acara]);
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

        return redirect()->to('/admin/bpd/acara')->with('success', 'Acara berhasil diperbarui dan menunggu approval.');
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
        return redirect()->to('/admin/bpd/acara')->with('success', 'Acara berhasil dihapus.');
    }
}
