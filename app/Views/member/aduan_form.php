<?= $this->extend('member/layout/base_template') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2 class="mb-4">Form Aduan</h2>

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

        <button type="submit" class="btn btn-primary">Kirim Aduan</button>
    </form>
</div>
<?= $this->endSection() ?>
