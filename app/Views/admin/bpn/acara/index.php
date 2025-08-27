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

<div class="container-fluid">
    <h1 class="h3 mb-4 gold-text gold-shadow"><i class="bi bi-calendar-event me-2"></i> Acara Saya</h1>

    <a href="<?= base_url('/admin/bpn/buat-acara') ?>" class="btn btn-gold mb-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah Acara
    </a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show gold-border" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4 gold-border">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center gold-border rounded-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($acaras as $i => $a): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="text-start"><strong><?= esc($a['judul']) ?></strong></td>
                                <td class="text-start"><?= esc($a['deskripsi']) ?></td>
                                <td>
                                    <?php if (!empty($a['gambar'])): ?>
                                        <img src="<?= base_url('uploads/events/' . $a['gambar']) ?>"
                                            alt="<?= esc($a['judul']) ?>" class="img-thumbnail rounded gold-border" width="80">
                                    <?php else: ?>
                                        <span class="text-muted fst-italic">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($a['status'] == 'pending'): ?>
                                        <span class="badge bg-warning text-dark badge-status">Pending</span>
                                    <?php elseif ($a['status'] == 'approved'): ?>
                                        <span class="badge bg-success badge-status">Approved</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger badge-status">Rejected</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('/admin/bpn/edit-acara/' . $a['id']) ?>"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="<?= base_url('/admin/bpn/delete-acara/' . $a['id']) ?>" method="post"
                                        style="display:inline;" onsubmit="return confirm('Hapus acara ini?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($acaras)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted fst-italic">
                                    <i class="bi bi-info-circle me-2"></i> Belum ada acara.
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