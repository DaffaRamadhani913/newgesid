<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h2>Tambah Event</h2>

<form action="<?= base_url('admin/events/store') ?>" method="post" enctype="multipart/form-data">

    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Gambar</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= base_url('admin/superadmin/events') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection(); ?>
