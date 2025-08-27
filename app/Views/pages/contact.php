<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- Contact Section -->
<section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold fs-1">
            Kontak
        </h2>
        <div style="height:3px; width:60px; background-color:#f5b932; margin:12px auto 0;"></div>
    </div>
    <!-- End Section Title -->

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
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200" style="display:flex; align-items:stretch;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7876274.074299177!2d95.37727564121098!3d-2.548926043842915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1b3fba2c4c9ff5%3A0x301576d14feb720!2sIndonesia!5e0!3m2!1sid!2sid!4v1692443696571!5m2!1sid!2sid"
                    width="100%"
                    height="400"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>

            </div>
        </div>
    </div>

</section><!-- /Contact Section -->
<?= $this->endSection() ?>