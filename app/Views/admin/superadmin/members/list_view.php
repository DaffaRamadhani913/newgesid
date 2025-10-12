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

  <!-- 🔍 Search & Filter Bar -->
  <!-- 🔍 Search, Filter, & Tampilkan Data -->
  <div class="card shadow-sm border-0 bg-dark text-light rounded-4 p-3 mb-4">
    <div class="row g-3 align-items-end">

      <!-- Tampilkan Jumlah Data -->
      <div class="col-md-2 col-6">
        <label class="fw-semibold small text-uppercase text-warning mb-1">Tampilkan</label>
        <select id="showEntries" class="form-select form-select-sm border-warning bg-dark text-light rounded-3">
          <option value="all">Semua</option>
          <option value="10">10 Data</option>
          <option value="25">25 Data</option>
          <option value="50">50 Data</option>
          <option value="100">100 Data</option>
        </select>
      </div>

      <!-- Input Pencarian -->
      <div class="col-md-3 col-12">
        <label class="fw-semibold small text-uppercase text-warning mb-1">Cari</label>
        <div class="input-group input-group-sm">
          <span class="input-group-text bg-warning text-dark"><i class="bi bi-search"></i></span>
          <input type="text" id="searchInput" class="form-control border-warning bg-dark text-light rounded-end" placeholder="Cari member...">
        </div>
      </div>

      <!-- Filter Provinsi -->
      <div class="col-md-2 col-6">
        <label class="fw-semibold small text-uppercase text-warning mb-1">Provinsi</label>
        <select id="filterProvinsi" class="form-select form-select-sm border-warning bg-dark text-light rounded-3">
          <option value="">Semua Provinsi</option>
          <?php
          $provinsiList = array_unique(array_column($members, 'nama_provinsi'));
          sort($provinsiList);
          foreach ($provinsiList as $prov): ?>
            <option value="<?= esc($prov) ?>"><?= esc($prov) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Filter Kota -->
      <div class="col-md-2 col-6">
        <label class="fw-semibold small text-uppercase text-warning mb-1">Kota</label>
        <select id="filterKota" class="form-select form-select-sm border-warning bg-dark text-light rounded-3">
          <option value="">Semua Kota</option>
          <?php
          $kotaList = array_unique(array_column($members, 'nama_kota'));
          sort($kotaList);
          foreach ($kotaList as $kota): ?>
            <option value="<?= esc($kota) ?>"><?= esc($kota) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Filter Desa -->
      <div class="col-md-3 col-6">
        <label class="fw-semibold small text-uppercase text-warning mb-1">Desa</label>
        <select id="filterDesa" class="form-select form-select-sm border-warning bg-dark text-light rounded-3">
          <option value="">Semua Desa</option>
          <?php
          $desaList = array_unique(array_column($members, 'nama_desa'));
          sort($desaList);
          foreach ($desaList as $desa): ?>
            <option value="<?= esc($desa) ?>"><?= esc($desa) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

    </div>
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
          usort($members, fn($a, $b) => $b['id'] <=> $a['id']);
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
                  <img src="<?= base_url('assets/images/verifikasi/ktp/' . $member['foto_ktp']) ?>" alt="Foto KTP" width="80" class="img-thumbnail">
                </a>
              </td>
              <td>
                <a href="<?= base_url('assets/images/verifikasi/wajah/' . $member['foto_wajah']) ?>" class="zoomable">
                  <img src="<?= base_url('assets/images/verifikasi/wajah/' . $member['foto_wajah']) ?>" alt="Foto Wajah" width="80" class="img-thumbnail">
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
  // 🔍 Text search filter
  const searchInput = document.getElementById("searchInput");
  const filterProvinsi = document.getElementById("filterProvinsi");
  const filterKota = document.getElementById("filterKota");
  const filterDesa = document.getElementById("filterDesa");

  function filterTable() {
    const searchVal = searchInput.value.toLowerCase();
    const provinsiVal = filterProvinsi.value.toLowerCase();
    const kotaVal = filterKota.value.toLowerCase();
    const desaVal = filterDesa.value.toLowerCase();

    const rows = document.querySelectorAll("#memberTable tbody tr");

    rows.forEach(row => {
      const rowText = row.textContent.toLowerCase();
      const provinsi = row.cells[6].textContent.toLowerCase();
      const kota = row.cells[7].textContent.toLowerCase();
      const desa = row.cells[9].textContent.toLowerCase();

      const matchSearch = rowText.includes(searchVal);
      const matchProv = !provinsiVal || provinsi === provinsiVal;
      const matchKota = !kotaVal || kota === kotaVal;
      const matchDesa = !desaVal || desa === desaVal;

      row.style.display = (matchSearch && matchProv && matchKota && matchDesa) ? "" : "none";
    });
  }

  [searchInput, filterProvinsi, filterKota, filterDesa].forEach(el => {
    el.addEventListener("input", filterTable);
  });

  // 🖼️ Zoom image modal
  document.querySelectorAll(".zoomable img").forEach(img => {
    img.addEventListener("click", function() {
      document.getElementById("modalImage").src = this.src;
      new bootstrap.Modal(document.getElementById('imageModal')).show();
    });
  });
</script>
<script>
  // 🟡 Fitur "Tampilkan N Data"
  const showEntries = document.getElementById("showEntries");
  const memberTable = document.getElementById("memberTable");
  const tableRows = memberTable.querySelectorAll("tbody tr");

  function updateVisibleRows() {
    const val = showEntries.value;
    let visibleCount = 0;

    tableRows.forEach((row, index) => {
      const isVisible = row.style.display !== "none";
      if (isVisible) {
        if (val === "all" || visibleCount < parseInt(val)) {
          row.style.visibility = "visible";
          row.style.display = "";
          visibleCount++;
        } else {
          row.style.display = "none";
        }
      } else {
        row.style.display = "none";
      }
    });
  }

  // Integrasi dengan filter
  function filterTable() {
    const searchVal = searchInput.value.toLowerCase();
    const provVal = filterProvinsi.value.toLowerCase();
    const kotaVal = filterKota.value.toLowerCase();
    const desaVal = filterDesa.value.toLowerCase();

    tableRows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const prov = row.cells[6]?.textContent.toLowerCase() || "";
      const kota = row.cells[7]?.textContent.toLowerCase() || "";
      const desa = row.cells[9]?.textContent.toLowerCase() || "";

      const matches =
        text.includes(searchVal) &&
        (!provVal || prov === provVal) &&
        (!kotaVal || kota === kotaVal) &&
        (!desaVal || desa === desaVal);

      row.style.display = matches ? "" : "none";
    });

    updateVisibleRows();
  }

  [searchInput, filterProvinsi, filterKota, filterDesa].forEach(el =>
    el.addEventListener("input", filterTable)
  );

  showEntries.addEventListener("change", updateVisibleRows);

  // Jalankan pertama kali
  updateVisibleRows();
</script>

<?= $this->endSection() ?>