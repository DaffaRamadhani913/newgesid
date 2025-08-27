<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- About Section -->
<section id="about" class="about section" style="width: 100%;">

    <!-- Section Title -->
    <div class="container text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold fs-1">
            Kontak GESID
        </h2>
        <div style="height:3px; width:60px; background-color:#f5b932; margin:12px auto 0;"></div>
    </div>
    <!-- End Section Title -->

    <div class="container-fluid px-5">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-12" data-aos="fade-left" data-aos-delay="300">
                <div class="about-content text-center">
                    <p>
                        Generasi Emas Indonesia (GESID) adalah organisasi yang berdiri pada tahun 2023
                        dengan misi mendorong kemajuan desa di tengah arus globalisasi dan tantangan lingkungan.
                        GESID memandang desa sebagai pilar penting dalam pembangunan berkelanjutan,
                        melalui pengelolaan sumber daya alam yang bijak, penguatan ketahanan pangan,
                        dan adaptasi terhadap perubahan iklim.
                    </p>
                    <p>
                        Dalam perjalanannya, GESID berkomitmen memberdayakan generasi muda desa agar mampu
                        menjadi motor penggerak inovasi dan kemandirian, sekaligus memanfaatkan peluang
                        bonus demografi 2020–2045. Melalui sinergi antara masyarakat, pemerintah,
                        dan pelaku usaha lokal, GESID berupaya menciptakan desa yang mandiri, produktif,
                        dan berdaya saing di era digital.
                    </p>


                    <div class="row g-4 mt-3 justify-content-center">
                        <!-- Card Latar Belakang -->
                        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                            <div class="feature-item text-center p-4 shadow-sm rounded h-100 d-flex flex-column">
                                <i class="bi bi-info-circle-fill fs-1 text-primary"></i>
                                <h5 class="mt-3">Latar Belakang</h5>
                                <p>Pelajari latar belakang dan tujuan dari GESID dalam membangun generasi emas Indonesia.</p>
                                <a href="<?= base_url('latar-belakang') ?>" class="btn btn-primary w-100 py-2 mt-auto rounded-1">Baca Selengkapnya</a>
                            </div>
                        </div>

                        <!-- Card Visi & Misi -->
                        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                            <div class="feature-item text-center p-4 shadow-sm rounded h-100 d-flex flex-column">
                                <i class="bi bi-bullseye fs-1 text-success"></i>
                                <h5 class="mt-3">Visi & Misi</h5>
                                <p>Kenali visi besar dan misi utama GESID dalam mendukung pembangunan sumber daya manusia.</p>
                                <a href="<?= base_url('visi-misi') ?>" class="btn btn-success w-100 py-2 mt-auto">Baca Selengkapnya</a>
                            </div>
                        </div>

                        <!-- Card Pengurus BPN -->
                        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="500">
                            <div class="feature-item text-center p-4 shadow-sm rounded h-100 d-flex flex-column">
                                <i class="bi bi-people-fill fs-1 text-warning"></i>
                                <h5 class="mt-3">Pengurus BPN</h5>
                                <p>Daftar pengurus inti Badan Pengurus Nasional (BPN) GESID dan struktur organisasinya.</p>
                                <a href="<?= base_url('pengurus-bpn') ?>" class="btn btn-warning w-100 py-2 mt-auto text-white">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /About Section -->

<?= $this->endSection() ?>