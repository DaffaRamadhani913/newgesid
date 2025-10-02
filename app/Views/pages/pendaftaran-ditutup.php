<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<main>
    <!-- Member Section -->
    <section id="member" class="member section">

        <!-- Section Title -->
        <div class="container text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold" style="font-size: 2.5rem;">
                Pendaftaran Ditutup
                <span class="d-block mx-auto mt-3" style="height: 4px; width: 60px; background-color: #f5b932;"></span>
            </h2>
        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="alert alert-warning p-4 shadow-sm rounded-3">
                        <p class="mb-0 fs-5">
                            Kuota 1000 member telah terpenuhi.  
                            Terima kasih atas minat Anda untuk bergabung bersama kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>

<?= $this->endSection() ?>
