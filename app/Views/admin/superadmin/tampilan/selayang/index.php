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
        text-align: center;
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

    /* Badge gambar */
    .badge-no-image {
        font-weight: 600;
    }
</style>

<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold gold-text gold-shadow mb-0">📖 Data Selayang Pandang</h3>
        <a href="<?= base_url('admin/selayang-pandang/create') ?>" class="btn btn-gold">
            <i class="bi bi-plus-circle me-1"></i> Tambah
        </a>
    </div>

    <!-- Card Tabel -->
    <div class="card shadow-lg border-0 gold-border rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0 text-white gold-border rounded-3">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Pengantar</th>
                            <th>Latar Belakang</th>
                            <th>Tujuan</th>
                            <th>Ruang Lingkup</th>
                            <th>Gambar</th>
                            <th style="width:150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($selayang as $row): ?>
                            <tr>
                                <td class="fw-semibold"><?= esc($row['judul']) ?></td>
                                <td class="text-muted small"><?= esc($row['pengantar']) ?></td>
                                <td class="text-muted small"><?= esc($row['latar_belakang']) ?></td>
                                <td class="text-muted small"><?= esc($row['tujuan']) ?></td>
                                <td class="text-muted small"><?= esc($row['ruang_lingkup']) ?></td>
                                <td class="text-center">
                                    <?php if (!empty($row['gambar'])): ?>
                                        <img src="<?= base_url('assets/images/' . $row['gambar']) ?>"
                                            alt="Gambar"
                                            class="img-fluid rounded shadow-sm gold-border"
                                            style="max-width:100px;">
                                    <?php else: ?>
                                        <span class="badge bg-secondary badge-no-image">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?= base_url('admin/selayang-pandang/edit/' . $row['id']) ?>"
                                            class="btn btn-sm btn-warning d-flex flex-column align-items-center">
                                            <i class="bi bi-pencil-square mb-1"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a href="<?= base_url('admin/selayang-pandang/delete/' . $row['id']) ?>"
                                            class="btn btn-sm btn-danger d-flex flex-column align-items-center"
                                            onclick="return confirm('Hapus data ini?')">
                                            <i class="bi bi-trash mb-1"></i>
                                            <span>Hapus</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>