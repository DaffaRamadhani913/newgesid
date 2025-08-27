<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventModel;

class EventController extends BaseController
{
    protected $eventModel;





    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    public function publicIndex()
{
    $data['events'] = $this->eventModel->findAll();
    return view('event/index', $data); // Pastikan view ini tersedia
}

    // ===============================
    // BACKEND: Daftar Semua Event
    // ===============================
    public function index()
    {
        $data['events'] = $this->eventModel->findAll();
        return view('admin/superadmin/tampilan/events/index', $data);
    }

    // Form tambah event
    public function create()
    {
        return view('admin/superadmin/tampilan/events/create');
    }

    // Simpan event baru
    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'title' => 'required',
            'image' => 'uploaded[image]|is_image[image]|max_size[image,2048]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('image');
        $fileName = $file->getRandomName();
        $file->move('assets/images/events', $fileName);

        $this->eventModel->save([
            'title' => $this->request->getPost('title'),
            'image' => $fileName
        ]);

        return redirect()->to(base_url('admin/events'))->with('success', 'Event berhasil ditambahkan.');
    }

    // Form edit event
    public function edit($id)
    {
        $event = $this->eventModel->find($id);

        if (!$event) {
            return redirect()->to(base_url('admin/events'))->with('error', 'Event tidak ditemukan.');
        }

        return view('admin/superadmin/tampilan/events/edit', ['event' => $event]);
    }

    // Update event
    public function update($id)
    {
        $event = $this->eventModel->find($id);

        if (!$event) {
            return redirect()->to(base_url('admin/events'))->with('error', 'Event tidak ditemukan.');
        }

        $file = $this->request->getFile('image');
        $fileName = $event['image']; // default

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('assets/images/events', $fileName);

            // Hapus gambar lama
            $oldPath = FCPATH . 'assets/images/events/' . $event['image'];
            if (!empty($event['image']) && file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $this->eventModel->update($id, [
            'title' => $this->request->getPost('title'),
            'image' => $fileName
        ]);

        return redirect()->to(base_url('admin/events'))->with('success', 'Event berhasil diperbarui.');
    }

    // Hapus event
    public function delete($id)
    {
        $event = $this->eventModel->find($id);

        if ($event) {
            if (!empty($event['image'])) {
                $path = FCPATH . 'assets/images/events/' . $event['image'];
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $this->eventModel->delete($id);
            return redirect()->to('admin/events')->with('success', 'Event berhasil dihapus.');
        }

        return redirect()->to('admin/events')->with('error', 'Event tidak ditemukan.');
    }
}
