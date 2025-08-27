<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>


<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-4">Buat Artikel Baru</h1>

        <form action="<?= base_url('admin/bpn/simpan-artikel') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Artikel</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori Artikel</label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="Lingkungan & Keberlanjutan">Lingkungan & Keberlanjutan</option>
                    <option value="Pertanian & Ekonomi">Pertanian & Ekonomi</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="konten" class="form-label">Konten Artikel</label>
                <textarea id="konten" name="konten"></textarea>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Artikel</label>
                <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*">

                <!-- Info text -->
                <small class="form-text text-muted">
                    *Ukuran maksimal gambar: <b>100 KB</b><br>
                    **Rasio yang direkomendasikan: <b>800x700 pixels</b>
                </small>

                <?php if (session()->getFlashdata('errors')['gambar'] ?? false): ?>
                    <div class="text-danger small mt-1">
                        <?= session()->getFlashdata('errors')['gambar'] ?>
                    </div>
                <?php endif; ?>

            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</section>

<script>
    document.getElementById('gambar').addEventListener('change', function () {
        const file = this.files[0];
        if (file && file.size > 100 * 1024) { // 100KB in bytes
            alert('Foto melebihi 100KB');
            this.value = ""; // reset file input
        }
    });
</script>

<?= $this->endSection() ?>