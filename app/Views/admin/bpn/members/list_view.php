<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<style>
  .gold-text { color: #FFD700 !important; }
  .gold-border { border: 2px solid #555 !important; }
  .gold-shadow { text-shadow: 0 0 6px rgba(255, 215, 0, 0.7); }

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
    vertical-align: middle;
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
    line-height: 0.9em;
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

  .table-responsive { margin-top: 20px; }
  .text-truncate-50 { max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

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
  <div class="row g-2 mb-3">
    <div class="col-md-3">
      <input type="text" id="searchInput" class="form-control gold-border" placeholder="Cari member...">
    </div>
    <div class="col-md-3">
      <select id="filterProvinsi" class="form-select gold-border">
        <option value="">-- Filter Provinsi --</option>
        <?php 
          $provinsiList = array_unique(array_column($members, 'nama_provinsi'));
          sort($provinsiList);
          foreach ($provinsiList as $prov): ?>
            <option value="<?= esc($prov) ?>"><?= esc($prov) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <select id="filterKota" class="form-select gold-border">
        <option value="">-- Filter Kota --</option>
        <?php 
          $kotaList = array_unique(array_column($members, 'nama_kota'));
          sort($kotaList);
          foreach ($kotaList as $kota): ?>
            <option value="<?= esc($kota) ?>"><?= esc($kota) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <select id="filterDesa" class="form-select gold-border">
        <option value="">-- Filter Desa --</option>
        <?php 
          $desaList = array_unique(array_column($members, 'nama_desa'));
          sort($desaList);
          foreach ($desaList as $desa): ?>
            <option value="<?= esc($desa) ?>"><?= esc($desa) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <?php if (!empty($members) && is_array($members)): ?>
    <div class="table-responsive">
      <table id="memberTable" class="table table-hover align-middle text-center gold-border rounded-3">
        <thead>
          <tr>
            <th>No <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Nama <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th class="text-truncate-50">Alamat <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Email <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Telepon <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Pekerjaan <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Provinsi <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Kota <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Kecamatan <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Desa <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
            <th>Foto KTP</th>
            <th>Foto Wajah</th>
            <th>Status <span class="sort-icons"><span class="up">▲</span><span class="down">▼</span></span></th>
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

      const matches = text.includes(searchVal)
        && (!provVal || prov === provVal)
        && (!kotaVal || kota === kotaVal)
        && (!desaVal || desa === desaVal);

      row.style.display = matches ? "" : "none";
    });
  }

  [searchInput, filterProvinsi, filterKota, filterDesa].forEach(el => el.addEventListener("input", filterTable));

  // 🖼️ Zoom image modal
  document.querySelectorAll(".zoomable img").forEach(img => {
    img.addEventListener("click", function (e) {
      e.preventDefault();
      document.getElementById("modalImage").src = this.src;
      new bootstrap.Modal(document.getElementById('imageModal')).show();
    });
  });

  // 🔽 Sort table
  document.querySelectorAll("#memberTable thead th").forEach((th, index) => {
    th.addEventListener("click", () => {
      if (!th.querySelector(".sort-icons")) return;
      let table = th.closest("table");
      let tbody = table.querySelector("tbody");
      let rows = Array.from(tbody.querySelectorAll("tr"));
      let up = th.querySelector(".up");
      let down = th.querySelector(".down");
      let isAsc = up.classList.contains("active");

      table.querySelectorAll(".sort-icons .up, .sort-icons .down").forEach(el => el.classList.remove("active"));

      rows.sort((a, b) => {
        let aText = a.cells[index].innerText.trim().toLowerCase();
        let bText = b.cells[index].innerText.trim().toLowerCase();
        if (!isNaN(aText) && !isNaN(bText)) {
          return isAsc ? bText - aText : aText - bText;
        }
        return isAsc ? bText.localeCompare(aText) : aText.localeCompare(bText);
      });

      rows.forEach(r => tbody.appendChild(r));
      if (isAsc) down.classList.add("active");
      else up.classList.add("active");
    });
  });
</script>

<?= $this->endSection() ?>
