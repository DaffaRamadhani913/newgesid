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

<div class="container mt-4">
    <div class="card shadow-lg border-0 gold-border">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 gold-text gold-shadow"><i class="bi bi-calendar-event me-2"></i> Daftar Event</h4>
            <a href="<?= base_url('admin/events/create') ?>" class="btn btn-gold btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Event
            </a>
        </div>
        <div class="card-body">

            <!-- Notifikasi Sukses -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show gold-border" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Tabel Event -->
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center gold-border rounded-3">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Gambar</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($events)): ?>
                            <?php foreach ($events as $event): ?>
                                <tr>
                                    <td class="text-start">
                                        <strong><?= esc($event['title']) ?></strong>
                                    </td>
                                    <td>
                                        <img src="<?= base_url('assets/images/events/' . $event['image']) ?>"
                                            alt="Gambar Event"
                                            class="img-thumbnail rounded gold-border"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?= base_url('admin/events/edit/' . $event['id']) ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <form action="<?= base_url('admin/events/delete/' . $event['id']) ?>"
                                                method="post"
                                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash3"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted fst-italic">
                                    <i class="bi bi-info-circle me-2"></i> Belum ada event yang ditambahkan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>