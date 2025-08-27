<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Acara</h1>

    <form action="<?= base_url('/admin/bpn/acara/update/'.$acara['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?= $acara['judul'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?= $acara['deskripsi'] ?></textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
            <div class="mt-2">
                <img src="<?= base_url('uploads/events/'.$acara['gambar']) ?>" width="120">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('/admin/bpn/acara') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
