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
        padding: 0.4em 0.7em;
        border-radius: 8px;
        font-weight: 600;
    }
</style>

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-3 gold-border">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 gold-text gold-shadow"><i class="bi bi-file-text me-2"></i> Verifikasi Artikel</h4>
        </div>
        <div class="card-body">

            <!-- Flash messages -->
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

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center gold-border rounded-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Konten</th>
                            <th>Gambar</th>
                            <th>Dibuat Oleh</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($artikel)): ?>
                            <?php $no = 1;
                            foreach ($artikel as $a): ?>
                                <tr>
                                    <td><strong><?= $no++ ?></strong></td>
                                    <td><?= esc($a['judul']) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-warning"
                                            data-bs-toggle="modal" data-bs-target="#kontenModal<?= $a['id'] ?>">
                                            <i class="bi bi-eye"></i> Lihat
                                        </button>
                                    </td>
                                    <td>
                                        <?php if (!empty($a['gambar'])): ?>
                                            <img src="<?= base_url($a['gambar']) ?>" alt="Gambar Artikel" class="img-thumbnail rounded gold-border" width="80">
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">Tidak ada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($a['created_label'] ?? '-') ?></td>
                                    <td><?= esc($a['created_at']) ?></td>
                                    <td>
                                        <?php
                                        switch ($a['status']) {
                                            case 'pending':
                                                echo '<span class="badge bg-warning text-dark badge-status">Menunggu</span>';
                                                break;
                                            case 'approved':
                                                echo '<span class="badge bg-success badge-status">Diterima</span>';
                                                break;
                                            case 'rejected':
                                                echo '<span class="badge bg-danger badge-status">Ditolak</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url('admin/superadmin/verifikasi-artikel/approve/' . $a['id']) ?>" class="btn btn-gold btn-sm">
                                                <i class="bi bi-check-lg"></i> Terima
                                            </a>
                                            <a href="<?= base_url('admin/superadmin/verifikasi-artikel/reject/' . $a['id']) ?>" class="btn btn-danger btn-sm">
                                                <i class="bi bi-x-lg"></i> Tolak
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Konten -->
                                <div class="modal fade" id="kontenModal<?= $a['id'] ?>" tabindex="-1" aria-labelledby="kontenModalLabel<?= $a['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title gold-text gold-shadow" id="kontenModalLabel<?= $a['id'] ?>">
                                                    <i class="bi bi-file-earmark-text me-2"></i> Konten Artikel
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?= $a['konten'] ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted fst-italic">
                                    Tidak ada artikel pending
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