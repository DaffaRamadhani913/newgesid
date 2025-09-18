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

    <!-- Sub Role Select -->
    <div class="form-group mb-3">
        <label for="sub_role">Sub Role</label>
        <select name="sub_role" id="sub_role" class="form-control" required>
            <option value="" disabled>-- Pilih Sub Role --</option>
            <option value="okk" <?= old('sub_role', $bpn['sub_role']) === 'okk' ? 'selected' : '' ?>>Admin OKK BPN</option>
            <option value="humas" <?= old('sub_role', $bpn['sub_role']) === 'humas' ? 'selected' : '' ?>>Admin Humas BPN</option>
            <option value="sekretariat" <?= old('sub_role', $bpn['sub_role']) === 'sekretariat' ? 'selected' : '' ?>>Admin Sekretariat BPN</option>
            <option value="presiden" <?= old('sub_role', $bpn['sub_role']) === 'presiden' ? 'selected' : '' ?>>Presiden BPN</option>
            <option value="sekjen" <?= old('sub_role', $bpn['sub_role']) === 'sekjen' ? 'selected' : '' ?>>SekJen BPN</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?= $this->endSection(); ?>
