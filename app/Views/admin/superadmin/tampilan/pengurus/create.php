<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Tambah Admin BPN</h3>

<form action="<?= base_url('admin/superadmin/adminbpn/store') ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="form-group mb-3">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" value="<?= old('nama') ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="<?= old('username') ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="<?= old('email') ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?= $this->endSection(); ?>
