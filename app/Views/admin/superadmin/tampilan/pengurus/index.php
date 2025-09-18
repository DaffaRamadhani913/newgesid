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

    /* Badge role */
    .badge-role {
        font-weight: 600;
    }
</style>

<div class="container mt-4">
    <div class="card shadow-lg border-0 gold-border">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 gold-text gold-shadow"><i class="bi bi-people-fill me-2"></i> Manajemen Admin BPN</h4>
            <a href="<?= base_url('admin/superadmin/adminbpn/create') ?>" class="btn btn-gold btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah BPN Admin
            </a>
        </div>
        <div class="card-body">

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

            <!-- Tabel Admin -->
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center gold-border rounded-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Sub Role</th> <!-- New column -->
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bpn_admins) && is_array($bpn_admins)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($bpn_admins as $bpn): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="text-start"><strong><?= esc($bpn['nama']) ?></strong></td>
                                    <td><?= esc($bpn['username']) ?></td>
                                    <td><?= esc($bpn['email']) ?></td>
                                    <td>
                                        <span
                                            class="badge bg-info text-dark badge-role"><?= esc(ucfirst($bpn['role'])) ?></span>
                                    </td>
                                    <td>
                                        <?php if (!empty($bpn['sub_role'])): ?>
                                            <?php if ($bpn['sub_role'] === 'okk'): ?>
                                                <span class="badge bg-primary">OKK BPN</span>
                                            <?php elseif ($bpn['sub_role'] === 'humas'): ?>
                                                <span class="badge bg-success">Humas BPN</span>
                                            <?php elseif ($bpn['sub_role'] === 'sekretariat'): ?>
                                                <span class="badge bg-warning text-dark">Sekretariat BPN</span>
                                            <?php elseif ($bpn['sub_role'] === 'presiden'): ?>
                                                <span class="badge bg-danger">Presiden BPN</span>
                                            <?php elseif ($bpn['sub_role'] === 'sekjen'): ?>
                                                <span class="badge bg-dark">Sekretaris Jendral BPN</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">-</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?= base_url('admin/superadmin/adminbpn/edit/' . $bpn['id']) ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/superadmin/adminbpn/delete/' . $bpn['id']) ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                                <i class="bi bi-trash3"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted fst-italic">
                                    <i class="bi bi-info-circle me-2"></i> Belum ada admin BPN
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