<?= $this->extend('member/layout/base_template') ?>
<?= $this->section('content') ?>

<style>
    /* Background gelap, card tetap putih */
    body {
        background-color: #1e1e1e;
        color: #fff;
    }

    .gold-text {
        color: #d4af37 !important;
    }

    .card-gold {
        border: 1px solid #d4af37;
        border-radius: 12px;
        background-color: #fff;
        /* Card tetap putih */
        color: #333;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        transition: transform 0.2s ease;
    }

    .card-gold:hover {
        transform: translateY(-2px);
    }

    .table thead {
        background-color: #f8f9fa;
        color: #d4af37;
        border-bottom: 2px solid #d4af37;
    }

    .table tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.1);
    }

    .badge-status {
        font-weight: 600;
        padding: 0.4em 0.8em;
        border-radius: 12px;
    }

    .btn-respons {
        background-color: #dc3545;
        color: #fff;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn-respons:hover {
        background-color: #c82333;
        color: #fff;
    }

    .form-control {
        border: 1px solid #d4af37;
        border-radius: 6px;
        background-color: #fff;
        color: #333;
    }

    .form-control:focus {
        border-color: #d4af37;
        box-shadow: 0 0 6px rgba(212, 175, 55, 0.2);
        outline: none;
    }

    .modal-content {
        border-radius: 10px;
        border: 1px solid #d4af37;
        background-color: #fff;
        color: #333;
    }

    .modal-header {
        border-bottom: 1px solid #d4af37;
    }

    .modal-body .form-label {
        color: #333;
    }

    .table tbody td {
        vertical-align: middle;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4 gold-text"><i class="bi bi-chat-left-text me-2"></i>Daftar Aduan dan Respons</h2>

    <div class="card card-gold p-3">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle text-center rounded-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Aduan</th>
                        <th>Isi Aduan</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi (Respons)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($aduan) && is_array($aduan)): ?>
                        <?php $no = 1;
                        foreach ($aduan as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="text-start"><?= esc($row['judul']) ?></td>
                                <td class="text-start"><?= esc($row['isi']) ?></td>
                                <td>
                                    <?php
                                    $statusClass = match ($row['status']) {
                                        'Menunggu' => 'bg-warning text-dark',
                                        'Diterima' => 'bg-primary text-white',
                                        'Selesai' => 'bg-success text-white',
                                        default => 'bg-secondary text-white'
                                    };
                                    ?>
                                    <span class="badge <?= $statusClass ?> badge-status"><?= esc($row['status']) ?></span>
                                </td>
                                <td><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
                                <td>
                                    <?php if ($row['resp_judul']): ?>
                                        <button class="btn btn-respons btn-sm" data-bs-toggle="modal" data-bs-target="#responsModal<?= $row['id_aduan'] ?>">
                                            Lihat Respons
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted">Belum ada respons</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted fst-italic">
                                <i class="bi bi-info-circle me-2"></i>Belum ada aduan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Semua modals -->
<?php if (!empty($aduan) && is_array($aduan)): ?>
    <?php foreach ($aduan as $row): ?>
        <?php if ($row['resp_judul']): ?>
            <div class="modal fade" id="responsModal<?= $row['id_aduan'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title gold-text">Respons Aduan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul Respons</label>
                                <input type="text" class="form-control" value="<?= esc($row['resp_judul']) ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Isi Respons</label>
                                <textarea class="form-control" rows="4" readonly><?= esc($row['resp_isi']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Lampiran</label><br>
                                <?php if (!empty($row['resp_lampiran'])): ?>
                                    <a href="<?= base_url('uploads/lampiran/' . $row['resp_lampiran']) ?>" target="_blank" class="btn btn-outline-primary btn-sm">Lihat</a>
                                <?php else: ?>
                                    <span>Tidak ada lampiran</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>