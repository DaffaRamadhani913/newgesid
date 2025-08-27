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

    /* Card wrapper table */
    .card.gold-border {
        border: 1px solid #555;
    }

    /* Badge role */
    .badge-role {
        font-weight: 600;
    }
</style>

<div class="container-fluid mt-4">
    <h3 class="gold-text gold-shadow mb-3"><i class="bi bi-people-fill me-2"></i> Manajemen Admin BPD</h3>

    <!-- Notifikasi -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show gold-border" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show gold-border" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <a href="<?= base_url('admin/bpw/adminbpd/create') ?>" class="btn btn-gold mb-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah BPD Admin
    </a>

    <div class="card shadow mb-4 gold-border">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center gold-border rounded-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Kota/Kabupaten</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bpd_admins) && is_array($bpd_admins)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($bpd_admins as $bpd): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="text-start"><strong><?= esc($bpd['nama']) ?></strong></td>
                                    <td><?= esc($bpd['username']) ?></td>
                                    <td><?= esc($bpd['nama_kota']) ?></td>
                                    <td>
                                        <span class="badge bg-info text-dark badge-role"><?= esc(ucfirst($bpd['role'])) ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?= base_url('admin/bpw/adminbpd/edit/' . $bpd['id']) ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/bpw/adminbpd/delete/' . $bpd['id']) ?>" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                                <i class="bi bi-trash3"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted fst-italic">
                                    <i class="bi bi-info-circle me-2"></i> Belum ada admin BPD
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>