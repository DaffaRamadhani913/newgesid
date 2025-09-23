<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title><?= esc($title ?? 'GESID - Member Dashboard') ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicon -->
  <link rel="icon" href="<?= base_url('assets/img/logo_GESID.png') ?>">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Raleway:wght@400;700&family=Nunito+Sans:wght@400;700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/aos/aos.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">

  <!-- Main CSS -->
  <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">

  <!-- Member tambahan -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/libs/simplebar/dist/simplebar.css') ?>">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/7.2.96/css/materialdesignicons.min.css">
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body class="gesid-member-body">

  <div class="d-flex member-layout">
    <!-- Sidebar -->
    <?= $this->include('member/layout/navbar_template') ?>

    <!-- Main Content -->
    <div class="gesid-content d-flex flex-column min-vh-100">
      <main class="gesid-main flex-grow-1">
        <?= $this->renderSection('content') ?>
      </main>

      <!-- Footer -->
      <?= $this->include('member/layout/footer') ?>
    </div>
  </div>

  <!-- Vendor JS -->
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/aos/aos.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>

  <!-- Member JS -->
  <script src="<?= base_url('assets/admin/libs/jquery/dist/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/libs/simplebar/dist/simplebar.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/js/sidebarmenu.js') ?>"></script>
  <script src="<?= base_url('assets/admin/js/app.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/js/dashboard.js') ?>"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>
