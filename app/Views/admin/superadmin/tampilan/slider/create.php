<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h4>Tambah Slider</h4>

  <form action="<?= base_url('admin/slider/store') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Gambar Slider</label>
      <input type="file" name="image_filename" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Judul</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Subjudul</label>
      <input type="text" name="subtitle" class="form-control">
    </div>
    <div class="mb-3">
      <label>Deskripsi</label>
      <textarea name="description" class="form-control" rows="4"></textarea>
    </div>
    <div class="mb-3">
      <label>Label Tombol 1</label>
      <input type="text" name="button_1_label" class="form-control">
    </div>
    <div class="mb-3">
      <label>Link Tombol 1</label>
      <input type="text" name="button_1_link" class="form-control">
    </div>
    <div class="mb-3">
      <label>Label Tombol 2</label>
      <input type="text" name="button_2_label" class="form-control">
    </div>
    <div class="mb-3">
      <label>Link Tombol 2</label>
      <input type="text" name="button_2_link" class="form-control">
    </div>
    <div class="mb-3">
      <label>Urutan Tampil</label>
      <input type="number" name="sort_order" class="form-control" value="0">
    </div>
    <div class="mb-3">
      <label>Status Aktif</label>
      <select name="is_active" class="form-select">
        <option value="1">Aktif</option>
        <option value="0">Nonaktif</option>
      </select>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= base_url('admin/slider') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>
