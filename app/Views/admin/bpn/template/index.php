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

    /* Card / container */
    .gold-card {
        border: 1px solid #555;
        border-radius: 0.5rem;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold gold-text gold-shadow">
            <i class="bi bi-folder2-open me-2"></i> Daftar Template
        </h2>
        <a href="<?= base_url('admin/bpn/tambah-template') ?>" class="btn btn-gold">
            <i class="bi bi-plus-circle"></i> Tambah Template
        </a>
    </div>

    <!-- ✅ Flash Success Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show gold-border" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive gold-card p-2 shadow-sm">
        <table class="table table-hover align-middle text-center gold-border rounded-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($templates)): ?>
                    <?php foreach ($templates as $i => $t): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="text-start"><?= esc($t['judul']) ?></td>
                            <td><?= esc($t['deskripsi']) ?></td>
                            <td>
                                <?php if (!empty($t['file_template'])): ?>
                                    <a href="<?= base_url('uploads/template/'.$t['file_template']) ?>" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-file-earmark-text"></i> Lihat
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted fst-italic">Tidak ada file</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/bpn/edit-template/'.$t['id']) ?>"
                                    class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="<?= base_url('admin/bpn/delete-template/'.$t['id']) ?>" method="post"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus template ini?');">
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
                        <td colspan="5" class="text-center text-muted fst-italic">
                            <i class="bi bi-info-circle me-2"></i> Belum ada template
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
