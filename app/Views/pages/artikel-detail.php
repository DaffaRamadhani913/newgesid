<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold text-white" data-aos="fade-up">
            <?= esc($artikel['judul']) ?>
        </h1>
        <p class="mb-2 text-light" data-aos="fade-up" data-aos-delay="100">
            <i class="bi bi-calendar-event"></i>
            <?= date('d F Y', strtotime($artikel['tanggal_publikasi'])) ?>
            | <?= esc($artikel['kategori']) ?>
        </p>

        <!-- Info Penulis -->
        <p class="text-light" data-aos="fade-up" data-aos-delay="150">
            <i class="bi bi-person-badge"></i>
            Ditulis oleh: <?= esc($artikel['created_label'] ?? '-') ?>
        </p>


        <?php if (!empty($artikel['gambar'])): ?>
            <img src="<?= base_url($artikel['gambar']) ?>" alt="<?= esc($artikel['judul']) ?>"
                class="img-fluid shadow rounded me-3 mb-3" style="max-width: 350px; float: left;" data-aos="zoom-in"
                data-aos-delay="200">
        <?php endif; ?>

        <div style="font-size: 1.1rem; line-height: 1.6; text-align: justify;" data-aos="fade-up" data-aos-delay="300">
            <?= $artikel['konten'] ?>
        </div>

        <div style="clear: both;"></div>

        <a href="<?= base_url('artikel') ?>" class="btn btn-outline-secondary mt-4" data-aos="fade-up"
            data-aos-delay="700">
            ← Kembali ke Semua Artikel
        </a>
    </div>
</section>

<?= $this->endSection() ?>