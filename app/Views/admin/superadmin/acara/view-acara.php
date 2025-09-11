<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<style>
    /* Warna emas */
    .gold-text {
        color: #FFD700 !important;
    }

    .gold-border {
        border: 2px solid #555 !important;
        /* outline diganti abu */
    }

    .gold-shadow {
        text-shadow: 0 0 6px rgba(255, 215, 0, 0.7);
    }

    /* Tabel */
    .table thead {
        background: #2a2a2a;
        /* header gelap */
        color: #FFD700 !important;
        /* teks emas */
        border-bottom: 2px solid #555;
        /* border header abu */
    }

    .table tbody tr {
        border-bottom: 1px solid #444;
        /* line row abu */
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(255, 215, 0, 0.08);
        /* hover tipis emas */
        border-left: 3px solid #FFD700;
    }

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
        /* abu */
    }

    /* Badge status tetap */
    .badge-status {
        padding: 0.4em 0.7em;
        border-radius: 8px;
        font-weight: 600;
    }
</style>

<div class="container-fluid mt-3">
    <div class="card shadow-lg border-0 rounded-3 gold-border">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 gold-text gold-shadow"><i class="bi bi-calendar-event me-2"></i> Verifikasi Acara</h4>
        </div>
        <div class="card-body">

            <!-- Flash Messages -->
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
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th>Diperbarui</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($acaras)): ?>
                            <?php foreach ($acaras as $acara): ?>
                                <tr>
                                    <td><strong><?= esc($acara['id']) ?></strong></td>
                                    <td><?= esc($acara['judul']) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#deskripsiModal<?= $acara['id'] ?>">
                                            <i class="bi bi-eye"></i> Lihat
                                        </button>
                                    </td>
                                    <td>
                                        <?php if ($acara['gambar']): ?>
                                            <img src="<?= base_url('uploads/events/' . $acara['gambar']) ?>"
                                                alt="<?= esc($acara['judul']) ?>" class="img-thumbnail rounded gold-border"
                                                width="100">
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">Tidak ada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($acara['created_label'] ?? '-') ?></td>
                                    <td>
                                        <?php
                                        switch ($acara['status']) {
                                            case 'approved':
                                                echo '<span class="badge bg-success badge-status">Diterima</span>';
                                                break;
                                            case 'rejected':
                                                echo '<span class="badge bg-danger badge-status">Ditolak</span>';
                                                break;
                                            default:
                                                echo '<span class="badge bg-warning text-dark badge-status">Menunggu</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td><?= esc($acara['created_at']) ?></td>
                                    <td><?= esc($acara['updated_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted fst-italic">
                                    <i class="bi bi-info-circle me-2"></i> Tidak ada acara untuk diverifikasi.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Deskripsi -->
<div class="modal fade" id="deskripsiModal<?= $acara['id'] ?>" tabindex="-1" aria-labelledby="deskripsiModalLabel<?= $acara['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title gold-text gold-shadow" id="deskripsiModalLabel<?= $acara['id'] ?>">
                    <i class="bi bi-card-text me-2"></i> Deskripsi Acara
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <?= $acara['deskripsi'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>