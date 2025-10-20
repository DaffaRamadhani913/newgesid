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
    cursor: pointer;
  }

  .table thead th {
    position: relative;
    padding-right: 25px;
    user-select: none;
  }

  .sort-icons {
    position: absolute;
    right: 6px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 0.7em;
    color: #777;
  }

  .sort-icons .active {
    color: #FFD700;
    font-weight: bold;
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

<?php
$namaProv = $provinsi['nama_provinsi'] ?? session()->get('nama_provinsi') ?? '';
?>

<div class="member-container">
  <div class="mb-4 text-center">
    <h2 class="gold-text fw-bold gold-shadow">
      Data Member GESID - BPW<?= $namaProv ? ' (' . esc($namaProv) . ')' : '' ?>
    </h2>
    <p class="text-muted" style="color: #fff !important;">
      Berikut adalah daftar member yang telah terdaftar di wilayah BPW ini.
    </p>
  </div>

  <!-- 🔍 Search, Filter, & Tampilkan Data -->
  <div class="card shadow-sm border-0 bg-dark text-light rounded-4 p-3 mb-4">
    <div class="row g-3 align-items-end justify-content-between">

      <!-- Kolom: Tampilkan Jumlah Data -->
      <div class="col-lg-2 col-md-3 col-6">
        <label class="fw-semibold small text-uppercase text-warning mb-1">Tampilkan</label>
        <select id="showEntries" class="form-select form-select-sm border-warning bg-dark text-light rounded-3">
          <option value="all">Semua</option>
          <option value="10">10 Data</option>
          <option value="25">25 Data</option>
          <option value="50">50 Data</option>
          <option value="100">100 Data</option>
        </select>
      </div>

      <!-- Kolom: Input Pencarian -->
      <div class="col-lg-3 col-md-4 col-12">
        <label class="fw-semibold small text-uppercase text-warning mb-1">Cari Member</label>
        <div class="input-group input-group-sm">
          <span class="input-group-text bg-warning text-dark border-warning">
            <i class="bi bi-search"></i>
          </span>
          <input type="text" id="searchInput" class="form-control border-warning bg-dark text-light rounded-end" placeholder="Ketik nama member...">
        </div>
      </div>

      <!-- Kolom: Filter Kota -->
      <div class="col-lg-3 col-md-4 col-6">
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

      <!-- Kolom: Filter Desa -->
      <div class="col-lg-3 col-md-4 col-6">
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
            <th>No <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Nama <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Alamat <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Email <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Telepon <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Pekerjaan <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Kota <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Kecamatan <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Desa <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
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
              <td><?= esc($member['nama_kota'] ?? '-') ?></td>
              <td><?= esc($member['nama_kecamatan'] ?? '-') ?></td>
              <td><?= esc($member['nama_desa'] ?? '-') ?></td>
              <td>
                <?php if (!empty($member['foto_ktp'])): ?>
                  <a href="<?= base_url('assets/images/verifikasi/ktp/' . $member['foto_ktp']) ?>" class="zoomable">
                    <img src="<?= base_url('assets/images/verifikasi/ktp/' . $member['foto_ktp']) ?>" width="80" class="img-thumbnail">
                  </a>
                <?php else: ?>
                  <span>-</span>
                <?php endif; ?>
              </td>
              <td>
                <?php if (!empty($member['foto_wajah'])): ?>
                  <a href="<?= base_url('assets/images/verifikasi/wajah/' . $member['foto_wajah']) ?>" class="zoomable">
                    <img src="<?= base_url('assets/images/verifikasi/wajah/' . $member['foto_wajah']) ?>" width="80" class="img-thumbnail">
                  </a>
                <?php else: ?>
                  <span>-</span>
                <?php endif; ?>
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
      <i class="bi bi-info-circle me-2"></i> Belum ada data member yang terdaftar.
    </div>
  <?php endif; ?>
</div>

<!-- 🖼️ Modal Preview -->
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
  const searchInput = document.getElementById("searchInput");
  const showEntries = document.getElementById("showEntries");
  const filterKota = document.getElementById("filterKota");
  const filterDesa = document.getElementById("filterDesa");
  const memberTable = document.getElementById("memberTable");
  const tableRows = memberTable.querySelectorAll("tbody tr");

  // 🔍 Fungsi filter dan pencarian
  function filterTable() {
    const searchVal = searchInput.value.toLowerCase();
    const kotaVal = filterKota.value.toLowerCase();
    const desaVal = filterDesa.value.toLowerCase();

    tableRows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const kota = row.cells[6]?.textContent.toLowerCase() || "";
      const desa = row.cells[8]?.textContent.toLowerCase() || "";

      const matches =
        text.includes(searchVal) &&
        (!kotaVal || kota === kotaVal) &&
        (!desaVal || desa === desaVal);

      row.style.display = matches ? "" : "none";
    });

    updateVisibleRows();
  }

  // 📊 Fitur "Tampilkan N Data"
  function updateVisibleRows() {
    const val = showEntries.value;
    let visibleCount = 0;

    tableRows.forEach(row => {
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

  // 🔗 Event Listener
  [searchInput, filterKota, filterDesa].forEach(el =>
    el.addEventListener("input", filterTable)
  );

  showEntries.addEventListener("change", updateVisibleRows);

  // Jalankan pertama kali
  filterTable();
</script>


<?= $this->endSection() ?>