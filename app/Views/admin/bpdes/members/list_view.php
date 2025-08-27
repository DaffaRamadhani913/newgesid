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

  /* Card-like container */
  .member-container {
    background: #1e1e1e;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.2);
  }

  .table {
    color: #fff;
  }

  .table td,
  .table th {
    vertical-align: middle;
  }

  .alert-warning {
    background-color: rgba(255, 215, 0, 0.1);
    border: 1px solid #555;
    color: #FFD700;
  }
</style>

<?php
$namaDesa = $desa['nama_desa'] ?? session()->get('nama_desa') ?? '';
?>

<div class="member-container">
  <div class="mb-4 text-center">
    <h2 class="gold-text gold-shadow fw-bold">
      Data Member GESID - BPDes<?= $namaDesa ? ' (' . esc($namaDesa) . ')' : '' ?>
    </h2>
    <p class="text-muted" style="color: #fff !important;">Berikut adalah daftar member yang terdaftar di wilayah desa Anda.</p>
  </div>

  <?php if (!empty($members) && is_array($members)) : ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle gold-border rounded-3 text-center">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Desa</th>
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
              <td><?= esc($member['nama_desa']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else : ?>
    <div class="alert alert-warning text-center gold-border">
      Belum ada data member yang terdaftar di desa Anda.
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>