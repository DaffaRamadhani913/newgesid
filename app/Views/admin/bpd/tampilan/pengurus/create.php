<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Tambah Admin BPDes</h3>

<form action="<?= base_url('admin/bpd/adminbpdes/store') ?>" method="post">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Pilih Kecamatan</label>
        <select name="id_kecamatan" id="kecamatan" class="form-control" required>
            <option value="">-- Pilih Kecamatan --</option>
            <?php foreach ($kecamatan as $k): ?>
                <option value="<?= $k['id_kecamatan'] ?>"><?= $k['nama_kecamatan'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Pilih Desa</label>
        <select name="id_desa" id="desa" class="form-control" required>
            <option value="">-- Pilih Desa --</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<script>
    document.getElementById('kecamatan').addEventListener('change', function() {
        let kecamatanId = this.value;
        let desaSelect = document.getElementById('desa');
        desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';

        if (kecamatanId) {
            fetch("<?= base_url('admin/bpd/adminbpdes/desa-by-kecamatan/') ?>" + kecamatanId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(function(desa) {
                        desaSelect.innerHTML += `<option value="${desa.id_desa}">${desa.nama_desa}</option>`;
                    });
                });
        }
    });
</script>

<?= $this->endSection(); ?>
