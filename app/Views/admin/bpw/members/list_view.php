<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<style>
  /* Warna emas */
  .gold-text {
    color: #FFD700 !important;
  }

  .gold-border {
    border: 2px solid #555 !important;
  }

  .gold-shadow {
    text-shadow: 0 0 6px rgba(255, 215, 0, 0.7);
  }

  /* Tabel */
  .table thead {
    background: #2a2a2a;
    color: #FFD700 !important;
    border-bottom: 2px solid #555;
  }

  .table tbody tr {
    border-bottom: 1px solid #444;
    transition: all 0.3s ease;
  }

  .table tbody tr:hover {
    background-color: rgba(255, 215, 0, 0.08);
    border-left: 3px solid #FFD700;
  }

  /* Card wrapper */
  .card.gold-border {
    border: 1px solid #555;
  }

  /* Alert */
  .alert.gold-border {
    border: 1px solid #555;
  }
</style>

<?php
// Prefer the value passed from controller; fall back to session if missing
$namaProv = $provinsi['nama_provinsi'] ?? session()->get('nama_provinsi') ?? '';
?>

<div class="member-container container-fluid mt-4">
  <div class="mb-4 text-center">
    <h2 class="fw-bold gold-text gold-shadow">
      Data Member GESID - BPW<?= $namaProv ? ' (' . esc($namaProv) . ')' : '' ?>
    </h2>
    <p class="text-muted" style="color: #fff !important;">Berikut adalah daftar member yang telah terdaftar di wilayah BPW.</p>
  </div>

  <?php if (!empty($members) && is_array($members)): ?>
    <div class="card shadow mb-4 gold-border">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle text-center gold-border rounded-3">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Pekerjaan</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($members as $member): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td class="text-start"><?= esc($member['nama']) ?></td>
                  <td class="text-start"><?= esc($member['alamat']) ?></td>
                  <td><?= esc($member['email']) ?></td>
                  <td><?= esc($member['telepon']) ?></td>
                  <td><?= esc($member['pekerjaan']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center gold-border">
      <i class="bi bi-info-circle me-2"></i> Belum ada data member yang terdaftar.
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>