<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Download</h1>

    <form action="<?= base_url('admin/bpn/update-template/'.$template['id']) ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= esc($template['judul']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4"><?= esc($template['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="file_template" class="form-label">File Download</label><br>
            <?php if($template['file_template']): ?>
                <a href="<?= base_url('uploads/template/'.$template['file_template']) ?>" target="_blank">
                    Lihat file saat ini
                </a><br><br>
            <?php endif; ?>
            <input type="file" name="file_template" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti file</small>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?= base_url('admin/bpn/template') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
