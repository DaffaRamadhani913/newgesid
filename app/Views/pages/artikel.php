<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <h2 class="mb-4 fw-bold" data-aos="fade-up">Artikel Terbaru GESID</h2>
        <div class="row">
            <?php if (!empty($artikel)): ?>
                <?php foreach ($artikel as $i => $a): ?>
                    <?php 
                        $delay = ($i + 1) * 100; 
                        $konten = strip_tags($a['konten']);
                        $preview = (strlen($konten) > 120) ? substr($konten, 0, 120) . '...' : $konten;
                    ?>
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                        <div class="card h-100 shadow-sm border" style="background-color: #0d1b24; color: white;">
                            <img src="<?= base_url($a['gambar']) ?>"
                                class="card-img-top" alt="<?= esc($a['judul']) ?>">
                            <div class="card-body">
                                <small class="d-block mb-2 text-light">
                                    <i class="bi bi-calendar-event"></i>
                                    <?= date('d F Y', strtotime($a['tanggal_publikasi'])) ?>
                                </small>
                                <h5 class="fw-bold text-white"><?= esc($a['judul']) ?></h5>
                                <p><?= esc($preview) ?></p>
                                <a href="<?= base_url('artikel/detail/' . $a['id']) ?>"
                                    class="btn btn-success btn-sm rounded-pill mt-2">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-light">Belum ada artikel tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
