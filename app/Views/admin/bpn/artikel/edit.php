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
        <h1 class="fw-bold mb-4">Edit Artikel</h1>

        <form action="<?= base_url('admin/bpn/update-artikel/' . $artikel['id']) ?>" method="post"
            enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Artikel</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?= esc($artikel['judul']) ?>"
                    required>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori Artikel</label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="Lingkungan & Keberlanjutan" <?= $artikel['kategori'] == 'Lingkungan & Keberlanjutan' ? 'selected' : '' ?>>Lingkungan & Keberlanjutan</option>
                    <option value="Pertanian & Ekonomi" <?= $artikel['kategori'] == 'Pertanian & Ekonomi' ? 'selected' : '' ?>>Pertanian & Ekonomi</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="konten" class="form-label">Konten Artikel</label>
                <textarea id="konten" name="konten"><?= $artikel['konten'] ?></textarea>
            </div>

            <!-- Gambar -->
            <div class="mb-3">
                <label class="form-label fw-bold">Gambar Artikel</label><br>
                <?php if (!empty($artikel['gambar'])): ?>
                    <img src="<?= base_url($artikel['gambar']) ?>" alt="thumbnail" class="img-thumbnail mb-2"
                        style="max-width: 150px;">
                    <br>
                <?php endif; ?>
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <small class="text-muted">
                    *Ukuran maksimal gambar: 100 KB<br>
                    **Rasio yang direkomendasikan: 800x700 pixels
                </small>
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</section>

<script>
    // Limit image size
    document.getElementById('gambar').addEventListener('change', function () {
        const file = this.files[0];
        if (file && file.size > 100 * 1024) {
            alert('Foto melebihi 100KB');
            this.value = "";
        }
    });
</script>

<?= $this->endSection() ?>