<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<style>
  .gold-text {
    color: #FFD700 !important;
  }

  .gold-border {
    border: 2px solid #555 !important;
  }

  .gold-shadow {
    text-shadow: 0 0 6px rgba(255, 215, 0, 0.7);
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

  .member-container {
    background-color: #1c1c1c;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #555;
  }

  .table-responsive {
    margin-top: 20px;
  }

  .text-truncate-50 {
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  /* Modal zoom */
  .modal-img {
    max-width: 90%;
    max-height: 80vh;
    display: block;
    margin: auto;
    border-radius: 10px;
  }
</style>

<div class="member-container">
  <div class="mb-4 text-center">
    <h2 class="gold-text fw-bold gold-shadow">Data Member GESID</h2>
    <p class="text-muted" style="color: #fff !important;">
      Berikut adalah daftar member yang telah terdaftar dalam sistem GESID.
    </p>
  </div>

  <!-- Search Bar -->
  <div class="mb-3">
    <input type="text" id="searchInput" class="form-control gold-border" placeholder="Cari member...">
  </div>

  <?php if (!empty($members) && is_array($members)): ?>
    <div class="table-responsive">
      <table id="memberTable" class="table table-hover align-middle text-center gold-border rounded-3">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th class="text-truncate-50">Alamat</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Pekerjaan</th>
            <th>Provinsi</th>
            <th>Kota</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>Foto KTP</th>
            <th>Foto Wajah</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          // Urutkan dari terbaru -> terlama (asumsinya pakai id desc)
          usort($members, function ($a, $b) {
            return $b['id'] <=> $a['id'];
          });

          foreach ($members as $member): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td class="text-start"><?= esc($member['nama']) ?></td>
              <td class="text-start text-truncate-50"><?= esc($member['alamat']) ?></td>
              <td><?= esc($member['email']) ?></td>
              <td><?= esc($member['telepon']) ?></td>
              <td><?= esc($member['pekerjaan']) ?></td>
              <td><?= esc($member['nama_provinsi']) ?></td>
              <td><?= esc($member['nama_kota']) ?></td>
              <td><?= esc($member['nama_kecamatan']) ?></td>
              <td><?= esc($member['nama_desa']) ?></td>
              <td>
                <a href="<?= base_url('assets/images/verifikasi/ktp/' . $member['foto_ktp']) ?>" class="zoomable">
                  <img src="<?= base_url('assets/images/verifikasi/ktp/' . $member['foto_ktp']) ?>" alt="Foto KTP"
                    width="80" class="img-thumbnail">
                </a>
              </td>
              <td>
                <a href="<?= base_url('assets/images/verifikasi/wajah/' . $member['foto_wajah']) ?>" class="zoomable">
                  <img src="<?= base_url('assets/images/verifikasi/wajah/' . $member['foto_wajah']) ?>" alt="Foto Wajah"
                    width="80" class="img-thumbnail">
                </a>
              </td>
              <td>
                <?php if ($member['status'] === 'Aktif'): ?>
                  <span class="badge bg-success">Aktif</span>
                <?php else: ?>
                  <span class="badge bg-secondary">Nonaktif</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center gold-border">
      <i class="bi bi-info-circle me-2"></i>Belum ada data member yang terdaftar.
    </div>
  <?php endif; ?>
</div>

<!-- Modal untuk zoom gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-body text-center">
        <img id="modalImage" src="" alt="Preview" class="modal-img">
      </div>
    </div>
  </div>
</div>

<script>
  // Search filter
  document.getElementById("searchInput").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#memberTable tbody tr");
    rows.forEach(row => {
      let text = row.textContent.toLowerCase();
      row.style.display = text.includes(filter) ? "" : "none";
    });
  });

  // Zoom image modal
  function showImage(img) {
    document.getElementById("modalImage").src = img.src;
    new bootstrap.Modal(document.getElementById('imageModal')).show();
  }
</script>

<?= $this->endSection() ?>