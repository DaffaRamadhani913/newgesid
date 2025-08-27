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

    /* Badge status */
    .badge-status {
        font-weight: 600;
    }

    .text-truncate-50 {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<div class="container-fluid py-4">
    <h4 class="mb-1 fw-bold gold-text gold-shadow">Verifikasi Member</h4>
    <p class="text-white mb-4">Tinjau dan verifikasi data pendaftaran member baru GESID.</p>

    <div class="card shadow-sm border-0 gold-border">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-3 text-dark">Daftar Pendaftaran Member</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center gold-border rounded-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th class="text-truncate-50">Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Pekerjaan</th>
                            <th>Provinsi</th>
                            <th>Kota</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Foto KTP</th>
                            <th>Foto Wajah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $member): ?>
                            <tr>
                                <td><?= esc($member['id']) ?></td>
                                <td class="text-start"><?= esc($member['nama']) ?></td>
                                <td class="text-start text-truncate-50"><?= esc($member['alamat']) ?></td>
                                <td><?= esc($member['telepon']) ?></td>
                                <td><?= esc($member['email']) ?></td>
                                <td><?= esc($member['pekerjaan']) ?></td>
                                <td><?= esc($member['nama_provinsi']) ?></td>
                                <td><?= esc($member['nama_kota']) ?></td>
                                <td><?= esc($member['nama_kecamatan']) ?></td>
                                <td><?= esc($member['nama_desa']) ?></td>
                                <td class="text-center">
                                    <?php if (!empty($member['foto_ktp'])): ?>
                                        <img src="<?= base_url('assets/images/verifikasi/ktp/' . $member['foto_ktp']) ?>" alt="KTP" class="img-thumbnail rounded gold-border" width="50">
                                    <?php else: ?>
                                        <span class="text-muted fst-italic">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($member['foto_wajah'])): ?>
                                        <img src="<?= base_url('assets/images/verifikasi/wajah/' . $member['foto_wajah']) ?>" alt="Wajah" class="img-thumbnail rounded gold-border" width="50">
                                    <?php else: ?>
                                        <span class="text-muted fst-italic">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($member['status'] === 'Aktif'): ?>
                                        <span class="badge bg-success badge-status">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary badge-status">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($member['status'] !== 'Aktif'): ?>
                                        <a href="<?= base_url('member/activate/' . $member['id']) ?>" class="btn btn-sm btn-gold mb-1">Aktifkan</a>
                                    <?php endif; ?>
                                    <?php if ($member['status'] !== 'Nonaktif'): ?>
                                        <a href="<?= base_url('member/deactivate/' . $member['id']) ?>" class="btn btn-sm btn-danger mb-1">Nonaktifkan</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($members)): ?>
                            <tr>
                                <td colspan="14" class="text-center text-muted fst-italic">
                                    <i class="bi bi-info-circle me-2"></i> Tidak ada data member yang tersedia.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>