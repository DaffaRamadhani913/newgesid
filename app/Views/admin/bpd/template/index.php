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

    /* Card */
    .gold-card {
        border: 1px solid #555;
        border-radius: 0.5rem;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold gold-text gold-shadow"><i class="bi bi-file-earmark-text me-2"></i> Download Administrasi
        </h2>
    </div>

    <div class="table-responsive gold-card p-2 shadow-sm">
        <table class="table table-hover align-middle text-center gold-border rounded-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>File Download</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($templates)): ?>
                    <?php foreach ($templates as $i => $template): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="text-start"><?= esc($template['judul']) ?></td>
                            <td><?= esc($template['deskripsi']) ?></td>
                            <td>
                                <?php if ($template['file_template']): ?>
                                    <a href="<?= base_url('uploads/template/' . $template['file_template']) ?>" class="btn btn-sm btn-warning" download>
                                        Download
                                    </a>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted fst-italic">
                            <i class="bi bi-info-circle me-2"></i> Belum ada download tersedia
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>