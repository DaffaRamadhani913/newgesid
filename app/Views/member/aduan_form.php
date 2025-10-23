<?= $this->extend('member/layout/base_template') ?>

<?= $this->section('content') ?>
<style>
    .form-container {
        background-color: #fff;
        border: 1px solid #d4af37;
        border-radius: 12px;
        padding: 35px 30px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .form-container h2 {
        color: #bfa835;
        font-weight: 700;
        margin-bottom: 30px;
        font-size: 1.8rem;
    }

    .form-label {
        font-weight: 600;
        font-size: 1rem;
        color: #333;
    }

    .form-control {
        border: 1px solid #d4af37;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 0.95rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: #bfa835;
        box-shadow: 0 0 6px rgba(212, 175, 55, 0.25);
        outline: none;
    }

    .btn-submit {
        background-color: #bfa835;
        border: none;
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
        padding: 10px 15px;
        border-radius: 8px;
        transition: background-color 0.3s, transform 0.2s;
        width: 100%;
    }

    .btn-submit:hover {
        background-color: #d4af37;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 8px;
        padding: 14px 20px;
        font-size: 0.95rem;
    }
</style>

<!-- 🔹 Tombol Sidebar -->
<button class="gesid-hamburger btn btn-outline-warning d-lg-none" id="toggleSidebar" aria-label="Toggle sidebar">
    <i class="bi bi-list fs-4"></i>
</button>

<div class="container mt-4">
    <div class="form-container">
        <h2>Form Aduan</h2>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('member/aduan') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>



            <div class="mb-3">
                <label for="judul" class="form-label">Judul Aduan</label>
                <input type="text" name="judul" id="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Isi Aduan</label>
                <textarea name="isi" id="isi" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="lampiran" class="form-label">Lampiran (Opsional)</label>
                <input type="file" name="lampiran" id="lampiran" class="form-control">
            </div>

            <div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan Aduan</label>
                <select name="tujuan" id="tujuan" class="form-control" required>
                    <option value="">-- Pilih Tujuan --</option>

                    <?php foreach ($tujuanOptions as $key => $label) : ?>
                        <?php if ($key === 'none') : ?>
                            <option value="" disabled><?= esc($label) ?></option>
                        <?php else : ?>
                            <option value="<?= esc($key) ?>"><?= esc($label) ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>




            <button type="submit" class="btn btn-submit">Kirim Aduan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>