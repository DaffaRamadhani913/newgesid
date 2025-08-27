<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4" data-aos="fade-up">
            Kategori: <?= esc($kategori_nama) ?>
        </h2>
        <div class="row">
            <?php if (!empty($artikel)): ?>
                <?php foreach ($artikel as $i => $a): ?>
                    <?php $delay = ($i + 1) * 100; ?>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="<?= $delay ?>">
                        <div class="card h-100 shadow-sm border" style="background-color: #0d1b24; color: white;">
                            <img src="<?= base_url($a['gambar']) ?>"
                                class="card-img-top" alt="<?= esc($a['judul']) ?>">
                            <div class="card-body">
                                <small class="d-block mb-2 text-light">
                                    <i class="bi bi-calendar-event"></i>
                                    <?= date('d F Y', strtotime($a['tanggal_publikasi'])) ?>
                                </small>
                                <h6 class="fw-bold text-white"><?= esc($a['judul']) ?></h6>
                                <a href="<?= base_url('artikel/detail/' . $a['id']) ?>"
                                    class="btn btn-warning btn-sm mt-2">Baca</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-light">Belum ada artikel dalam kategori ini.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
