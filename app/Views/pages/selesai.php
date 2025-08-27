<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- <style>
  .form-container {
    max-width: 700px;
    margin: 60px auto;
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  }

  .form-title {
    margin-bottom: 30px;
    text-align: center;
  }

  .form-title h2 {
    color: #f59e0b;
  }
</style> -->


<div class="container-fluid section-title text-center" data-aos="fade-up" style="padding: 60px 0;">
  <h2 style="font-size: 3rem; font-weight: 800; letter-spacing: 1px;">Akun Member</h2>
  <div style="font-size: 1.5rem;">
    <span></span>Pendaftaran Berhasil
  </div>
</div>

<div class="container" data-aos="fade-up" data-aos-delay="100">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="contact-form-wrapper">
        <div class="alert alert-primary">
          Data anda sudah diterima dan sedang diverifikasi.<br>
          Akun dapat digunakan setelah diaktifkan.
    </div>
    <div class="d-flex justify-content-center mt-4 mb-5">
        <a href="<?= base_url('/') ?>" class="btn btn-warning btn-submit">Kembali ke Beranda</a>
      </div>
  </div>
</div>
</div>

<?= $this->endSection(); ?>