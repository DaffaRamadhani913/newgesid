<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Edit Admin BPN</h3>

<form action="<?= base_url('admin/superadmin/adminbpn/update/' . $bpn['id']) ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="form-group mb-3">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?= old('nama', esc($bpn['nama'])) ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= old('username', esc($bpn['username'])) ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= old('email', esc($bpn['email'])) ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="password">Password <small class="text-muted">(kosongkan jika tidak diganti)</small></label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?= $this->endSection(); ?>
