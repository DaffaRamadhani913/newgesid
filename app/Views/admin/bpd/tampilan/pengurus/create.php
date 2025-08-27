<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h3>Tambah Admin BPDes</h3>

<form action="<?= base_url('admin/bpd/adminbpdes/store') ?>" method="post">
  <div class="form-group mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" required>
  </div>

  <div class="form-group mb-3">
    <label>Username</label>
    <input type="text" name="username" class="form-control" required>
  </div>

  <div class="form-group mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>

  <div class="form-group mb-3">
    <label>Pilih Kecamatan</label>
    <select name="id_kecamatan" id="id_kecamatan" class="form-control" required>
      <option value="">-- Pilih Kecamatan --</option>
      <?php foreach (($kecamatan ?? []) as $kec): ?>
        <option value="<?= $kec['id_kecamatan'] ?>"><?= esc($kec['nama_kecamatan']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group mb-3">
    <label>Pilih Desa/Kelurahan</label>
    <select name="id_desa" id="id_desa" class="form-control" required disabled>
      <option value="">-- Pilih Desa/Kelurahan --</option>
      <?php foreach (($desa ?? []) as $d): ?>
        <option value="<?= $d['id_desa'] ?>"><?= esc($d['nama_desa']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Simpan</button>
  <a href="<?= base_url('admin/bpd/adminbpdes') ?>" class="btn btn-secondary">Batal</a>
</form>

<script>
document.getElementById('id_kecamatan').addEventListener('change', function () {
  const idKec = this.value;
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
        desaSel.appendChild(opt);
      });
      desaSel.disabled = false;
    })
    .catch(() => {
      alert('Gagal memuat daftar desa/kelurahan.');
    });
});
</script>

<?= $this->endSection(); ?>
