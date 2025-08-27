<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3 class="mb-4 text-primary">Daftar Aduan Member</h3>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
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
                    <tr><td colspan="5" class="text-center">Belum ada aduan.</td></tr>
                <?php else : ?>
                    <?php foreach ($aduan as $i => $a) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($a['nama']) ?></td>
                            <td><?= esc($a['email']) ?></td>
                            <td><?= esc($a['komentar']) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($a['created_at'])) ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
