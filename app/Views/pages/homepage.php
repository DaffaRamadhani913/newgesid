<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container">
            <div class="row">
                <!-- Kolom Teks -->
                <div class="col-lg-7 content-col" data-aos="fade-up">
                    <div class="content">
                        <div class="main-heading">
                            <h1>GENERASI EMAS <br>INDONESIA</h1>
                        </div>
                        <div class="divider"></div>
                        <div class="description">
                            <p>
                                Generasi Emas Indonesia (GESID) adalah organisasi yang dibentuk pada tahun 2023
                                dengan fokus utama pada pengembangan desa dalam menghadapi era globalisasi
                                dan tantangan lingkungan. GESID memandang desa sebagai elemen penting dalam
                                mendorong pembangunan berkelanjutan melalui pengelolaan sumber daya alam,
                                peningkatan ketahanan pangan, dan adaptasi terhadap perubahan iklim.
                            </p>
                        </div>
                    </div>
                </div>
    
                <!-- Kolom Slider -->
                <div class="col-lg-5" data-aos="zoom-out">
                    <div class="hero-slider swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="<?= base_url('assets/img/abstract/abstract-1.png?v='.time()) ?>" alt="Slide 1" class="img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="<?= base_url('assets/img/abstract/abstract-2.png?v='.time()) ?>" alt="Slide 2" class="img-fluid">
                        </div>
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Hero Section -->



    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tentang</h2>
            <div><span>Pelajari Lebih Lanjut</span> <span class="description-title">Tentang Kami</span></div>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gx-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="about-image position-relative">
                        <img src="assets/img/about/Logo GESID-01.jpg" class="img-fluid rounded-4 shadow-sm"
                            alt="About Image" loading="lazy">
                    </div>
                </div>

                <div class="col-lg-6 mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="300">
                    <div class="about-content">
                        <h2>Pembentukan GESID didorong oleh</h2>
                        <p>
                            <strong>Peran Desa dalam Pembangunan Berkelanjutan</strong> – Desa memiliki potensi sumber
                            daya alam dan manusia yang besar untuk mendorong kemandirian dan kesejahteraan.
                        </p>
                        <p>
                            <strong>Bonus Demografi 2020–2045</strong> – Meningkatnya penduduk usia produktif, termasuk
                            di desa, memerlukan pemberdayaan generasi muda agar potensi ini dapat dimanfaatkan maksimal.
                        </p>

                        <div class="row g-4 mt-3">
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                                <a href="<?= base_url('latar-belakang') ?>" class="text-decoration-none">
                                    <div class="feature-item text-center p-4 shadow-sm rounded h-100">
                                        <i class="bi bi-info-circle-fill fs-1 text-primary"></i>
                                        <h5 class="mt-3 text-white">Latar Belakang</h5>
                                        <p class="text-white-50">
                                            Pelajari latar belakang dan tujuan dari GESID dalam membangun generasi emas
                                            Indonesia.
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                                <a href="<?= base_url('visi-misi') ?>" class="text-decoration-none">
                                    <div class="feature-item text-center p-4 shadow-sm rounded h-100">
                                        <i class="bi bi-bullseye fs-1 text-success"></i>
                                        <h5 class="mt-3 text-white">Visi & Misi</h5>
                                        <p class="text-white-50">
                                            Kenali visi besar dan misi utama GESID dalam mendukung pembangunan sumber
                                            daya manusia.
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="500">
                                <a href="<?= base_url('pengurus-bpn') ?>" class="text-decoration-none">
                                    <div class="feature-item text-center p-4 shadow-sm rounded h-100">
                                        <i class="bi bi-people-fill fs-1 text-warning"></i>
                                        <h5 class="mt-3 text-white">Pengurus BPN</h5>
                                        <p class="text-white-50">
                                            Daftar pengurus Badan Pengurus Nasional (BPN) GESID dan struktur
                                            organisasinya.
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <a href="<?= base_url('about') ?>" class="btn btn-primary mt-4">Lihat Selengkapnya..</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /About Section -->

    <!-- ===== Article Section ===== -->
    <section id="articles" class="articles section py-5">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Artikel GESID</h2>
            <div><span>Informasi & Berita</span> <span class="description-title">Seputar GESID</span></div>
        </div>

        <div class="container">
            <div class="row">
                <!-- Artikel Utama (first article) -->
                <?php if (!empty($latestArticles)): ?>
                    <?php $mainArticle = array_shift($latestArticles); ?>
                    <div class="col-lg-8 mb-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="card border-0 shadow-lg h-100">
                            <img src="<?= base_url($mainArticle['gambar'] ?? 'assets/img/artikel/default.jpg') ?>"
                                class="card-img-top" alt="<?= $mainArticle['judul'] ?>">
                            <div class="card-body">
                                <div class="d-flex align-items-center text-muted mb-2">
                                    <i class="bi bi-calendar-event me-2"></i>
                                    <?= date('d F Y', strtotime($mainArticle['tanggal_publikasi'] ?? $mainArticle['tanggal'] ?? date('Y-m-d'))) ?>
                                    <span class="mx-2">•</span>
                                    <span><?= $mainArticle['kategori'] ?? 'Umum' ?></span>
                                </div>
                                <h5 class="card-title fw-bold"><?= $mainArticle['judul'] ?></h5>
                                <p class="card-text"><?= substr(strip_tags($mainArticle['konten']), 0, 150) ?>...</p>
                                <a href="<?= base_url('artikel/detail/' . $mainArticle['id'] ?? 1) ?>"
                                    class="btn text-white fw-bold rounded-pill px-4" style="background-color: #ffc107;">
                                    Baca Selengkapnya..
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Artikel Lainnya -->
                    <div class="col-lg-4" data-aos="fade-left" data-aos-delay="200">
                        <h5 class="fw-bold mb-3">Artikel Lainnya</h5>
                        <div class="list-group list-group-flush mb-3">
                            <?php foreach ($latestArticles as $index => $article): ?>
                                <a href="<?= base_url('artikel/detail/' . $article['id']) ?>"
                                    class="list-group-item list-group-item-action d-flex align-items-center" data-aos="fade-up"
                                    data-aos-delay="<?= 200 + ($index * 100) ?>">
                                    <img src="<?= base_url($article['gambar'] ?? 'assets/img/artikel/default.jpg') ?>"
                                        alt="Thumb" class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                                    <div>
                                        <small class="text-muted d-block mb-1"><i class="bi bi-calendar-event me-1"></i>
                                            <?= date('d F Y', strtotime($article['tanggal_publikasi'] ?? $article['tanggal'] ?? date('Y-m-d'))) ?></small>
                                        <span class="fw-semibold"><?= $article['judul'] ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <!-- Tombol Lihat Semua -->
                        <div class="text-end" data-aos="fade-up" data-aos-delay="500">
                            <a href="<?= base_url('artikel') ?>"
                                class="btn btn-outline-warning rounded-pill px-4 fw-bold">Lihat Semua Artikel</a>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-center">Belum ada artikel tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- ===== End Article Section ===== -->


    <!-- Event Section -->
    <section id="events" class="services section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Event</h2>
            <div>
                <span>Dari GESID untuk Indonesia:</span>
                <span class="description-title">Inspirasi & Aksi Nyata</span>
            </div>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="service-header text-center">
                <div class="service-summary">
                    <p style="font-weight: 600;">
                        Dari panggung budaya, kegiatan sosial, hingga perayaan penuh warna — setiap event GESID
                        dirancang untuk membangun kebersamaan, melestarikan tradisi, dan mendorong kreativitas.
                        Mari bergabung dalam momen-momen berkesan yang tak hanya menghangatkan hati,
                        tetapi juga menggerakkan langkah menuju kemajuan bersama.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <?php if (!empty($acaras)): ?>
                    <?php foreach (array_slice($acaras, 0, 3) as $index => $acara): ?>
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="<?= 100 + ($index * 150) ?>">
                            <div style="background: #0d1b24; border-radius: 12px; overflow: hidden; 
                            border: 2px solid #ddd; 
                            box-shadow: 0 4px 12px rgba(0,0,0,0.08); 
                            display: flex; flex-direction: column; height: 100%;">

                                <!-- Poster -->
                                <img src="<?= base_url('uploads/events/' . ($acara['gambar'] ?? 'default.jpg')) ?>"
                                    alt="<?= $acara['judul'] ?>" style="width: 100%; aspect-ratio: 1/1; object-fit: cover;">

                                <!-- Caption -->
                                <div style="padding: 20px; text-align: center; flex-grow: 1;">
                                    <h5 style="font-weight: 700; font-size: 1.3rem; margin-bottom: 10px; color: white;">
                                        <?= $acara['judul'] ?>
                                    </h5>
                                    <p style="font-size: 1rem; color: #ddd; line-height: 1.5;">
                                        <?= substr(strip_tags($acara['deskripsi']), 0, 150) ?>...
                                    </p>
                                    <small
                                        class="text-muted"><?= date('d F Y', strtotime($acara['created_at'] ?? date('Y-m-d'))) ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Belum ada event tersedia.</p>
                <?php endif; ?>
            </div>

            <!-- Tombol di bawah daftar event -->
            <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                <a href="<?= base_url('event') ?>" class="service-btn mt-2"
                    style="background-color: #ffc107; color: #fff; padding: 12px 28px; border-radius: 50px; font-weight: 600; display: inline-block;">
                    Lihat Semua Event
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- End Event Section -->



    <!-- Member Section -->
    <section id="member" class="member section">

        <div class="container section-title" data-aos="fade-up">
            <h2>Member</h2>
            <div><span>Kenali Lebih Dekat</span> <span class="description-title">Ayo Bergabung Bersama Kami</span></div>
        </div>

        <div class="container">

            <div class="row gx-5 align-items-center">
                <!-- Gambar di kiri -->
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="member-image position-relative">
                        <img src="assets/img/member/member.jpg" class="img-fluid rounded-4 shadow-sm" alt="Member Image"
                            loading="lazy">
                    </div>
                </div>

                <!-- Konten di kanan -->
                <div class="col-lg-6 mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="300">
                    <h2>Bergabunglah dengan Keluarga GESID</h2>
                    <p class="lead">Ayo jadi bagian dari komunitas yang hangat dan penuh inspirasi. Bersama GESID, kita
                        saling berbagi, belajar, dan tumbuh bersama.</p>
                    <p>Melalui kegiatan seru, pelatihan bermanfaat, dan peluang kolaborasi, Anda akan menemukan teman
                        baru, wawasan baru, dan kesempatan untuk berkembang baik secara pribadi maupun profesional.</p>

                    <div class="row g-4 mt-3">
                        <!-- Card Cara Daftar -->
                        <div class="col-md-6" data-aos="zoom-in" data-aos-delay="300">
                            <div class="feature-item text-center p-4 shadow-sm rounded bg-dark text-white h-100">
                                <i class="bi bi-journal-text fs-1 text-primary"></i>
                                <h5 class="mt-3">Cara Daftar</h5>
                                <p>Pelajari langkah-langkah mudah untuk menjadi anggota kami.</p>
                                <a href="<?= base_url('cara-daftar') ?>" class="btn btn-outline-primary mt-3">Lihat
                                    Selengkapnya</a>
                            </div>
                        </div>

                        <!-- Card Formulir Pendaftaran -->
                        <div class="col-md-6" data-aos="zoom-in" data-aos-delay="400">
                            <div class="feature-item text-center p-4 shadow-sm rounded bg-dark text-white h-100">
                                <i class="bi bi-pencil-square fs-1 text-success"></i>
                                <h5 class="mt-3">Formulir Pendaftaran</h5>
                                <p>Isi formulir online untuk bergabung bersama komunitas kami.</p>
                                <a href="<?= base_url('formulir-pendaftaran') ?>"
                                    class="btn btn-outline-success mt-3">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-start">
                        <a href="<?= base_url('halaman-member') ?>" class="btn btn-warning text-white"
                            style="font-size: 1rem; padding: 8px 28px; border-radius: 50px;">
                            Lihat Selengkapnya..
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Member Section -->


    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak</h2>
            <div><span>Ayo</span> <span class="description-title">Terhubung</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                <!-- Kiri: Informasi Kontak -->
                <div class="col-lg-6">
                    <div class="row gy-4 mb-4">
                        <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                            <div class="contact-info-box">
                                <div class="icon-box">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Our Address</h4>
                                    <p>1842 Maple Avenue, Portland, Oregon 97204</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                            <div class="contact-info-box">
                                <div class="icon-box">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Email Address</h4>
                                    <p>info@example.com</p>
                                    <p>contact@example.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12" data-aos="fade-up" data-aos-delay="300">
                            <div class="contact-info-box">
                                <div class="icon-box">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Hours of Operation</h4>
                                    <p>Sunday-Fri: 9 AM - 6 PM</p>
                                    <p>Saturday: 9 AM - 4 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Google Maps -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200"
                    style="display:flex; align-items:stretch;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7876274.074299177!2d95.37727564121098!3d-2.548926043842915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1b3fba2c4c9ff5%3A0x301576d14feb720!2sIndonesia!5e0!3m2!1sid!2sid!4v1692443696571!5m2!1sid!2sid"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

    </section><!-- /Contact Section -->

</main>
<?= $this->endSection() ?>