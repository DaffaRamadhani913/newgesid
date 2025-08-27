<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Tambah Admin BPD</h3>

<form action="<?= base_url('admin/bpw/adminbpd/store') ?>" method="post">
    <div class="form-group mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Pilih Kota/Kabupaten</label>
        <select name="id_kota" class="form-control" required>
            <option value="">-- Pilih Kota/Kabupaten --</option>
            <?php foreach ($kota as $k): ?>
                <option value="<?= $k['id_kota'] ?>"><?= $k['nama_kota'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('admin/bpw/adminbpd') ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->endSection(); ?>
