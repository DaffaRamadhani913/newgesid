<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Broadcast Email</h1>

    <?php if(session()->getFlashdata('message')): ?>
        <div class="alert alert-info">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/bpn/broadcast/send') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="6" class="form-control" required></textarea>
        </div>

        <p class="text-white mt-3">
            <i>Email akan dikirim ke semua Admin & Member GESID</i>
        </p>

        <button type="submit" class="btn btn-primary">Kirim Broadcast</button>
    </form>
</div>

<?= $this->endSection() ?>
