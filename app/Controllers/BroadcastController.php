<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BpnModel;
use App\Models\BpwModel;
use App\Models\BpdModel;
use App\Models\BpdesModel;
use App\Models\MemberModel;
use App\Models\EmailModel;

class BroadcastController extends BaseController
{
    protected $email;
    protected $bpnModel;
    protected $bpwModel;
    protected $bpdModel;
    protected $bpdesModel;
    protected $memberModel;
    protected $emailModel;

    public function __construct()
    {
        $this->email       = \Config\Services::email();
        $this->bpnModel    = new BpnModel();
        $this->bpwModel    = new BpwModel();
        $this->bpdModel    = new BpdModel();
        $this->bpdesModel  = new BpdesModel();
        $this->memberModel = new MemberModel();
        $this->emailModel  = new EmailModel();
    }

    // 📌 Tampilkan daftar broadcast email
    public function index()
    {
        $data['emails'] = $this->emailModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/bpn/broadcast/index', $data);
    }

    // 📌 Tampilkan form broadcast email
    public function form()
    {
        return view('admin/bpn/broadcast/form');
    }

    // 📌 Proses kirim broadcast email
    public function send()
    {
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');

        // Simpan ke database tb_email
        $this->emailModel->save([
            'subject' => $subject,
            'message' => $message,
        ]);

        // Ambil semua email dari tiap tabel
        $emails = [];

        foreach ($this->bpnModel->findAll() as $row) {
            if (!empty($row['email'])) $emails[] = $row['email'];
        }
        foreach ($this->bpwModel->findAll() as $row) {
            if (!empty($row['email'])) $emails[] = $row['email'];
        }
        foreach ($this->bpdModel->findAll() as $row) {
            if (!empty($row['email'])) $emails[] = $row['email'];
        }
        foreach ($this->bpdesModel->findAll() as $row) {
            if (!empty($row['email'])) $emails[] = $row['email'];
        }
        foreach ($this->memberModel->findAll() as $row) {
            if (!empty($row['email'])) $emails[] = $row['email'];
        }

        // Hapus duplikat
        $emails = array_unique($emails);

        if (empty($emails)) {
            return redirect()->back()->with('message', 'Tidak ada email penerima ditemukan.');
        }

        // Kirim email broadcast
        $this->email->setFrom('no-reply@domainanda.com', 'GESID System');
        $this->email->setTo(array_shift($emails)); // penerima utama
        if (!empty($emails)) {
            $this->email->setBCC($emails); // sisanya BCC
        }
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        if ($this->email->send()) {
            return redirect()->to('admin/bpn/broadcast')->with('message', 'Broadcast email berhasil dikirim!');
        } else {
            return redirect()->back()->with('message', 'Gagal mengirim email: ' . $this->email->printDebugger(['headers']));
        }
    }

    public function viewBroadcast()
    {
        $data['emails'] = $this->emailModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/bpn/broadcast/view-broadcast', $data);
    }
}
