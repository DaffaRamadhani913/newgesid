<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Edit Admin BPW</h3>

<form action="<?= base_url('admin/bpn/adminbpw/update/' . $bpw['id']) ?>" method="post">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= esc($bpw['nama']) ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="<?= esc($bpw['username']) ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Pilih Provinsi</label>
        <select name="id_provinsi" class="form-control" required>
            <option value="">-- Pilih Provinsi --</option>
            <?php foreach ($provinsi as $prov): ?>
                <option value="<?= $prov['id_provinsi'] ?>" 
                    <?= $bpw['id_provinsi'] == $prov['id_provinsi'] ? 'selected' : '' ?>>
                    <?= esc($prov['nama_provinsi']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Password (kosongkan jika tidak diganti)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?= $this->endSection(); ?>
