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

    <!-- Sub Role Select -->
    <div class="form-group mb-3">
        <label for="sub_role">Sub Role</label>
        <select name="sub_role" id="sub_role" class="form-control" required>
            <option value="" disabled selected>-- Pilih Sub Role --</option>
            <option value="okk" <?= old('sub_role') === 'okk' ? 'selected' : '' ?>>Admin OKK BPN</option>
            <option value="humas" <?= old('sub_role') === 'humas' ? 'selected' : '' ?>>Admin Humas BPN</option>
            <option value="sekretariat" <?= old('sub_role') === 'sekretariat' ? 'selected' : '' ?>>Admin Sekretariat BPN
            </option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?= $this->endSection(); ?>