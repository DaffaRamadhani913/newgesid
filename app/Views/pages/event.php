<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section id="events" class="services section">

    <!-- Section Title -->
    <div class="container text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold fs-1">
            Event GESID
        </h2>
        <div style="height:3px; width:60px; background-color:#f5b932; margin:12px auto 0;"></div>
    </div>
    <!-- End Section Title -->

    <div class="container">
        <div class="row justify-content-center">

            <?php
            use App\Models\AcaraModel;

            $acaraModel = new AcaraModel();
            $events = $acaraModel->where('status', 'approved')->orderBy('created_at', 'DESC')->findAll();

            foreach ($events as $i => $e):
                $delay = $i * 100;
            ?>
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                    <div style="background: #0d1b24; border-radius: 12px; overflow: hidden; 
                                border: 2px solid #ddd; 
                                box-shadow: 0 4px 12px rgba(0,0,0,0.08); 
                                display: flex; flex-direction: column; height: 100%;">

                        <!-- Poster -->
                        <img src="<?= base_url('uploads/events/' . $e['gambar']) ?>"
                            alt="<?= $e['judul'] ?>"
                            style="width: 100%; aspect-ratio: 3/4; object-fit: cover;">

                        <!-- Caption -->
                        <div style="padding: 20px; text-align: center; flex-grow: 1;">
                            <h5 style="font-weight: 700; font-size: 1.3rem; margin-bottom: 10px; color: white;"><?= $e['judul'] ?></h5>
                            <p style="font-size: 1rem; color: #ddd; line-height: 1.5;"><?= $e['deskripsi'] ?></p>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

</section>

<?= $this->endSection() ?>
