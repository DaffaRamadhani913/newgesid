<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Tambah Admin BPW</h3>

<form action="<?= base_url('admin/bpn/adminbpw/store') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group mb-3">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?= old('nama') ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= old('username') ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= old('email') ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="id_provinsi">Pilih Provinsi</label>
        <select name="id_provinsi" id="id_provinsi" class="form-control" required>
            <option value="">-- Pilih Provinsi --</option>
            <?php foreach ($provinsi as $p): ?>
                <option value="<?= $p['id_provinsi'] ?>" <?= old('id_provinsi') == $p['id_provinsi'] ? 'selected' : '' ?>>
                    <?= esc($p['nama_provinsi']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?= $this->endSection(); ?>
