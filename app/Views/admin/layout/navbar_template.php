<?php
$role = session()->get('role');
$subRole = session()->get('sub_role') ?? null;

$menuConfig = include(APPPATH . 'Config/menu_config.php');
$menuItems = [];

if ($role === 'bpn') {
  // Default menu for BPN
  $menuItems = $menuConfig['bpn']['default'] ?? [];

  // Merge sub-role menu if exists
  if ($subRole && isset($menuConfig['bpn'][$subRole])) {
    $menuItems = array_merge($menuItems, $menuConfig['bpn'][$subRole]);
  }
} else {
  $menuItems = $menuConfig[$role] ?? [];
}

// 🏷️ Pretty name for BPN sub roles
$subRoleLabels = [
  'okk' => 'OKK BPN',
  'humas' => 'HUMAS BPN',
  'sekretariat' => 'SEKRETARIAT BPN'
];
?>

<!-- Sidebar -->
<div id="adminSidebar" class="gesid-sidebar d-flex flex-column flex-shrink-0 p-3 bg-dark text-white">
  <a href="<?= base_url() ?>" class="d-flex align-items-center mb-3 mb-md-0 text-white text-decoration-none brand-link">
    <img src="<?= base_url('assets/img/logo_GESID.png') ?>" alt="Logo" width="32" height="32" class="me-2">
    <span class="fs-6 fw-bold">
      GESID |
      <?php if ($role === 'bpw'): ?>
        <?= esc(session()->get('nama_provinsi') ?? 'BPW') ?>
      <?php elseif ($role === 'bpd'): ?>
        <?= esc(session()->get('nama_kota') ?? 'BPD') ?>
      <?php elseif ($role === 'bpdes'): ?>
        <?= esc(session()->get('nama_desa') ?? 'BPDes') ?>
      <?php elseif ($role === 'bpn' && $subRole): ?>
        <?= esc($subRoleLabels[$subRole] ?? 'BPN') ?>
      <?php else: ?>
        <?= strtoupper($role) ?>
      <?php endif; ?>
    </span>
  </a>

  <hr class="sidebar-divider">
  <ul class="nav nav-pills flex-column mb-auto">
    <?php foreach ($menuItems as $item): ?>
      <?php if (isset($item['submenu'])): ?>
        <li class="nav-item">
          <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#menu-<?= md5($item['label']) ?>"
            role="button" aria-expanded="false">
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