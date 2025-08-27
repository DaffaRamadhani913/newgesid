<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<!-- Member Section -->
<section id="member" class="py-5" style="color: #fff;">

    <!-- Section Title -->
    <div class="container text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold fs-1">
            Keuntungan Menjadi Member
        </h2>
        <div style="height:3px; width:60px; background-color:#f5b932; margin:12px auto 0;"></div>
    </div>
    <!-- End Section Title -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-dark rounded shadow-sm p-4 p-lg-5">
                    <p class="lead text-center mb-4">
                        Menjadi member resmi komunitas kami bukan sekadar status, melainkan langkah nyata untuk berkontribusi dan mendapatkan berbagai <strong style="color:#f5b932;">keuntungan eksklusif</strong> yang dirancang untuk mendukung pengembangan diri Anda dan kemajuan desa.
                    </p>

                    <ul class="list-unstyled fs-5">
                        <li class="d-flex mb-3">
                            <span class="me-3 text-warning"><i class="fas fa-check-circle fa-lg"></i></span>
                            <span><strong>Akses Eksklusif ke Event dan Kegiatan Desa:</strong> Informasi dan kesempatan pertama untuk mengikuti acara, festival, pelatihan, dan seminar.</span>
                        </li>
                        <li class="d-flex mb-3">
                            <span class="me-3 text-warning"><i class="fas fa-check-circle fa-lg"></i></span>
                            <span><strong>Program Pelatihan & Workshop Berkualitas:</strong> Berbagai pelatihan dan workshop untuk meningkatkan kemampuan dan pengetahuan Anda.</span>
                        </li>
                        <li class="d-flex mb-3">
                            <span class="me-3 text-warning"><i class="fas fa-check-circle fa-lg"></i></span>
                            <span><strong>Jaringan Luas & Kesempatan Kolaborasi:</strong> Membuka peluang kerja sama dengan berbagai pihak di komunitas.</span>
                        </li>
                        <li class="d-flex mb-3">
                            <span class="me-3 text-warning"><i class="fas fa-check-circle fa-lg"></i></span>
                            <span><strong>Akses Materi Edukasi & Informasi Khusus:</strong> Update rutin materi dan informasi penting khusus member.</span>
                        </li>
                        <li class="d-flex mb-3">
                            <span class="me-3 text-warning"><i class="fas fa-check-circle fa-lg"></i></span>
                            <span><strong>Diskon Khusus & Penawaran Menarik:</strong> Potongan harga & promo dari kegiatan dan mitra kami.</span>
                        </li>
                        <li class="d-flex mb-3">
                            <span class="me-3 text-warning"><i class="fas fa-check-circle fa-lg"></i></span>
                            <span><strong>Pengakuan & Sertifikat Resmi:</strong> Sertifikat resmi atas partisipasi dalam program kami.</span>
                        </li>
                    </ul>

                    <p class="mt-4 text-center fs-5">
                        <strong>Bergabunglah sekarang</strong> dan jadilah agen perubahan untuk membangun desa yang maju, mandiri, dan sejahtera.
                    </p>
                </div>
            </div>
        </div>

        <!-- Card Cara Daftar & Formulir -->
        <div class="row g-4 mt-4">
            <!-- Card Cara Daftar -->
            <div class="col-md-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="text-center p-4 shadow-sm rounded bg-dark text-white h-100">
                    <i class="bi bi-journal-text fs-1 text-warning"></i>
                    <h5 class="mt-3 fw-bold text-warning">Cara Daftar</h5>
                    <p>Pelajari langkah-langkah mudah untuk menjadi anggota kami.</p>
                    <a href="<?= base_url('cara-daftar') ?>" class="btn btn-warning text-dark fw-semibold mt-3">Lihat Selengkapnya</a>
                </div>
            </div>

            <!-- Card Formulir Pendaftaran -->
            <div class="col-md-6" data-aos="zoom-in" data-aos-delay="400">
                <div class="text-center p-4 shadow-sm rounded bg-dark text-white h-100">
                    <i class="bi bi-pencil-square fs-1 text-warning"></i>
                    <h5 class="mt-3 fw-bold text-warning">Formulir Pendaftaran</h5>
                    <p>Isi formulir online untuk bergabung bersama komunitas kami.</p>
                    <a href="<?= base_url('formulir-pendaftaran') ?>" class="btn btn-warning text-dark fw-semibold mt-3">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>