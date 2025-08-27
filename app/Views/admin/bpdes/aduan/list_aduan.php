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
    .card.gold-border {
        border: 1px solid #555;
    }

    /* Alert */
    .alert.gold-border {
        border: 1px solid #555;
    }
</style>

<div class="container mt-4">
    <h3 class="mb-4 gold-text gold-shadow"><i class="bi bi-chat-left-text me-2"></i> Daftar Aduan Member</h3>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show gold-border" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive card shadow mb-4 gold-border p-3">
        <table class="table table-hover align-middle text-center gold-border rounded-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Komentar</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($aduan)) : ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted fst-italic">
                            <i class="bi bi-info-circle me-2"></i> Belum ada aduan.
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($aduan as $i => $a) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="text-start"><?= esc($a['nama']) ?></td>
                            <td><?= esc($a['email']) ?></td>
                            <td class="text-start"><?= esc($a['komentar']) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($a['created_at'])) ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>