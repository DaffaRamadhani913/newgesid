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

  .password-wrapper {
    position: relative;
  }

  .toggle-password {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 1.1rem;
    color: #999;
  }
</style> -->

<div class="container-fluid section-title text-center" data-aos="fade-up" style="padding: 60px 0;">
  <h2 style="font-size: 3rem; font-weight: 800; letter-spacing: 1px;">Akun Member</h2>
  <div style="font-size: 1.5rem;">
    <span></span>Buat akun agar dapat login ke sistem
  </div>
</div>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="container" data-aos="fade-up" data-aos-delay="100">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="contact-form-wrapper">
        <form action="<?= base_url('formulir/submit') ?>" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Masukkan Username</label>
            <input type="text" class="form-control" name="username" required>
          </div>

          <div class="mb-3 password-wrapper">
            <label for="password" class="form-label">Masukkan Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
            <span toggle="#password" class="toggle-password" onclick="togglePassword('password', this)">👁️</span>
          </div>

          <div class="mb-3 password-wrapper">
            <label for="password_confirm" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
            <span toggle="#password_confirm" class="toggle-password"
              onclick="togglePassword('password_confirm', this)">👁️</span>
          </div>
          <div class="d-flex justify-content-center mt-4 mb-5">
            <button type="submit" class="btn btn-warning btn-submit">Kirim Pendaftaran</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function togglePassword(id, el) {
    const input = document.getElementById(id);
    const isVisible = input.type === "text";
    input.type = isVisible ? "password" : "text";
    el.textContent = isVisible ? "👁️" : "🙈";
  }
</script>

<?= $this->endSection(); ?>