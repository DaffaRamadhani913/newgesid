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
</style>

<div class="container-fluid">
    <h1 class="h3 mb-4 gold-text gold-shadow"><i class="bi bi-envelope-paper me-2"></i> Broadcast Email</h1>

    <!-- Flash message -->
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-info gold-border">
            <i class="bi bi-info-circle-fill me-2"></i><?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <!-- Button Broadcast Email -->
    <div class="mb-3">
        <a href="<?= base_url('admin/bpn/broadcast/form') ?>" class="btn btn-gold">
            <i class="bi bi-plus-circle me-1"></i> Broadcast Baru
        </a>
    </div>

    <!-- Table List Broadcast -->
    <div class="card shadow mb-4 gold-border">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center gold-border rounded-3">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($emails)): ?>
                            <?php $no = 1; foreach ($emails as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="text-start"><strong><?= esc($row['subject']) ?></strong></td>
                                    <td class="text-start"><?= substr(strip_tags($row['message']), 0, 80) ?>...</td>
                                    <td><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted fst-italic">
                                    <i class="bi bi-info-circle me-2"></i> Belum ada broadcast email.
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
