<?php
$menuConfig = include(APPPATH . 'Config/menu_config.php');
$menuItems = $menuConfig[$role] ?? [];
?>

<!-- Sidebar -->
<div id="adminSidebar" class="gesid-sidebar d-flex flex-column flex-shrink-0 p-3 bg-dark text-white">
  <a href="<?= base_url() ?>" class="d-flex align-items-center mb-3 mb-md-0 text-white text-decoration-none brand-link">
    <img src="<?= base_url('assets/img/logo_GESID.png') ?>" alt="Logo" width="32" height="32" class="me-2">
    <span class="fs-6 fw-bold">GESID | <?= strtoupper($role) ?></span>
  </a>
  <hr class="sidebar-divider">
  <ul class="nav nav-pills flex-column mb-auto">
    <?php foreach ($menuItems as $item): ?>
      <?php if (isset($item['submenu'])): ?>
        <li class="nav-item">
          <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#menu-<?= md5($item['label']) ?>" role="button" aria-expanded="false">
            <i class="mdi <?= esc($item['icon'] ?? '') ?> me-2"></i> <?= $item['label'] ?>
          </a>
          <div class="collapse" id="menu-<?= md5($item['label']) ?>">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <?php foreach ($item['submenu'] as $sub): ?>
                <li>
                  <a href="<?= base_url($sub['url']) ?>" class="nav-link text-white ms-4">
                    <i class="mdi <?= esc($sub['icon'] ?? '') ?> me-2"></i> <?= esc($sub['label']) ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </li>
      <?php else: ?>
        <li>
          <a href="<?= base_url($item['url']) ?>" class="nav-link text-white">
            <i class="mdi <?= esc($item['icon']) ?> me-2"></i> <?= esc($item['label']) ?>
          </a>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
  <hr class="sidebar-divider">
  <div>
    <a href="<?= base_url('logout') ?>" class="btn btn-outline-light w-100">
      <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>
  </div>
</div>