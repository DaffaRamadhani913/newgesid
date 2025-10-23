<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\ProvinsiModel;
use App\Models\KotaModel;
use App\Models\DesaModel;
use App\Models\AduanModel;
use CodeIgniter\Controller;
use App\Models\BpwModel;
use App\Models\BpdModel;
use App\Models\BpdesModel;


class MemberController extends BaseController
{
    protected $memberModel;
    protected $aduanModel;
    protected $provinsiModel;
    protected $kotaModel;
    protected $desaModel;
    protected $bpwModel;
    protected $bpdModel;
    protected $bpdesModel;





    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->aduanModel = new AduanModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->kotaModel     = new KotaModel();
        $this->desaModel     = new DesaModel();
        $this->bpwModel   = new BpwModel();
        $this->bpdModel   = new BpdModel();
        $this->bpdesModel = new BpdesModel();
    }

    // ========================
    // ADMIN / PENGELOLA MEMBER
    // ========================

    public function index()
    {
        $data['members'] = $this->memberModel->findAll();
        return view('member/index', $data);
    }

    public function activate($id)
    {
        $member = $this->memberModel->find($id);
        if ($member) {
            $this->memberModel->update($id, ['status' => 'Aktif']);
            return redirect()->back()->with('success', 'Member berhasil diaktifkan.');
        }
        return redirect()->back()->with('error', 'Member tidak ditemukan.');
    }

    public function deactivate($id)
    {
        $member = $this->memberModel->find($id);
        if ($member) {
            $this->memberModel->update($id, ['status' => 'Nonaktif']);
            return redirect()->back()->with('success', 'Member berhasil dinonaktifkan.');
        }
        return redirect()->back()->with('error', 'Member tidak ditemukan.');
    }

    public function view($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_members m');
        $builder->select('m.*, 
            prov.nama_provinsi AS nama_provinsi, 
            kota.nama_kota AS nama_kota, 
            kec.nama_kecamatan AS nama_kecamatan, 
            desa.nama_desa AS nama_desa');
        $builder->join('tb_provinsi prov', 'prov.id_provinsi = m.id_provinsi', 'left');
        $builder->join('tb_kota_kabupaten kota', 'kota.id_kota = m.id_kota', 'left');
        $builder->join('tb_kecamatan kec', 'kec.id_kecamatan = m.id_kecamatan', 'left');
        $builder->join('tb_desa_kelurahan desa', 'desa.id_desa = m.id_desa', 'left');
        $builder->where('m.id', $id);

        $query = $builder->get();
        $data['member'] = $query->getRowArray();

        return view('member/view_detail', $data);
    }

    // ================
    // DASHBOARD MEMBER
    // ================

    public function dashboard()
{
    $session = session();
    $userId = $session->get('user_id');
    $role = $session->get('role'); // pastikan saat login role ini diset

    // 🧩 Cek login
    if (!$userId) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // 🧩 Cegah akses oleh selain member
    if ($role !== 'member') {
        return redirect()->to('/unauthorized')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    // 🔍 Ambil data member
    $db = \Config\Database::connect();
    $builder = $db->table('tb_members m');
    $builder->select('m.*, 
        prov.nama_provinsi AS nama_provinsi, 
        kota.nama_kota AS nama_kota, 
        desa.nama_desa AS nama_desa');
    $builder->join('tb_provinsi prov', 'prov.id_provinsi = m.id_provinsi', 'left');
    $builder->join('tb_kota_kabupaten kota', 'kota.id_kota = m.id_kota', 'left');
    $builder->join('tb_desa_kelurahan desa', 'desa.id_desa = m.id_desa', 'left');
    $builder->where('m.user_id', $userId);

    $query = $builder->get();
    $member = $query->getRowArray();

    if (!$member) {
        return redirect()->to('/login')->with('error', 'Data member tidak ditemukan.');
    }

    return view('member/dashboard_view', ['member' => $member]);
}



    // ============
    // FORM ADUAN
    // ============
    public function aduanForm()
    {
        $session = session();
        $memberId = $session->get('member_id');

        $member = $this->memberModel->find($memberId);
        if (!$member) {
            return redirect()->back()->with('error', 'Data member tidak ditemukan.');
        }

        // 🔍 Cek admin berdasarkan relasi wilayah
        $adminBPW = $this->bpwModel
            ->where('id_provinsi', $member['id_provinsi'])
            ->first();

        $adminBPD = $this->bpdModel
            ->where('id_kota', $member['id_kota'])
            ->first();

        $adminBPDES = $this->bpdesModel
            ->where('id_desa', $member['id_desa'])
            ->first();

        // 🧠 Siapkan daftar tujuan
        $tujuanOptions = [];

        if ($adminBPW) {
            $tujuanOptions['BPW'] = 'BPW ' . ($adminBPW['nama'] ?? 'Wilayah');
        }
        if ($adminBPD) {
            $tujuanOptions['BPD'] = 'BPD ' . ($adminBPD['nama'] ?? 'Wilayah');
        }
        if ($adminBPDES) {
            $tujuanOptions['BPDES'] = 'BPDES ' . ($adminBPDES['nama'] ?? 'Wilayah');
        }

        // Jika semua kosong (tidak ada admin aktif)
        if (empty($tujuanOptions)) {
            $tujuanOptions['none'] = 'Tidak tersedia untuk wilayah Anda';
        }

        return view('member/aduan_form', [
            'member' => $member,
            'tujuanOptions' => $tujuanOptions,
        ]);
    }

    public function kirimAduan()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $member = $this->memberModel->where('user_id', $userId)->first();
        if (!$member) {
            return redirect()->back()->with('error', 'Data member tidak ditemukan.');
        }

        $rules = [
            'judul' => 'required|min_length[3]',
            'isi' => 'required|min_length[10]',
            'tujuan' => 'required',
            'lampiran' => 'permit_empty|max_size[lampiran,2048]|ext_in[lampiran,jpg,jpeg,png,pdf,doc,docx]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan semua kolom terisi dengan benar.');
        }

        $lampiran = $this->request->getFile('lampiran');
        $lampiranName = null;

        if ($lampiran && $lampiran->isValid() && !$lampiran->hasMoved()) {
            $lampiranName = $lampiran->getRandomName();
            $lampiran->move('uploads/aduan', $lampiranName);
        }

        // Ambil data tujuan
        $tujuan = explode('|', $this->request->getPost('tujuan'));
        // Formatnya: BPW|id_provinsi|id_kota|id_desa

        $data = [
            'user_id' => $userId,
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'tujuan' => $tujuan[0],
            'lampiran' => $lampiranName,
            'status' => 'Menunggu',
            'id_provinsi' => $tujuan[1] ?: null,
            'id_kota' => $tujuan[2] ?: null,
            'id_desa' => $tujuan[3] ?: null,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->aduanModel->insert($data);

        return redirect()->to('/member/aduan')->with('success', 'Aduan berhasil dikirim.');
    }

    public function respons()
    {
        $session = session();
        $userId = $session->get('user_id');

        $aduanModel = new AduanModel();

        // Get member's aduan with left join respons (so we can show respons if exists)
        $aduan = $aduanModel
            ->select('tb_aduan.*, tb_respons.judul as resp_judul, tb_respons.isi as resp_isi, tb_respons.lampiran as resp_lampiran')
            ->join('tb_respons', 'tb_respons.id_aduan = tb_aduan.id_aduan', 'left')
            ->where('tb_aduan.user_id', $userId)
            ->orderBy('tb_aduan.created_at', 'DESC')
            ->findAll();

        return view('member/respons', ['aduan' => $aduan]);
    }



    // ===================
    // PROFIL MEMBER
    // ===================

    public function profile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $member = $this->memberModel
            ->where('user_id', $userId)
            ->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Data profil tidak ditemukan.');
        }

        return view('member/profile_view', [
            'member' => $member
        ]);
    }

    public function updateProfile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $member = $this->memberModel->where('user_id', $userId)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Data profil tidak ditemukan.');
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $this->memberModel->update($member['id'], $data);

        return redirect()->to('/member/profile')->with('success', 'Profil berhasil diperbarui.');
    }
    public function downloadCard()
{
    // helpers & session
    helper('filesystem');
    $session = session();
    $userId = $session->get('user_id');

    if (!$userId) {
        return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
    }

    // fetch member with location names (same query as dashboard)
    $db = \Config\Database::connect();
    $builder = $db->table('tb_members m');
    $builder->select('m.*, 
        prov.nama_provinsi AS nama_provinsi, 
        kota.nama_kota AS nama_kota, 
        desa.nama_desa AS nama_desa');
    $builder->join('tb_provinsi prov', 'prov.id_provinsi = m.id_provinsi', 'left');
    $builder->join('tb_kota_kabupaten kota', 'kota.id_kota = m.id_kota', 'left');
    $builder->join('tb_desa_kelurahan desa', 'desa.id_desa = m.id_desa', 'left');
    $builder->where('m.user_id', $userId);
    $query = $builder->get();
    $member = $query->getRowArray();

    if (!$member) {
        return redirect()->back()->with('error', 'Data member tidak ditemukan.');
    }

    // TEMPLATE / ASSET PATHS (update these if your folders differ)
    $frontTemplate = FCPATH . 'assets/img/member_card/member_card_front.png';
    $backTemplate  = FCPATH . 'assets/img/member_card/member_card_back.png';
    $photoPath     = FCPATH . 'assets/images/verifikasi/wajah/' . ($member['foto_wajah'] ?? '');

    if (!file_exists($frontTemplate)) {
        return redirect()->back()->with('error', 'Template depan tidak ditemukan.');
    }
    if (!file_exists($backTemplate)) {
        return redirect()->back()->with('error', 'Template belakang tidak ditemukan.');
    }

    // FONT (place a .ttf in public/assets/fonts/)
    $fontPath = FCPATH . 'assets/fonts/Roboto-Regular.ttf';
    if (!file_exists($fontPath)) {
        // fallback to any available TTF you have; otherwise abort
        log_message('error', 'Font tidak ditemukan di: ' . $fontPath);
        return redirect()->back()->with('error', 'Font tidak ditemukan. Harap letakkan file font di assets/fonts.');
    }

    // ---------- Create front image (GD) ----------
    // load template
    $frontImg = imagecreatefrompng($frontTemplate);
    if (!$frontImg) {
        return redirect()->back()->with('error', 'Gagal membuka template depan (GD). Pastikan extension GD aktif.');
    }

    // preserve alpha
    imagealphablending($frontImg, true);
    imagesavealpha($frontImg, true);

    // colors
    $white = imagecolorallocate($frontImg, 255, 255, 255);

    // Dimensions
    $cardW = imagesx($frontImg);
    $cardH = imagesy($frontImg);

    // Choose coordinates based on template proportions (tweak if your template differs)
    // X base for left column text
    $xLeft = 80;         // ~ 8% from left
    $yStart = 320;        // start lower than header/banner
    $lineGap = 45;       // spacing between lines
    $fontSizeMain = max(12, intval($cardW / 32)); // adapt size based on image width
    $fontSizeSmall = max(10, intval($cardW / 42));

    // Draw the lines (use the same fields you show on the dashboard)
    // Adjust the order/labels to your preference
    $lines = [
        'ID      : ' . ($member['member_id'] ?? ($member['id'] ?? '-')),
        'Nama    : ' . ($member['nama'] ?? '-'),
        'Provinsi: ' . ($member['nama_provinsi'] ?? '-'),
        'Kota/Kab: ' . ($member['nama_kota'] ?? '-'),
        'Desa    : ' . ($member['nama_desa'] ?? '-'),
    ];

    // Write first line slightly larger (ID)
    $y = $yStart;
    imagettftext($frontImg, $fontSizeMain, 0, $xLeft, $y, $white, $fontPath, $lines[0]);

    // remaining lines
    for ($i = 1; $i < count($lines); $i++) {
        $y += $lineGap;
        imagettftext($frontImg, $fontSizeSmall, 0, $xLeft, $y, $white, $fontPath, $lines[$i]);
    }

    // ---------- Add face photo if available ----------
    if (!empty($member['foto_wajah']) && file_exists($photoPath)) {
        // create image resource from file and preserve alpha if png
        $photoRes = null;
        $imgInfo = @getimagesize($photoPath);
        if ($imgInfo && isset($imgInfo['mime'])) {
            switch ($imgInfo['mime']) {
                case 'image/jpeg':
                case 'image/jpg':
                    $photoRes = imagecreatefromjpeg($photoPath);
                    break;
                case 'image/png':
                    $photoRes = imagecreatefrompng($photoPath);
                    break;
                case 'image/gif':
                    $photoRes = imagecreatefromgif($photoPath);
                    break;
                default:
                    $photoRes = imagecreatefromstring(file_get_contents($photoPath));
            }
        } else {
            // fallback try
            $photoRes = @imagecreatefromstring(file_get_contents($photoPath));
        }

        if ($photoRes) {
            // desired size depends on your template; make it proportional to card size
            $photoW = intval($cardW * 0.23);   // ~23% of card width
            $photoH = intval($cardH * 0.47);   // maintain portrait-like ratio
            // optional min/max
            $photoW = max(80, min(220, $photoW));
            $photoH = max(100, min(300, $photoH));

            $photoScaled = imagecreatetruecolor($photoW, $photoH);
            // if source has alpha, preserve it
            imagealphablending($photoScaled, false);
            imagesavealpha($photoScaled, true);
            $transparent = imagecolorallocatealpha($photoScaled, 0, 0, 0, 127);
            imagefilledrectangle($photoScaled, 0, 0, $photoW, $photoH, $transparent);

            // resample
            $srcW = imagesx($photoRes);
            $srcH = imagesy($photoRes);
            imagecopyresampled($photoScaled, $photoRes, 0, 0, 0, 0, $photoW, $photoH, $srcW, $srcH);

            // place photo on the card (right side)
            $photoX = 700; // 6% padding from right
            $photoY = 200;                     // top offset

            imagecopy($frontImg, $photoScaled, $photoX, $photoY, 0, 0, $photoW, $photoH);

            // Optional: white rounded border (draw a rounded rectangle)
            // Simple approach: draw white rectangle slightly larger behind the photo
            $borderW = 6; // border thickness
            $frame = imagecreatetruecolor($photoW + $borderW * 2, $photoH + $borderW * 2);
            imagesavealpha($frame, true);
            imagealphablending($frame, false);
            $frameBg = imagecolorallocatealpha($frame, 0, 0, 0, 127);
            imagefilledrectangle($frame, 0, 0, imagesx($frame), imagesy($frame), $frameBg);
            // draw white border rectangle (non-rounded)
            $whiteBorder = imagecolorallocate($frontImg, 255, 255, 255);
            // place border by drawing a filled white rectangle behind photo
            imagefilledrectangle($frontImg, $photoX - $borderW, $photoY - $borderW, $photoX + $photoW + $borderW, $photoY + $photoH + $borderW, $whiteBorder);
            // re-copy photo over the border area (so border acts like frame)
            imagecopy($frontImg, $photoScaled, $photoX, $photoY, 0, 0, $photoW, $photoH);

            // cleanup
            imagedestroy($photoScaled);
            imagedestroy($photoRes);
            imagedestroy($frame);
        } else {
            log_message('warning', 'Gagal membuat resource gambar dari foto: ' . $photoPath);
        }
    } else {
        log_message('info', 'Foto belum ada atau tidak ditemukan: ' . $photoPath);
    }

    // Save the generated front PNG
    $outputDir = WRITEPATH . 'generated_cards/';
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $frontFile = $outputDir . 'card_front_' . $member['id'] . '.png';
    $backFile  = $outputDir . 'card_back_' . $member['id'] . '.png';

    // Save front
    imagepng($frontImg, $frontFile, 9);
    imagedestroy($frontImg);

    // copy back template (unchanged)
    copy($backTemplate, $backFile);

    // If ZipArchive exists, create zip containing front+back
    if (class_exists('ZipArchive')) {
        $zipPath = $outputDir . 'member_card_' . $member['id'] . '.zip';
        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            $zip->addFile($frontFile, 'member_card_front.png');
            $zip->addFile($backFile, 'member_card_back.png');
            $zip->close();

            // serve zip
            return $this->response->download($zipPath, null)->setFileName('GESID_MemberCard_' . $member['id'] . '.zip');
        } else {
            log_message('error', 'Gagal membuat zip: ' . $zipPath);
            // fallback: continue to send single front PNG
        }
    }

    // If ZipArchive not available or zip creation failed — send the front PNG directly
    return $this->response->download($frontFile, null)->setFileName('GESID_MemberCard_Front_' . $member['id'] . '.png');
}





}
