<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Edit Selayang Pandang</h3>
<form action="<?= base_url('admin/selayang/update/' . $selayang['id']) ?>" method="post" enctype="multipart/form-data">
    <div class="mb-2">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" value="<?= esc($selayang['judul']) ?>">
    </div>
    <div class="mb-2">
        <label>Pengantar</label>
        <textarea name="pengantar" class="form-control"><?= esc($selayang['pengantar']) ?></textarea>
    </div>
    <div class="mb-2">
        <label>Latar Belakang</label>
        <textarea name="latar_belakang" class="form-control"><?= esc($selayang['latar_belakang']) ?></textarea>
    </div>
    <div class="mb-2">
        <label>Tujuan</label>
        <textarea name="tujuan" class="form-control"><?= esc($selayang['tujuan']) ?></textarea>
    </div>
    <div class="mb-2">
        <label>Ruang Lingkup</label>
        <textarea name="ruang_lingkup" class="form-control"><?= esc($selayang['ruang_lingkup']) ?></textarea>
    </div>
    <div class="mb-2">
        <label>Gambar (Opsional)</label>
        <input type="file" name="gambar" class="form-control">
        <?php if (!empty($selayang['gambar'])): ?>
            <div class="mt-2">
                <strong>Gambar Saat Ini:</strong><br>
                <img src="<?= base_url('assets/images/' . $selayang['gambar']) ?>" alt="Gambar" width="200">
            </div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?= $this->endSection() ?>
