<?= $this->extend('member/layout/base_template') ?>
<?= $this->section('content') ?>

<style>
  .gold-text {
    color: #bfa835 !important;
    font-weight: 600;
  }

  .gold-shadow {
    text-shadow: 0 0 4px rgba(191, 168, 53, 0.6);
  }

  .card-gold {
    border: 1px solid #d4af37;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.15);
    background-color: #fff;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .card-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.25);
  }

  .badge-gold {
    background: linear-gradient(90deg, #FFD700, #DAA520);
    color: #000;
    font-weight: 600;
    padding: 0.35em 0.75em;
    border-radius: 12px;
  }

  .badge-inactive {
    background-color: #6c757d;
    color: #fff;
    font-weight: 600;
    padding: 0.35em 0.75em;
    border-radius: 12px;
  }

  /* Kartu Member */
  .member-card {
    position: relative;
    width: 480px;
    height: 300px;
    background-size: cover;
    background-position: center;
    border-radius: 12px;
    overflow: hidden;
  }

  .member-data {
    position: absolute;
    top: 120px;
    /* sesuaikan posisi vertikal */
    left: 40px;
    /* sesuaikan posisi horizontal */
    color: white;
    font-size: 14px;
    line-height: 1.6;
    font-weight: 500;
  }

  .member-photo {
    position: absolute;
    top: 110px;
    right: 40px;
    width: 110px;
    height: 130px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid #fff;
  }

  .member-back {
    width: 480px;
    height: 300px;
    background-size: cover;
    background-position: center;
    border-radius: 12px;
  }

  .member-scroll {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scroll-snap-type: x mandatory;
    padding-bottom: 12px;
  }

  .member-card,
  .member-back {
    scroll-snap-align: center;
    flex: 0 0 auto;
  }
</style>

<!-- 🔹 Hamburger Button (use same class the CSS expects) -->
<button class="gesid-hamburger btn btn-outline-warning d-lg-none" id="toggleSidebar" aria-label="Toggle sidebar">
  <i class="bi bi-list fs-4"></i>
</button>


<div class="container mt-4">
  <h2 class="mb-4 gold-text gold-shadow"><i class="bi bi-speedometer2 me-2"></i>Dashboard Member</h2>

  <!-- Profil Member -->
  <div class="card card-gold mb-4 p-4">
    <div class="card-body">
      <h5 class="card-title gold-text"><i class="bi bi-person-circle me-2"></i>Selamat datang,
        <?= esc($member['nama']) ?>!
      </h5>
      <p class="card-text mt-2">
        Status akun Anda:
        <span class="badge <?= $member['status'] == 'Aktif' ? 'badge-gold' : 'badge-inactive' ?>">
          <?= esc($member['status']) ?>
        </span>
      </p>
      <div class="card-body text-center">
        <h5 class="card-title gold-text mb-4"><i class="bi bi-credit-card-2-front me-2"></i>Kartu Anggota GESID
        </h5>

        <div class="d-flex gap-4 flex-nowrap member-scroll">
          <!-- Front Card -->
          <div class="member-card"
            style="background-image: url('<?= base_url('assets/img/member_card/member_card_front.png') ?>');">
            <div class="member-data text-start" style="margin-top: 10px;">
              <div>ID&nbsp;&nbsp;&nbsp;&nbsp;: <?= esc($member['member_id']) ?></div>
              <div>Nama : <?= esc($member['nama']) ?></div>
              <div>Provinsi : <?= esc($member['nama_provinsi']) ?></div>
              <div>Kota/Kab : <?= esc($member['nama_kota']) ?></div>
              <div>Desa : <?= esc($member['nama_desa']) ?></div>
            </div>
            <?php if (!empty($member['foto_wajah'])): ?>
              <img src="<?= base_url('assets/images/verifikasi/wajah/' . $member['foto_wajah']) ?>" class="member-photo"
                alt="Foto Wajah">
            <?php endif; ?>
          </div>

          <!-- Back Card -->
          <div class="member-back"
            style="background-image: url('<?= base_url('assets/img/member_card/member_card_back.png') ?>');">
          </div>
        </div>

        <!-- Download Button -->
        <div class="mt-4">
          <a href="<?= site_url('member/downloadCard') ?>" class="btn btn-warning fw-bold">
            <i class="bi bi-download me-2"></i>Unduh Kartu Member
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>