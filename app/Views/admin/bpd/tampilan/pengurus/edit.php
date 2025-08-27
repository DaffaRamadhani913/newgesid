<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Edit Admin BPDes</h3>

<form action="<?= base_url('admin/bpd/adminbpdes/update/' . $bpdes['id']) ?>" method="post">
  <div class="form-group mb-3">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= esc($bpdes['nama']) ?>" class="form-control" required>
  </div>

  <div class="form-group mb-3">
    <label>Username</label>
    <input type="text" name="username" value="<?= esc($bpdes['username']) ?>" class="form-control" required>
  </div>

  <div class="form-group mb-3">
    <label>Pilih Kecamatan</label>
    <select name="id_kecamatan" id="id_kecamatan" class="form-control" required>
      <option value="">-- Pilih Kecamatan --</option>
      <?php foreach (($kecamatan ?? []) as $kec): ?>
        <option value="<?= $kec['id_kecamatan'] ?>"
          <?= (isset($selectedKecamatan) && $selectedKecamatan == $kec['id_kecamatan']) ? 'selected' : '' ?>>
          <?= esc($kec['nama_kecamatan']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group mb-3">
    <label>Pilih Desa/Kelurahan</label>
    <select name="id_desa" id="id_desa" class="form-control" required>
      <option value="">-- Pilih Desa/Kelurahan --</option>
      <?php foreach (($desa ?? []) as $d): ?>
        <option value="<?= $d['id_desa'] ?>"
          <?= ($bpdes['id_desa'] == $d['id_desa']) ? 'selected' : '' ?>>
          <?= esc($d['nama_desa']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group mb-3">
    <label>Password (kosongkan jika tidak diganti)</label>
    <input type="password" name="password" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
  <a href="<?= base_url('admin/bpd/adminbpdes') ?>" class="btn btn-secondary">Batal</a>
</form>

<script>
function loadDesa(idKec, preselect) {
  const desaSel = document.getElementById('id_desa');
  desaSel.innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
  desaSel.disabled = true;

  if (!idKec) return;

  fetch('<?= base_url('admin/bpd/adminbpdes/desa-by-kecamatan') ?>/' + idKec)
    .then(r => r.json())
    .then(list => {
      list.forEach(d => {
        const opt = document.createElement('option');
        opt.value = d.id_desa;
        opt.textContent = d.nama_desa;
        if (preselect && String(preselect) === String(d.id_desa)) opt.selected = true;
        desaSel.appendChild(opt);
      });
      desaSel.disabled = false;
    })
    .catch(() => {
      alert('Gagal memuat daftar desa/kelurahan.');
    });
}

document.getElementById('id_kecamatan').addEventListener('change', function () {
  loadDesa(this.value, null);
});

// on load: if a kecamatan already selected, refresh desa list
<?php if (!empty($selectedKecamatan)): ?>
  loadDesa('<?= $selectedKecamatan ?>', '<?= $bpdes['id_desa'] ?>');
<?php endif; ?>
</script>

<?= $this->endSection(); ?>
