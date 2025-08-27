<?php

namespace App\Controllers\admin\TambahAdmin;

use App\Controllers\BaseController;
use App\Models\BpdesModel;
use App\Models\KecamatanModel;
use App\Models\DesaModel;

class BpdesController extends BaseController
{
    protected $bpdesModel;
    protected $kecamatanModel;
    protected $desaModel;

    public function __construct()
    {
        $this->bpdesModel     = new BpdesModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->desaModel      = new DesaModel();
    }

    // List BPDes for the BPD's Kota (derived via kecamatan->kota)
    public function index()
    {
        $idKota = session()->get('id_kota'); // set this at login for BPD
        $qb = $this->bpdesModel
            ->select('tb_bpdes.*, kec.nama_kecamatan AS nama_kecamatan, desa.nama_desa AS nama_desa')
            ->join('tb_desa_kelurahan AS desa', 'desa.id_desa = tb_bpdes.id_desa')
            ->join('tb_kecamatan AS kec', 'kec.id_kecamatan = desa.id_kecamatan');

        if ($idKota) {
            $qb->where('kec.id_kota', $idKota);
        }

        $data['bpdes_admins'] = $qb->findAll();

        return view('admin/bpd/tampilan/pengurus/index', $data);
    }

    public function create()
    {
        $idKota = session()->get('id_kota');

        // Limit kecamatan to the BPD admin's Kota
        $kecamatan = $idKota
            ? $this->kecamatanModel->where('id_kota', $idKota)->findAll()
            : $this->kecamatanModel->findAll(); // fallback if session not set

        $data = [
            'kecamatan' => $kecamatan,
            'desa'      => [], // important to avoid "Undefined variable $desa" in the view
        ];

        return view('admin/bpd/tampilan/pengurus/create', $data);
    }

    public function store()
    {
        $idKecamatan = (int) $this->request->getPost('id_kecamatan');
        $idDesa      = (int) $this->request->getPost('id_desa');

        // Validate the chain: desa must belong to selected kecamatan
        $desa = $this->desaModel
            ->where(['id_desa' => $idDesa, 'id_kecamatan' => $idKecamatan])
            ->first();

        if (!$desa) {
            return redirect()->back()->withInput()->with('error', 'Desa/Kelurahan tidak sesuai dengan Kecamatan yang dipilih.');
        }

        $this->bpdesModel->insert([
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'BPDes',
            'id_desa'  => $idDesa,
        ]);

        return redirect()->to('admin/bpd/adminbpdes')->with('success', 'Akun BPDes berhasil dibuat');
    }

    public function edit($id)
    {
        $bpdes = $this->bpdesModel->find($id);
        if (!$bpdes) {
            return redirect()->to('admin/bpd/adminbpdes')->with('error', 'Data BPDes tidak ditemukan.');
        }

        // Derive kecamatan (and kota via session) from stored id_desa
        $desaRow = $this->desaModel->find($bpdes['id_desa']);
        $idKecamatan = $desaRow['id_kecamatan'] ?? null;

        $idKota = session()->get('id_kota');

        // Kec list (scoped to BPD's kota if available)
        $kecamatanList = $idKota
            ? $this->kecamatanModel->where('id_kota', $idKota)->findAll()
            : $this->kecamatanModel->findAll();

        // Desa list for the preselected kecamatan
        $desaList = $idKecamatan
            ? $this->desaModel->where('id_kecamatan', $idKecamatan)->findAll()
            : [];

        $data = [
            'bpdes'             => $bpdes,
            'kecamatan'         => $kecamatanList,
            'desa'              => $desaList,
            'selectedKecamatan' => $idKecamatan,
        ];

        return view('admin/bpd/tampilan/pengurus/edit', $data);
    }

    public function update($id)
    {
        $bpdes = $this->bpdesModel->find($id);
        if (!$bpdes) {
            return redirect()->to('admin/bpd/adminbpdes')->with('error', 'Data BPDes tidak ditemukan.');
        }

        $idKecamatan = (int) $this->request->getPost('id_kecamatan');
        $idDesa      = (int) $this->request->getPost('id_desa');

        // Validate desa belongs to the chosen kecamatan
        $desa = $this->desaModel
            ->where(['id_desa' => $idDesa, 'id_kecamatan' => $idKecamatan])
            ->first();

        if (!$desa) {
            return redirect()->back()->withInput()->with('error', 'Desa/Kelurahan tidak sesuai dengan Kecamatan yang dipilih.');
        }

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'id_desa'  => $idDesa,
            'role'     => $bpdes['role'] ?? 'BPDes',
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->bpdesModel->update($id, $data);

        return redirect()->to('admin/bpd/adminbpdes')->with('success', 'Data BPDes berhasil diupdate');
    }

    public function delete($id)
    {
        if ($this->bpdesModel->delete($id)) {
            return redirect()->to('admin/bpd/adminbpdes')->with('success', 'Akun BPDes berhasil dihapus');
        }
        return redirect()->to('admin/bpd/adminbpdes')->with('error', 'Gagal menghapus akun BPDes');
    }

    // AJAX: list desa for a kecamatan
   public function desaByKecamatan($id_kecamatan)
{
    $desaModel = new DesaModel();
    $list = $desaModel
        ->select('id_desa, nama_desa')
        ->where('id_kecamatan', $id_kecamatan)
        ->findAll();

    return $this->response->setJSON($list);
}


}
