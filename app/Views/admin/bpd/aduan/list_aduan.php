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
</style>

<div class="container mt-4">
    <h2 class="mb-4 gold-text gold-shadow"><i class="bi bi-exclamation-circle me-2"></i>Daftar Aduan</h2>

    <div class="card shadow-sm gold-border">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center gold-border rounded-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Lampiran</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
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
                                        <?php if (!empty($row['lampiran'])): ?>
                                            <a href="<?= base_url('uploads/aduan/' . $row['lampiran']) ?>" target="_blank">Lihat</a>
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">Tidak ada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($row['status'] == 'Menunggu'): ?>
                                            <span class="badge bg-warning text-dark badge-status"><?= esc($row['status']) ?></span>
                                        <?php elseif ($row['status'] == 'Diterima'): ?>
                                            <span class="badge bg-success badge-status"><?= esc($row['status']) ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger badge-status"><?= esc($row['status']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
                                    <td>
                                        <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#responsModal<?= $row['id_aduan'] ?>">
                                            <i class="bi bi-reply-fill me-1"></i> Respons
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="responsModal<?= $row['id_aduan'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= base_url('admin/bpd/kirimRespons/' . $row['id_aduan']) ?>" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_aduan" value="<?= $row['id_aduan'] ?>">

                                            <div class="modal-content gold-border">
                                                <div class="modal-header bg-dark text-white">
                                                    <h5 class="modal-title gold-text"><i class="bi bi-pencil-square me-1"></i> Tambah Respons</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Judul</label>
                                                        <input type="text" name="judul" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Isi</label>
                                                        <textarea name="isi" class="form-control" rows="4" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Lampiran (Opsional)</label>
                                                        <input type="file" name="lampiran" class="form-control" accept="image/*,application/pdf">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-gold">Kirim</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted fst-italic">
                                    <i class="bi bi-info-circle me-2"></i> Tidak ada data aduan.
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