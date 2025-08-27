<?= $this->extend('member/layout/base_template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Daftar Aduan dan Respons</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
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
                            <?php $no = 1; foreach ($aduan as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($row['judul']) ?></td>
                                    <td><?= esc($row['isi']) ?></td>
                                    <td>
                                        <?php if ($row['status'] == 'Menunggu'): ?>
                                            <span class="badge bg-warning text-dark"><?= esc($row['status']) ?></span>
                                        <?php elseif ($row['status'] == 'Diterima'): ?>
                                            <span class="badge bg-success"><?= esc($row['status']) ?></span>
                                        <?php elseif ($row['status'] == 'Selesai'): ?>
                                            <span class="badge bg-primary"><?= esc($row['status']) ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= esc($row['status']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
                                    <td>
                                        <?php if ($row['resp_judul']): ?>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#responsModal<?= $row['id_aduan'] ?>">
                                                Respons
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted">Belum ada respons</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <!-- Respons Modal (read-only) -->
                                <div class="modal fade" id="responsModal<?= $row['id_aduan'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Respons Aduan</h5>
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
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada aduan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
