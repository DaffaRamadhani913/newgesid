<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= esc($title ?? 'Generasi Emas Indonesia') ?></title>

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">
    <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Raleway:wght@400;700&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/aos/aos.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://unpkg.com/swiper/swiper-bundle.min.css" rel="stylesheet">

</head>

<body>

    <?php $uri = service('uri'); ?>

    <!-- ===== HEADER ===== -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="<?= base_url() ?>" class="logo d-flex align-items-center me-auto me-xl-0">
                <img src="<?= base_url('assets/img/logo_GESID.png') ?>" alt="Logo GESID" style="height: 35px; margin-right: 8px;">
                <h1 class="sitename" style="font-size: 20px; margin: 0;">Generasi Emas Indonesia</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="<?= base_url('/') ?>" class="<?= ($uri->getSegment(1) == '' ? 'active' : '') ?>">Beranda</a></li>

                    <li class="dropdown <?= in_array($uri->getSegment(1), ['about', 'latar-belakang', 'visi-misi', 'pengurus-bpn']) ? 'active' : '' ?>">
                        <a href="#"><span>Tentang GESID</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url('about') ?>" class="<?= ($uri->getSegment(1) == 'about' ? 'active' : '') ?>">Tentang GESID</a></li>
                            <li><a href="<?= base_url('latar-belakang') ?>" class="<?= ($uri->getSegment(1) == 'latar-belakang' ? 'active' : '') ?>">Latar Belakang</a></li>
                            <li><a href="<?= base_url('visi-misi') ?>" class="<?= ($uri->getSegment(1) == 'visi-misi' ? 'active' : '') ?>">Visi & Misi</a></li>
                            <li><a href="<?= base_url('pengurus-bpn') ?>" class="<?= ($uri->getSegment(1) == 'pengurus-bpn' ? 'active' : '') ?>">Pengurus BPN</a></li>
                        </ul>
                    </li>

                    <li class="dropdown <?= (in_array($uri->getSegment(1), ['artikel', 'artikel-kategori'])) ? 'active' : '' ?>">
                        <a href="#"><span>Artikel</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li>
                                <a href="<?= base_url('artikel') ?>"
                                    class="<?= ($uri->getSegment(1) == 'artikel' && $uri->getSegment(2) == '') ? 'active' : '' ?>">
                                    Semua Artikel
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('artikel-kategori/1') ?>"
                                    class="<?= ($uri->getSegment(1) == 'artikel-kategori' && $uri->getSegment(2) == '1') ? 'active' : '' ?>">
                                    Lingkungan & Keberlanjutan
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('artikel-kategori/2') ?>"
                                    class="<?= ($uri->getSegment(1) == 'artikel-kategori' && $uri->getSegment(2) == '2') ? 'active' : '' ?>">
                                    Pertanian & Ekonomi
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="<?= base_url('event') ?>" class="<?= ($uri->getSegment(1) == 'event' ? 'active' : '') ?>">Acara</a></li>

                    <li class="dropdown <?= in_array($uri->getSegment(1), ['halaman-member', 'cara-daftar', 'formulir-pendaftaran']) ? 'active' : '' ?>">
                        <a href="#"><span>Member</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url('halaman-member') ?>" class="<?= ($uri->getSegment(1) == 'halaman-member' ? 'active' : '') ?>">Halaman Member</a></li>
                            <li><a href="<?= base_url('cara-daftar') ?>" class="<?= ($uri->getSegment(1) == 'cara-daftar' ? 'active' : '') ?>">Cara Daftar</a></li>
                            <li><a href="<?= base_url('formulir-pendaftaran') ?>" class="<?= ($uri->getSegment(1) == 'formulir-pendaftaran' ? 'active' : '') ?>">Formulir Pendaftaran</a></li>
                        </ul>
                    </li>

                    <li><a href="<?= base_url('contact') ?>" class="<?= ($uri->getSegment(1) == 'contact' ? 'active' : '') ?>">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="<?= base_url('login') ?>">Login</a>
        </div>
    </header>
    <!-- ===== END HEADER ===== -->


    <!-- ===== MAIN CONTENT ===== -->
    <main style="margin-top: 80px;">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <!-- Logo & Sosmed -->
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="<?= base_url() ?>" class="logo d-flex align-items-center">
                        <span class="sitename">Generasi Emas Indonesia</span>
                    </a>
                    <div class="social-links d-flex mt-4">
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/gesidindonesia/"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
    
                <!-- Menu Tentang GESID -->
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Tentang GESID</h4>
                    <ul>
                        <li><a href="<?= base_url('about') ?>">Tentang GESID</a></li>
                        <li><a href="<?= base_url('latar-belakang') ?>">Latar Belakang</a></li>
                        <li><a href="<?= base_url('visi-misi') ?>">Visi & Misi</a></li>
                        <li><a href="<?= base_url('pengurus-bpn') ?>">Pengurus BPN</a></li>
                    </ul>
                </div>
    
                <!-- Menu Artikel -->
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Artikel</h4>
                    <ul>
                        <li><a href="<?= base_url('artikel') ?>">Semua Artikel</a></li>
                        <li><a href="<?= base_url('artikel-kategori/1') ?>">Lingkungan & Keberlanjutan</a></li>
                        <li><a href="<?= base_url('artikel-kategori/2') ?>">Pertanian & Ekonomi</a></li>
                    </ul>
                </div>
    
                <!-- Kontak -->
                <div class="col-lg-3 col-md-12 footer-contact">
                    <h4>Kontak Kami</h4>
                    <p class="mb-2"><strong>Email:</strong> info@gesidindonesia.org</p>
                    <p class="mb-2"><strong>Alamat:</strong> Jl. Contoh No. 123, Jakarta, Indonesia</p>
                    <p class="mb-0"><strong>Phone:</strong> +62 812 3456 7890</p>
                </div>
                </div>
            </div>
        </div>
    
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> 
                <strong class="px-1 sitename">Generasi Emas Indonesia</strong> 
                <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/php-email-form/validate.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/aos/aos.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>

    <!-- Main JS File -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Hero Slider
            new Swiper('.hero-slider', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                }
            });

            // Animasi pop-up untuk artikel
            let elements = document.querySelectorAll('.articles .card, .articles .list-group-item');
            elements.forEach((el, i) => {
                el.style.opacity = 0;
                el.style.transform = "translateY(30px)";
                el.style.transition = "all 0.6s ease";
                setTimeout(() => {
                    el.style.opacity = 1;
                    el.style.transform = "translateY(0)";
                }, i * 200);
            });

            // Inisialisasi AOS
            AOS.init({
                duration: 1000, // durasi animasi dalam ms
                once: true // animasi hanya jalan sekali
            });

        });
    </script>
</body>

</html>