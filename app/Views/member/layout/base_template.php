<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>GESID - Member Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/Logo GESID-01.jpg') ?>">

    <!-- Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/styles.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/libs/simplebar/dist/simplebar.css') ?>">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>

    <!-- Wrapper -->
    <div class="d-flex min-vh-100">

        <!-- Sidebar Start -->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark vh-100" style="width: 250px;">
            <a href="<?= base_url('member/dashboard') ?>"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <img src="<?= base_url('assets/images/Logo GESID-01.jpg') ?>" alt="Logo GESID" width="32" height="32"
                    class="me-2 rounded">
                <span class="fs-5 fw-bold">GESID | MEMBER</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="<?= base_url('member/dashboard') ?>"
                        class="nav-link text-white <?= url_is('member/dashboard') ? 'active' : '' ?>">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('member/profil') ?>"
                        class="nav-link text-white <?= url_is('member/profil') ? 'active' : '' ?>">
                        Profil
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('member/aduan') ?>"
                        class="nav-link text-white <?= url_is('member/aduan') ? 'active' : '' ?>">
                        Aduan
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('member/respons') ?>"
                        class="nav-link text-white <?= url_is('member/respons') ? 'active' : '' ?>">
                        Respons
                    </a>
                </li>
            </ul>
            <hr>
            <div class="mt-auto">
                <a href="<?= base_url('logout') ?>" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </div>
        </div>
        <!-- Sidebar End -->

        <!-- Page Content -->
        <div class="flex-grow-1 p-4">
            <?= $this->renderSection('content') ?>

            <!-- Footer -->
            <footer class="bg-dark text-white text-center py-3 mt-auto">
                <div class="container">
                    &copy; <?= date('Y') ?> GESID. All rights reserved.
                </div>
            </footer>
        </div>

    </div>

    <!-- JavaScript -->
    <script src="<?= base_url('assets/admin/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/simplebar/dist/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/sidebarmenu.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/app.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/dashboard.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

</body>

</html>