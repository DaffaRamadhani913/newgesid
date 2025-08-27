<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<style>
    body {
        background: #0d1b24;
        font-family: 'Segoe UI', sans-serif;
        color: #222;
        /* default teks hitam */
    }

    .login-container {
        max-width: 420px;
        margin: auto;
        padding: 40px 30px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(5px);
        transition: margin 0.3s ease;
        color: #222;
        /* teks hitam di form */
    }

    .login-container h3 {
        font-weight: 700;
        color: #222;
        /* judul hitam */
        margin-bottom: 1rem;
    }

    .btn-login {
        width: 100%;
        font-weight: 600;
        padding: 10px;
        background: #f5b932;
        border: none;
        transition: 0.3s;
        color: #222;
        /* teks tombol hitam */
    }

    .btn-login:hover {
        background: #e0a800;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .password-toggle {
        cursor: pointer;
        color: #555;
        /* abu-abu */
    }

    .form-label {
        font-weight: 500;
        color: #333;
    }

    .form-control {
        color: #222;
        /* input text hitam */
    }

    .text-muted {
        color: #555 !important;
        /* abu-abu */
    }

    a {
        color: #555;
        /* link abu-abu */
        text-decoration: none;
    }

    a:hover {
        color: #222;
        /* link hitam saat hover */
    }
</style>

<div class="login-container">
    <h3 class="text-center">Login GESID</h3>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('/admin/loginPost') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username"
                class="form-control <?= (session('errors.username') ? 'is-invalid' : '') ?>"
                placeholder="Masukkan username" required autocomplete="username">
            <?php if (session('errors.username')): ?>
                <div class="invalid-feedback"><?= session('errors.username') ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password"
                    class="form-control <?= (session('errors.password') ? 'is-invalid' : '') ?>"
                    placeholder="Masukkan password" required autocomplete="current-password">
                <button class="btn btn-outline-secondary password-toggle" type="button" id="togglePassword">
                    <i class="bi bi-eye"></i>
                </button>
                <?php if (session('errors.password')): ?>
                    <div class="invalid-feedback"><?= session('errors.password') ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>

        <button type="submit" class="btn btn-login">Login</button>
    </form>

    <p class="text-center mt-3">
        <a href="<?= base_url('/forgot-password') ?>">Lupa password?</a>
    </p>

    <!-- <p class="text-muted mt-3 small text-center">
        Username & password sesuai role GESID <br> contoh: <code>super</code> / <code>super</code>
    </p> -->
</div>

<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const icon = this.querySelector('i');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });

    // Auto adjust login form position
    function adjustLoginMargin() {
        const navbar = document.querySelector("nav");
        const loginContainer = document.querySelector(".login-container");

        if (navbar && loginContainer) {
            const navbarHeight = navbar.offsetHeight;
            loginContainer.style.marginTop = (navbarHeight + 100) + "px"; // jarak 100px dari navbar
            loginContainer.style.marginBottom = "100px"; // jarak 100px ke footer
        }
    }

    document.addEventListener("DOMContentLoaded", adjustLoginMargin);
    window.addEventListener("resize", adjustLoginMargin);
</script>

<?= $this->endSection(); ?>