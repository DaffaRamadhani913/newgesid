<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Edit Admin BPW</h3>

<form action="<?= base_url('admin/bpn/adminbpw/update/' . $bpw['id']) ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group mb-3">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?= esc($bpw['nama']) ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= esc($bpw['username']) ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= esc($bpw['email'] ?? '') ?>" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="password">Password (kosongkan jika tidak diganti)</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="id_provinsi">Pilih Provinsi</label>
        <select name="id_provinsi" id="id_provinsi" class="form-control" required>
            <option value="">-- Pilih Provinsi --</option>
            <?php foreach ($provinsi as $prov): ?>
                <option value="<?= $prov['id_provinsi'] ?>" <?= $bpw['id_provinsi'] == $prov['id_provinsi'] ? 'selected' : '' ?>>
                    <?= esc($prov['nama_provinsi']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?= $this->endSection(); ?>
