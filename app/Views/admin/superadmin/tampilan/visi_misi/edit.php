<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Edit Visi & Misi</h2>

  <form action="<?= base_url('admin/visi-misi/update') ?>" method="post">
    <input type="hidden" name="id" value="<?= $visiMisi['id'] ?? '' ?>">

    <div class="mb-3">
      <label for="visi" class="form-label">Visi</label>
      <textarea class="form-control" name="visi" id="visi" rows="5"><?= esc($visiMisi['visi'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
      <label for="misi" class="form-label">Misi (satu poin per baris)</label>
      <textarea class="form-control" name="misi" id="misi" rows="7"><?= esc($visiMisi['misi'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>

<?= $this->endSection() ?>
