<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Edit Admin BPD</h3>

<form action="<?= base_url('admin/bpw/adminbpd/update/' . $bpd['id']) ?>" method="post">
    <div class="form-group mb-3">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= esc($bpd['nama']) ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Username</label>
        <input type="text" name="username" value="<?= esc($bpd['username']) ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Pilih Kota/Kabupaten</label>
        <select name="id_kota" class="form-control" required>
            <option value="">-- Pilih Kota/Kabupaten --</option>
            <?php foreach ($kota as $k): ?>
                <option value="<?= $k['id_kota'] ?>" 
                    <?= $bpd['id_kota'] == $k['id_kota'] ? 'selected' : '' ?>>
                    <?= esc($k['nama_kota']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Password (kosongkan jika tidak diganti)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('admin/bpw/adminbpd') ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->endSection(); ?>
