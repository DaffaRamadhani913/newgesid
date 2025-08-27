<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?= esc($title ?? 'GESID - Admin Dashboard') ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicon -->
  <link rel="icon" href="<?= base_url('assets/img/favicon.png') ?>">

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

  <!-- Admin tambahan -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/libs/simplebar/dist/simplebar.css') ?>">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/7.2.96/css/materialdesignicons.min.css">
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
  <style>
      .note-editable{background-color: white};
  </style>
</head>

<body class="gesid-admin-body">

  <div class="d-flex admin-layout">
    <!-- Sidebar -->
    <?= $this->include('admin/' . session()->get('role') . '/navbar_' . session()->get('role')) ?>

    <!-- Main Content -->
    <div class="gesid-content d-flex flex-column min-vh-100">
      <main class="gesid-main flex-grow-1">
        <?= $this->renderSection('content') ?>
      </main>

      <!-- Footer -->
      <?= $this->include('admin/layout/footer') ?>
    </div>
  </div>

  <!-- Vendor JS -->
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/aos/aos.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>

  <!-- Admin JS -->
  <script src="<?= base_url('assets/admin/libs/jquery/dist/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/libs/simplebar/dist/simplebar.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/js/sidebarmenu.js') ?>"></script>
  <script src="<?= base_url('assets/admin/js/app.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/js/dashboard.js') ?>"></script>

  <!-- Summernote -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

  <script>
    $(function() {
      $('#konten').summernote({
        placeholder: 'Tulis artikel di sini...',
        tabsize: 2,
        height: 300
      });
    });
    AOS.init();
  </script>
</body>

</html>