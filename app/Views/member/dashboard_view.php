<?= $this->extend('member/layout/base_template') ?>

<?= $this->section('content') ?>

<style>
    /* Tema emas profesional */
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

    .list-group-item-gold {
        border-bottom: 1px solid #d4af37;
        background-color: #fdfaf0;
        transition: background-color 0.2s;
    }

    .list-group-item-gold:last-child {
        border-bottom: none;
    }

    .list-group-item-gold:hover {
        background-color: #fff8e1;
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

    .card-title i {
        color: #bfa835;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4 gold-text gold-shadow"><i class="bi bi-speedometer2 me-2"></i>Dashboard Member</h2>

    <div class="card card-gold mb-4 p-4">
        <div class="card-body">
            <h5 class="card-title gold-text"><i class="bi bi-person-circle me-2"></i>Selamat datang, <?= esc($member['nama']) ?>!</h5>
            <p class="card-text mt-2">
                Status akun Anda:
                <span class="badge <?= $member['status'] == 'Aktif' ? 'badge-gold' : 'badge-inactive' ?>">
                    <?= esc($member['status']) ?>
                </span>
            </p>

            <ul class="list-group list-group-flush mt-4">
                <li class="list-group-item list-group-item-gold"><strong>Provinsi:</strong> <?= esc($member['nama_provinsi']) ?></li>
                <li class="list-group-item list-group-item-gold"><strong>Kota/Kabupaten:</strong> <?= esc($member['nama_kota']) ?></li>
                <li class="list-group-item list-group-item-gold"><strong>Kecamatan:</strong> <?= esc($member['nama_kecamatan']) ?></li>
                <li class="list-group-item list-group-item-gold"><strong>Desa/Kelurahan:</strong> <?= esc($member['nama_desa']) ?></li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>