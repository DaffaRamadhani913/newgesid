<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<style>
    /* Warna emas untuk header dan tombol */
    .gold-text {
        color: #FFD700 !important;
    }

    .gold-border {
        border: 2px solid #555 !important;
    }

    .gold-shadow {
        text-shadow: 0 0 6px rgba(255, 215, 0, 0.7);
    }

    /* Card */
    .card.gold-border {
        border: 1px solid #555;
    }

    /* Table */
    .table th {
        color: #000000;
        /* header tetap emas */
        width: 120px;
    }

    .table td {
        color: #000000;
        /* konten teks jadi hitam */
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
</style>

<div class="container mt-4">
    <div class="card shadow-lg border-0 gold-border rounded-3">
        <div class="card-header bg-dark text-white">
            <h4 class="card-title mb-0 gold-text gold-shadow">
                <i class="bi bi-bullseye me-2"></i> Visi dan Misi
            </h4>
        </div>
        <div class="card-body p-4">
            <table class="table table-borderless">
                <tr>
                    <th class="align-top">Visi</th>
                    <td><?= esc($visimisi['visi'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th class="align-top">Misi</th>
                    <td>
                        <?php if (!empty($visimisi['misi'])): ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach (explode("\n", $visimisi['misi']) as $misi): ?>
                                    <?php if (trim($misi) !== ''): ?>
                                        <li class="list-group-item bg-transparent border-0 ps-0" style="color: #000;">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i><?= esc($misi) ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <div class="mt-4">
                <a href="<?= base_url('/admin/visi-misi/edit') ?>" class="btn btn-gold">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>