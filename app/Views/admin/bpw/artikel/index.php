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

    /* Badge status */
    .badge-status {
        font-weight: 600;
    }

    /* Card wrapper table */
    .card.gold-border {
        border: 1px solid #555;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold gold-text gold-shadow"><i class="bi bi-journal-text me-2"></i> Daftar Artikel</h2>
        <a href="<?= base_url('admin/bpw/buat-artikel') ?>" class="btn btn-gold">
            <i class="bi bi-plus-circle me-1"></i> Tambah Artikel
        </a>
    </div>

    <!-- ✅ Flash Success Message -->
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
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($artikels)): ?>
                            <?php foreach ($artikels as $i => $artikel): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td class="text-start"><strong><?= esc($artikel['judul']) ?></strong></td>
                                    <td><?= esc($artikel['kategori']) ?></td>
                                    <td><?= date('d M Y', strtotime($artikel['tanggal_publikasi'])) ?></td>
                                    <td>
                                        <?php if ($artikel['status'] == 'approved'): ?>
                                            <span class="badge bg-success badge-status">Terpublikasi</span>
                                        <?php elseif ($artikel['status'] == 'rejected'): ?>
                                            <span class="badge bg-danger badge-status">Ditolak</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark badge-status">Menunggu</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($artikel['gambar'])): ?>
                                            <img src="<?= base_url($artikel['gambar']) ?>" alt="thumbnail" class="img-thumbnail gold-border"
                                                style="max-width: 80px;">
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/bpw/edit-artikel/' . $artikel['id']) ?>"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="<?= base_url('admin/bpw/delete-artikel/' . $artikel['id']) ?>" method="post"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted fst-italic">
                                    <i class="bi bi-info-circle me-2"></i> Belum ada artikel
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