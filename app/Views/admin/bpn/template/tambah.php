<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Download</h1>

    <form action="<?= base_url('admin/bpn/simpan-template') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="file_template" class="form-label">Upload File</label>
            <input type="file" name="file_template" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/bpn/template') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
