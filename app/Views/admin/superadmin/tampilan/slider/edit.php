<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h4>Edit Slider</h4>

  <form action="<?= base_url('admin/slider/update/' . $slider['id']) ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Gambar Saat Ini</label><br>
      <img src="<?= base_url('assets/images/slider/' . $slider['image_filename']) ?>" width="150">
    </div>
    <div class="mb-3">
      <label>Ganti Gambar (opsional)</label>
      <input type="file" name="image_filename" class="form-control">
    </div>
    <div class="mb-3">
      <label>Judul</label>
      <input type="text" name="title" class="form-control" value="<?= esc($slider['title']) ?>">
    </div>
    <div class="mb-3">
      <label>Subjudul</label>
      <input type="text" name="subtitle" class="form-control" value="<?= esc($slider['subtitle']) ?>">
    </div>
    <div class="mb-3">
      <label>Deskripsi</label>
      <textarea name="description" class="form-control" rows="4"><?= esc($slider['description']) ?></textarea>
    </div>
    <div class="mb-3">
      <label>Label Tombol 1</label>
      <input type="text" name="button_1_label" class="form-control" value="<?= esc($slider['button_1_label']) ?>">
    </div>
    <div class="mb-3">
      <label>Link Tombol 1</label>
      <input type="text" name="button_1_link" class="form-control" value="<?= esc($slider['button_1_link']) ?>">
    </div>
    <div class="mb-3">
      <label>Label Tombol 2</label>
      <input type="text" name="button_2_label" class="form-control" value="<?= esc($slider['button_2_label']) ?>">
    </div>
    <div class="mb-3">
      <label>Link Tombol 2</label>
      <input type="text" name="button_2_link" class="form-control" value="<?= esc($slider['button_2_link']) ?>">
    </div>
    <div class="mb-3">
      <label>Urutan Tampil</label>
      <input type="number" name="sort_order" class="form-control" value="<?= esc($slider['sort_order']) ?>">
    </div>
    <div class="mb-3">
      <label>Status Aktif</label>
      <select name="is_active" class="form-select">
        <option value="1" <?= $slider['is_active'] ? 'selected' : '' ?>>Aktif</option>
        <option value="0" <?= !$slider['is_active'] ? 'selected' : '' ?>>Nonaktif</option>
      </select>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="<?= base_url('admin/slider') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>
