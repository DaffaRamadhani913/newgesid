<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Tambah Selayang Pandang</h3>
<form action="<?= base_url('admin/selayang-pandang/store') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-2">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control">
    </div>
    <div class="mb-2">
        <label>Pengantar</label>
        <textarea name="pengantar" class="form-control"></textarea>
    </div>
    <div class="mb-2">
        <label>Latar Belakang</label>
        <textarea name="latar_belakang" class="form-control"></textarea>
    </div>
    <div class="mb-2">
        <label>Tujuan</label>
        <textarea name="tujuan" class="form-control"></textarea>
    </div>
    <div class="mb-2">
        <label>Ruang Lingkup</label>
        <textarea name="ruang_lingkup" class="form-control"></textarea>
    </div>
    <div class="mb-2">
        <label>Upload Gambar</label>
        <input type="file" name="gambar" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection() ?>
