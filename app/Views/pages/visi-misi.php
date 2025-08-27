<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- Visi Misi Section -->
<section id="visi-misi" class="py-5">
    <div class="container" data-aos="fade-up">
        <!-- Judul -->
        <div class="text-center mb-5">
            <h2 class="fw-bold fs-1">Visi - Misi</h2>
            <p class="text-warning fw-semibold fs-4">Generasi Emas Indonesia (GESID)</p>
        </div>

        <!-- Kotak Visi & Misi -->
        <div class="bg-dark p-4 rounded shadow-sm" data-aos="fade-up">
            <!-- Visi -->
            <h3 class="fw-bold text-warning mb-3">Visi</h3>
            <p class="fs-5 fst-italic mb-4">
                "Bergerak Bersama Membangun Desa Untuk Indonesia"
            </p>

            <!-- Misi -->
            <h3 class="fw-bold text-warning mb-3">Misi</h3>
            <ul class="list-unstyled mb-0">
                <li class="d-flex mb-4">
                    <span class="me-3 text-warning"><i class="fas fa-check-circle fa-lg"></i></span>
                    <span>
                        <strong>Adaptasi Teknologi Terbarukan:</strong><br>
                        Menciptakan lingkungan desa yang beradaptasi dengan teknologi terbarukan untuk meningkatkan efisiensi dan keberlanjutan.
                    </span>
                </li>
                <li class="d-flex mb-4">
                    <span class="me-3 text-warning"><i class="fas fa-check-circle fa-lg"></i></span>
                    <span>
                        <strong>Peningkatan Daya Saing Generasi Muda Desa:</strong><br>
                        Mencetak generasi muda desa yang memiliki daya saing tinggi dalam ilmu pengetahuan (<em>knowledge</em>), kepemimpinan (<em>leadership</em>), dan kewirausahaan (<em>entrepreneurship</em>).
                    </span>
                </li>
                <li class="d-flex">
                    <span class="me-3 text-warning"><i class="fas fa-check-circle fa-lg"></i></span>
                    <span>
                        <strong>Ruang Aktualisasi Diri:</strong><br>
                        Memberikan ruang seluas-luasnya bagi generasi muda desa untuk mengaktualisasikan diri baik dalam skala lokal maupun global.
                    </span>
                </li>
            </ul>
        </div>
    </div>
</section>

<?= $this->endSection() ?>