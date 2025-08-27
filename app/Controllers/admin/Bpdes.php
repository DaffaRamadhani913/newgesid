<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\AduanModel;
use App\Models\ResponsModel;
use App\Models\DesaModel;
use App\Models\AcaraModel;
class Bpdes extends BaseController
{
    protected $memberModel;
    protected $desaModel;
    protected $artikelModel;

    protected $acaraModel;
    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->desaModel = new DesaModel();
        $this->artikelModel = new \App\Models\ArtikelModel();
        $this->acaraModel = new AcaraModel();
    }

    public function index()
    {
        return view('admin/bpdes/dashboard_view');
    }

    public function dataMember()
    {
        $idDesa = session()->get('id_desa');
        if (!$idDesa)
            return redirect()->to('/login')->with('error', 'Desa tidak ditemukan di session');

        $desa = $this->desaModel->find($idDesa);
        $members = $this->memberModel
            ->select('tb_members.*, tb_desa_kelurahan.nama_desa AS nama_desa')
            ->join('tb_desa_kelurahan', 'tb_desa_kelurahan.id_desa = tb_members.id_desa', 'left')
            ->where('tb_members.id_desa', $idDesa)
            ->findAll();

        return view('admin/bpdes/members/list_view', compact('members', 'desa'));
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

        return view('admin/bpdes/verifikasi_member', ['members' => $members]);
    }

    public function listAduan()
    {
        $aduanModel = new AduanModel();
        $aduan = $aduanModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/bpdes/aduan/list_aduan', compact('aduan'));
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
        $publisherLabel = $this->resolvePublisherLabel();
        $artikels = $this->artikelModel
            ->where('created_label', $publisherLabel)
            ->orderBy('tanggal_publikasi', 'DESC')
            ->findAll();

        return view('admin/bpdes/artikel/index', compact('artikels'));
    }

    public function buatArtikel()
    {
        return view('admin/bpdes/artikel/buat', ['title' => 'Buat Artikel Baru']);
    }

    public function simpanArtikel()
    {
        if (
            !$this->validate([
                'judul' => 'required|min_length[3]',
                'konten' => 'required',
                'gambar' => 'is_image[gambar]|max_size[gambar,100]',
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

        return redirect()->to('/admin/bpdes/artikel')->with('success', 'Artikel berhasil diupload!');
    }

    public function editArtikel($id)
    {
        $artikel = $this->artikelModel->find($id);
        if (!$artikel)
            return redirect()->to('/admin/bpdes/artikel')->with('error', 'Artikel tidak ditemukan.');
        return view('admin/bpdes/artikel/edit', compact('artikel'));
    }

    public function updateArtikel($id)
    {
        $artikel = $this->artikelModel->find($id);
        if (!$artikel)
            return redirect()->to('/admin/bpdes/artikel')->with('error', 'Artikel tidak ditemukan.');

        if (
            !$this->validate([
                'judul' => 'required|min_length[3]',
                'konten' => 'required',
                'kategori' => 'required',
                'gambar' => 'if_exist|is_image[gambar]|max_size[gambar,100]',
            ])
        ) {
            return redirect()->back()->withInput()->with('errors', \Config\Services::validation()->getErrors());
        }

        $gambar = $this->request->getFile('gambar');
        $gambarPath = $artikel['gambar'];
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            if (!empty($artikel['gambar']) && file_exists(FCPATH . $artikel['gambar'])) {
                unlink(FCPATH . $artikel['gambar']);
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

        return redirect()->to('/admin/bpdes/artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function deleteArtikel($id)
    {
        $artikel = $this->artikelModel->find($id);
        if ($artikel && !empty($artikel['gambar']) && file_exists(FCPATH . $artikel['gambar'])) {
            unlink(FCPATH . $artikel['gambar']);
        }
        $this->artikelModel->delete($id);
        return redirect()->to('/admin/bpdes/artikel')->with('success', 'Artikel berhasil dihapus');
    }

    // ================== HELPERS ==================
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
            case 'bpw':
                return $this->lookup('tb_provinsi', 'id_provinsi', session()->get('id_provinsi'), 'nama_provinsi') ?: 'BPW';
            case 'bpd':
                return $this->lookup('tb_kota_kabupaten', 'id_kota', session()->get('id_kota'), 'nama_kota') ?: 'BPD';
            case 'bpdes':
                return $this->lookup('tb_desa_kelurahan', 'id_desa', session()->get('id_desa'), 'nama_desa') ?: 'BPDes';
            default:
                return 'BPDes';
        }
    }

public function indexAcara()
{
    // Get publisher label (desa name for BPDes)
    $publisherLabel = $this->resolvePublisherLabel();

    // Fetch acara for this desa only
    $acaras = $this->acaraModel
        ->where('created_label', $publisherLabel)
        ->orderBy('created_at', 'DESC')
        ->findAll();

    // Return BPDes-specific view
    return view('admin/bpdes/acara/index', ['acaras' => $acaras]);
}



    // Form tambah acara
    public function buatAcara()
    {
        return view('admin/bpdes/acara/create');
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

        return redirect()->to('/admin/bpdes/acara')->with('success', 'Acara berhasil dibuat dan menunggu approval.');
    }
    // Form edit acara
    public function editAcara($id)
    {
        $acara = $this->acaraModel->find($id);

        if (!$acara || $acara['created_by'] != session()->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Acara tidak ditemukan');
        }

        return view('admin/bpdes/acara/edit', ['acara' => $acara]);
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

        return redirect()->to('/admin/bpdes/acara')->with('success', 'Acara berhasil diperbarui dan menunggu approval.');
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
        return redirect()->to('/admin/bpdes/acara')->with('success', 'Acara berhasil dihapus.');
    }
}
