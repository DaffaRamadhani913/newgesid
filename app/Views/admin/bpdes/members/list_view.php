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
    <p class="text-muted" style="color: #fff !important;">Berikut adalah daftar member yang terdaftar di wilayah desa
      Anda.</p>
  </div>
  <!-- 🔍 Search & Filter Bar -->
  <!-- 🔍 Search, Filter, & Tampilkan Data -->
  <div class="card shadow-sm border-0 bg-dark text-light rounded-4 p-3 mb-4">
    <div class="row g-3 align-items-end justify-content-center text-center">

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
          <input type="text" id="searchInput" class="form-control border-warning bg-dark text-light rounded-end"
            placeholder="Cari member...">
        </div>
      </div>







    </div>
  </div>

  <?php if (!empty($members) && is_array($members)): ?>
    <div class="table-responsive">
      <table id="memberTable" class="table table-hover align-middle gold-border rounded-3 text-center">
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
  <?php else: ?>
    <div class="alert alert-warning text-center gold-border">
      Belum ada data member yang terdaftar di desa Anda.
    </div>
  <?php endif; ?>
</div>

<script>
  // 🔎 Combined search & filter
  const searchInput = document.getElementById("searchInput");
  const filterProvinsi = document.getElementById("filterProvinsi");
  const filterKota = document.getElementById("filterKota");
  const filterDesa = document.getElementById("filterDesa");

  function filterTable() {
    const searchVal = searchInput.value.toLowerCase();
    const provVal = filterProvinsi.value.toLowerCase();
    const kotaVal = filterKota.value.toLowerCase();
    const desaVal = filterDesa.value.toLowerCase();

    const rows = document.querySelectorAll("#memberTable tbody tr");

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const prov = row.cells[6].textContent.toLowerCase();
      const kota = row.cells[7].textContent.toLowerCase();
      const desa = row.cells[9].textContent.toLowerCase();

      const matches = text.includes(searchVal) &&
        (!provVal || prov === provVal) &&
        (!kotaVal || kota === kotaVal) &&
        (!desaVal || desa === desaVal);

      row.style.display = matches ? "" : "none";
    });
  }

  [searchInput, filterProvinsi, filterKota, filterDesa].forEach(el => el.addEventListener("input", filterTable));

  // 🖼 Zoom image modal
  document.querySelectorAll(".zoomable img").forEach(img => {
    img.addEventListener("click", function (e) {
      e.preventDefault();
      document.getElementById("modalImage").src = this.src;
      new bootstrap.Modal(document.getElementById('imageModal')).show();
    });
  });

  // Zoom image modal
  document.querySelectorAll(".img-thumbnail").forEach(img => {
    img.addEventListener("click", function (e) {
      e.preventDefault();
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