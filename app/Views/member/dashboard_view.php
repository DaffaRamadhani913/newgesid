<?= $this->extend('member/layout/base_template') ?>


<?= $this->section('content') ?>
<div class="container mt-4">
    <h2 class="mb-4">Dashboard Member</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Selamat datang, <?= esc($member['nama']) ?>!</h5>
            <p class="card-text">Status akun Anda: 
                <span class="badge bg-<?= $member['status'] == 'Aktif' ? 'success' : 'secondary' ?>">
                    <?= esc($member['status']) ?>
                </span>
            </p>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Provinsi:</strong> <?= esc($member['nama_provinsi']) ?></li>
                <li class="list-group-item"><strong>Kota/Kabupaten:</strong> <?= esc($member['nama_kota']) ?></li>
                <li class="list-group-item"><strong>Kecamatan:</strong> <?= esc($member['nama_kecamatan']) ?></li>
                <li class="list-group-item"><strong>Desa/Kelurahan:</strong> <?= esc($member['nama_desa']) ?></li>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
