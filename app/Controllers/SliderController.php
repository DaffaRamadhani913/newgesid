<?php

namespace App\Controllers;

use App\Models\SliderModel;
use CodeIgniter\Controller;

class SliderController extends BaseController
{
    protected $sliderModel;

    public function __construct()
    {
        $this->sliderModel = new SliderModel();
    }

    // Tampilkan semua slider
    public function index()
    {
        $data['sliders'] = $this->sliderModel->orderBy('sort_order', 'ASC')->findAll();
        return view('admin/superadmin/tampilan/slider/index', $data);
    }

    // Tampilkan form tambah slider
    public function create()
    {
        return view('admin/superadmin/tampilan/slider/create');
    }

    // Simpan slider baru
    public function store()
    {
        $file = $this->request->getFile('image_filename');
        $filename = $file->getRandomName();
        $file->move('assets/images/slider/', $filename);

        $this->sliderModel->save([
            'image_filename'    => $filename,
            'title'             => $this->request->getPost('title'),
            'subtitle'          => $this->request->getPost('subtitle'),
            'description'       => $this->request->getPost('description'),
            'button_1_label'    => $this->request->getPost('button_1_label'),
            'button_1_link'     => $this->request->getPost('button_1_link'),
            'button_2_label'    => $this->request->getPost('button_2_label'),
            'button_2_link'     => $this->request->getPost('button_2_link'),
            'sort_order'        => $this->request->getPost('sort_order'),
            'is_active'         => $this->request->getPost('is_active') ?? 1,
        ]);

        return redirect()->to('/admin/slider');
    }

    // Edit slider
    public function edit($id)
    {
        $data['slider'] = $this->sliderModel->find($id);
        return view('admin/superadmin/tampilan/slider/edit', $data);
    }

    // Update slider
    public function update($id)
    {
        $slider = $this->sliderModel->find($id);
        $filename = $slider['image_filename'];

        $file = $this->request->getFile('image_filename');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('assets/images/slider/', $filename);
        }

        $this->sliderModel->update($id, [
            'image_filename'    => $filename,
            'title'             => $this->request->getPost('title'),
            'subtitle'          => $this->request->getPost('subtitle'),
            'description'       => $this->request->getPost('description'),
            'button_1_label'    => $this->request->getPost('button_1_label'),
            'button_1_link'     => $this->request->getPost('button_1_link'),
            'button_2_label'    => $this->request->getPost('button_2_label'),
            'button_2_link'     => $this->request->getPost('button_2_link'),
            'sort_order'        => $this->request->getPost('sort_order'),
            'is_active'         => $this->request->getPost('is_active') ?? 1,
        ]);

        return redirect()->to('/admin/slider');
    }

    // Hapus slider
    public function delete($id)
    {
        $slider = $this->sliderModel->find($id);
        if ($slider) {
            $this->sliderModel->delete($id);
            @unlink('assets/images/slider/' . $slider['image_filename']);
        }
        return redirect()->to('/admin/slider');
    }
}
