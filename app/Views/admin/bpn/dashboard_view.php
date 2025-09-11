<?= $this->extend('Views/admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<?php
// Ambil role dari session langsung di view
$session = session();
$role = $session->get('role');

// Ambil menu dari config
$menuConfig = include(APPPATH . 'Config/menu_config.php');
$subRole = $session->get('sub_role') ?? null;

$menuItems = [];

if ($role === 'bpn') {
  // Start with default BPN menu
  $menuItems = $menuConfig['bpn']['default'] ?? [];

  // Add sub-role specific menus
  if ($subRole && isset($menuConfig['bpn'][$subRole])) {
    $menuItems = array_merge($menuItems, $menuConfig['bpn'][$subRole]);
  }
} else {
  // Other roles
  $menuItems = $menuConfig[$role] ?? [];
}

?>

<style>
  /* Styling khusus tema abu-abu + emas */
  .gold-card {
    background: linear-gradient(145deg, #1c1c1c, #2a2a2a);
    border: 2px solid #555;
    border-radius: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
  }

  .gold-card:hover {
    transform: translateY(-5px);
    border-color: #FFD700;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.4);
  }

  .gold-icon {
    color: #FFD700;
    font-size: 3rem;
    margin-bottom: 10px;
    transition: transform 0.3s ease, color 0.3s ease;
  }

  .gold-card:hover .gold-icon {
    transform: scale(1.2) rotate(5deg);
    color: #FFC300;
  }

  .gold-title {
    color: #FFD700;
    font-weight: bold;
  }
</style>

<div class="container my-5">

  <!-- Judul Dashboard -->
  <div class="text-center mb-5">
    <h2 class="fw-bold" style="color:#FFD700;">📊 Dashboard GESID</h2>
    <p class="text-white-50">Selamat datang di sistem GESID, silakan pilih menu yang tersedia.</p>
  </div>

  <!-- Shortcut Menu -->
  <div class="row mb-5">
    <?php foreach ($menuItems as $item): ?>
      <?php if (isset($item['submenu'])): ?>
        <?php foreach ($item['submenu'] as $sub): ?>
          <div class="col-md-3 col-sm-6 mb-4">
            <a href="<?= base_url($sub['url']) ?>" class="text-decoration-none">
              <div class="card gold-card h-100 d-flex align-items-center justify-content-center text-center p-4">
                <i class="mdi <?= esc($sub['icon'] ?? 'mdi-circle') ?> gold-icon"></i>
                <h6 class="gold-title"><?= esc($sub['label']) ?></h6>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-md-3 col-sm-6 mb-4">
          <a href="<?= base_url($item['url']) ?>" class="text-decoration-none">
            <div class="card gold-card h-100 d-flex align-items-center justify-content-center text-center p-4">
              <i class="mdi <?= esc($item['icon'] ?? 'mdi-circle') ?> gold-icon"></i>
              <h6 class="gold-title"><?= esc($item['label']) ?></h6>
            </div>
          </a>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
  <!-- Statistik Section -->
  <div class="row mt-5">
    <?php if (isset($jumlahMember)): ?>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card gold-card h-100 d-flex align-items-center justify-content-center text-center p-4">
          <i class="mdi mdi-account-group gold-icon"></i>
          <h6 class="gold-title">Jumlah Member</h6>
          <p class="text-white fs-4 fw-bold"><?= esc($jumlahMember) ?></p>
        </div>
      </div>
    <?php endif; ?>

    <?php if (isset($jumlahAdmin)): ?>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card gold-card h-100 d-flex align-items-center justify-content-center text-center p-4">
          <i class="mdi mdi-shield-account gold-icon"></i>
          <h6 class="gold-title">Jumlah Admin</h6>
          <p class="text-white fs-4 fw-bold"><?= esc($jumlahAdmin) ?></p>
        </div>
      </div>
    <?php endif; ?>

    <?php if (isset($jumlahArtikel)): ?>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card gold-card h-100 d-flex align-items-center justify-content-center text-center p-4">
          <i class="mdi mdi-file-document gold-icon"></i>
          <h6 class="gold-title">Jumlah Artikel</h6>
          <p class="text-white fs-4 fw-bold"><?= esc($jumlahArtikel) ?></p>
        </div>
      </div>
    <?php endif; ?>

    <?php if (isset($jumlahAcara)): ?>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card gold-card h-100 d-flex align-items-center justify-content-center text-center p-4">
          <i class="mdi mdi-calendar gold-icon"></i>
          <h6 class="gold-title">Jumlah Acara</h6>
          <p class="text-white fs-4 fw-bold"><?= esc($jumlahAcara) ?></p>
        </div>
      </div>
    <?php endif; ?>

    <?php if (isset($jumlahBroadcast)): ?>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card gold-card h-100 d-flex align-items-center justify-content-center text-center p-4">
          <i class="mdi mdi-email-send gold-icon"></i>
          <h6 class="gold-title">Jumlah Broadcast Email</h6>
          <p class="text-white fs-4 fw-bold"><?= esc($jumlahBroadcast) ?></p>
        </div>
      </div>
    <?php endif; ?>
  </div>


</div>

<?= $this->endSection() ?>