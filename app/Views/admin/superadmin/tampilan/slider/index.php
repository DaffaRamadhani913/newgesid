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
    text-align: center;
  }

  .table tbody tr {
    border-bottom: 1px solid #444;
    transition: all 0.3s ease;
  }

  .table tbody tr:hover {
    background-color: rgba(255, 215, 0, 0.08);
    border-left: 3px solid #FFD700;
  }

  /* Button */
  .btn-gold {
    background: linear-gradient(90deg, #FFD700, #DAA520);
    border: none;
    color: #000;
    font-weight: 600;
  }

  .btn-gold:hover {
    background: linear-gradient(90deg, #DAA520, #FFD700);
    color: #000;
  }

  /* Card */
  .card.gold-border {
    border: 1px solid #555;
  }

  /* Badge */
  .badge-status {
    font-weight: 600;
  }
</style>

<div class="container mt-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold gold-text gold-shadow mb-0">🖼️ Data Slider</h4>
    <a href="<?= base_url('admin/slider/create') ?>" class="btn btn-gold">
      <i class="bi bi-plus-circle me-1"></i> Tambah Slider
    </a>
  </div>

  <!-- Card Tabel -->
  <div class="card shadow-lg border-0 gold-border rounded-3">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table align-middle table-hover mb-0 text-white gold-border rounded-3">
          <thead>
            <tr>
              <th style="width:60px;">No</th>
              <th style="width:120px;">Gambar</th>
              <th>Judul</th>
              <th>Subjudul</th>
              <th>Status</th>
              <th style="width:150px;">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sliders as $index => $slider): ?>
              <tr>
                <td class="text-center fw-semibold"><?= $index + 1 ?></td>
                <td class="text-center">
                  <img src="<?= base_url('assets/images/slider/' . $slider['image_filename']) ?>"
                    class="img-fluid rounded shadow-sm gold-border"
                    style="max-width:100px;" alt="Slider">
                </td>
                <td><?= esc($slider['title']) ?></td>
                <td class="text-muted"><?= esc($slider['subtitle']) ?></td>
                <td class="text-center">
                  <?= $slider['is_active']
                    ? '<span class="badge bg-success badge-status px-3 py-2">Aktif</span>'
                    : '<span class="badge bg-secondary badge-status px-3 py-2">Nonaktif</span>' ?>
                </td>
                <td class="text-center">
                  <div class="d-flex justify-content-center gap-2">
                    <a href="<?= base_url('admin/slider/edit/' . $slider['id']) ?>"
                      class="btn btn-warning btn-sm w-100 d-flex flex-column align-items-center py-2">
                      <i class="bi bi-pencil-square fs-5 mb-1"></i>
                      <small>Edit</small>
                    </a>
                    <a href="<?= base_url('admin/slider/delete/' . $slider['id']) ?>"
                      class="btn btn-danger btn-sm w-100 d-flex flex-column align-items-center py-2"
                      onclick="return confirm('Hapus slider ini?')">
                      <i class="bi bi-trash fs-5 mb-1"></i>
                      <small>Hapus</small>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>