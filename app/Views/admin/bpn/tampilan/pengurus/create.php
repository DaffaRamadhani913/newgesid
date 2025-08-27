<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Tambah Admin BPW</h3>

<form action="<?= base_url('admin/bpn/adminbpw/store') ?>" method="post">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Pilih Provinsi</label>
        <select name="id_provinsi" class="form-control" required>
            <option value="">-- Pilih Provinsi --</option>
            <?php foreach ($provinsi as $p): ?>
                <option value="<?= $p['id_provinsi'] ?>"><?= $p['nama_provinsi'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?= $this->endSection(); ?>
