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

  .sort-icons .active { color: #FFD700; font-weight: bold; }

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

  <!-- 🔍 Search -->
  <div class="row g-2 mb-3 justify-content-center">
    <div class="col-md-4">
      <input type="text" id="searchInput" class="form-control gold-border" placeholder="Cari member...">
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
  // 🔍 Search
  document.getElementById("searchInput").addEventListener("input", function() {
    const val = this.value.toLowerCase();
    document.querySelectorAll("#memberTable tbody tr").forEach(row => {
      row.style.display = row.textContent.toLowerCase().includes(val) ? "" : "none";
    });
  });

  // 🖼️ Image Zoom
  document.querySelectorAll(".zoomable img").forEach(img => {
    img.addEventListener("click", e => {
      e.preventDefault();
      document.getElementById("modalImage").src = img.src;
      new bootstrap.Modal(document.getElementById("imageModal")).show();
    });
  });

  // 🔽 Sortable Columns
  document.querySelectorAll("#memberTable thead th").forEach((th, i) => {
    th.addEventListener("click", () => {
      if (!th.querySelector(".sort-icons")) return;
      const table = th.closest("table");
      const tbody = table.querySelector("tbody");
      const rows = Array.from(tbody.querySelectorAll("tr"));
      const up = th.querySelector(".up");
      const down = th.querySelector(".down");
      const isAsc = up.classList.contains("active");
      table.querySelectorAll(".sort-icons .up, .sort-icons .down").forEach(el => el.classList.remove("active"));

      rows.sort((a, b) => {
        const aText = a.cells[i].innerText.trim().toLowerCase();
        const bText = b.cells[i].innerText.trim().toLowerCase();
        return isAsc ? bText.localeCompare(aText) : aText.localeCompare(bText);
      });

      rows.forEach(r => tbody.appendChild(r));
      if (isAsc) down.classList.add("active"); else up.classList.add("active");
    });
  });
</script>

<?= $this->endSection() ?>
