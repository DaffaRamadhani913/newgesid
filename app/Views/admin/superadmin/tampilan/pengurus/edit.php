<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Edit Admin BPN</h3>

<form action="<?= base_url('admin/superadmin/adminbpn/update/' . $bpn['id']) ?>" method="post">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= esc($bpn['nama']) ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="<?= esc($bpn['username']) ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Password (kosongkan jika tidak diganti)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>


<?= $this->endSection(); ?>
