<?= $this->extend('Views/admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<style>
  /* Warna dan tema emas */
  .gold-text {
    color: #FFD700 !important;
    text-shadow: 0 0 6px rgba(255, 215, 0, 0.7);
  }

  .gold-border {
    border: 2px solid #555 !important;
  }

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

  .badge-gold {
    background: linear-gradient(90deg, #FFD700, #DAA520);
    color: #000;
    font-weight: 600;
  }

  /* Badge email abu-abu */
  .badge-email {
    background-color: #6c757d;
    /* abu-abu */
    color: #fff;
    font-weight: 600;
  }

  .card.gold-border {
    border: 1px solid #555;
  }

  .alert-warning.gold-border {
    border: 1px solid #555;
    background-color: rgba(255, 215, 0, 0.1);
    color: #FFD700;
  }
</style>

<div class="container my-5">
  <!-- Judul -->
  <div class="text-center mb-5">
    <h2 class="fw-bold gold-text mb-2">📋 Data Member GESID</h2>
    <p class="text-white-50">Berikut adalah daftar member yang telah terdaftar dalam sistem GESID.</p>
  </div>

  <?php if (!empty($members) && is_array($members)) : ?>
    <div class="card shadow-lg rounded-3 border-0 gold-border">
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table align-middle table-hover text-white mb-0 gold-border rounded-3">
            <thead class="text-center">
              <tr>
                <th style="width:60px;">No</th>
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
                  <td class="text-center fw-semibold"><?= $no++ ?></td>
                  <td><?= esc($member['nama']) ?></td>
                  <td><?= esc($member['alamat']) ?></td>
                  <td><span class="badge badge-email"><?= esc($member['email']) ?></span></td>
                  <td><?= esc($member['telepon']) ?></td>
                  <td><?= esc($member['pekerjaan']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php else : ?>
    <div class="alert alert-warning text-center shadow-sm rounded-3 py-4 gold-border">
      <i class="bi bi-exclamation-circle-fill me-2"></i>
      Belum ada data member yang terdaftar.
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>