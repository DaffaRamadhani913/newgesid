<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Edit Admin BPDes</h3>

<form action="<?= base_url('admin/bpd/adminbpdes/update/' . $bpdes['id']) ?>" method="post">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= esc($bpdes['nama']) ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="<?= esc($bpdes['username']) ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?= esc($bpdes['email']) ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Pilih Kecamatan</label>
        <select name="id_kecamatan" id="kecamatan" class="form-control" required>
            <option value="">-- Pilih Kecamatan --</option>
            <?php foreach ($kecamatan as $k): ?>
                <option value="<?= $k['id_kecamatan'] ?>" <?= $selectedKecamatan == $k['id_kecamatan'] ? 'selected' : '' ?>>
                    <?= esc($k['nama_kecamatan']) ?>
                </option>
            <?php endforeach; ?>
        </select>

    </div>

    <div class="form-group">
        <label>Pilih Desa</label>
        <select name="id_desa" id="desa" class="form-control" required>
            <option value="">-- Pilih Desa --</option>
            <?php foreach ($desa as $d): ?>
                <option value="<?= $d['id_desa'] ?>" <?= $bpdes['id_desa'] == $d['id_desa'] ? 'selected' : '' ?>>
                    <?= esc($d['nama_desa']) ?>
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

<script>
    document.getElementById('kecamatan').addEventListener('change', function () {
        let kecamatanId = this.value;
        let desaSelect = document.getElementById('desa');
        desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';

        if (kecamatanId) {
            fetch("<?= base_url('admin/bpd/adminbpdes/desa-by-kecamatan/') ?>" + kecamatanId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(function (desa) {
                        let selected = desa.id_desa == <?= $bpdes['id_desa'] ?> ? 'selected' : '';
                        desaSelect.innerHTML += `<option value="${desa.id_desa}" ${selected}>${desa.nama_desa}</option>`;
                    });
                });
        }
    });
</script>

<?= $this->endSection(); ?>