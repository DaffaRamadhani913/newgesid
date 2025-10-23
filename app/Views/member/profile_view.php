<?= $this->extend('member/layout/base_template') ?>

<?= $this->section('content') ?>

<style>
    /* Tema profesional minimalis dengan aksen emas */
    .gold-text {
        color: #bfa835 !important;
    }

    .gold-border {
        border: 1.2px solid #d4af37 !important;
        border-radius: 8px;
        transition: border-color 0.3s, box-shadow 0.3s;
        background-color: #fff;
    }

    .gold-border:focus {
        border-color: #bfa835 !important;
        box-shadow: 0 0 5px rgba(212, 175, 55, 0.2);
        outline: none;
    }

    .btn-gold {
        background-color: #d4af37;
        color: #fff;
        font-weight: 500;
        border-radius: 6px;
        transition: background-color 0.3s;
    }

    .btn-gold:hover {
        background-color: #bfa835;
        color: #fff;
    }

    .card-gold {
        border: 1px solid #d4af37;
        border-radius: 12px;
        background-color: #fff;
        padding: 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .alert-gold {
        border: 1px solid #d4af37;
        background-color: rgba(212, 175, 55, 0.08);
        color: #333;
        border-radius: 6px;
        padding: 12px 20px;
    }

    .form-label {
        font-weight: 500;
    }

    @media (max-width: 576px) {
        .card-gold {
            padding: 20px;
        }

        h2 {
            font-size: 1.5rem;
        }
    }
</style>

<!-- 🔹 Hamburger Button (use same class the CSS expects) -->
<button class="gesid-hamburger btn btn-outline-warning d-lg-none" id="toggleSidebar" aria-label="Toggle sidebar">
    <i class="bi bi-list fs-4"></i>
</button>

<div class="container mt-4">
    <div class="card card-gold">
        <h2 class="mb-4 gold-text"><i class="bi bi-person-circle me-2"></i>Profil Saya</h2>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show alert-gold" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Form Profil -->
        <form action="<?= base_url('member/profil/update') ?>" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control gold-border" value="<?= esc($member['nama']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control gold-border" value="<?= esc($member['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" name="telepon" id="telepon" class="form-control gold-border" value="<?= esc($member['telepon']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control gold-border" rows="3"><?= esc($member['alamat']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-gold w-100"><i class="bi bi-save-fill me-1"></i> Simpan Perubahan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>