<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<h2>Edit Event</h2>

<form action="<?= base_url('admin/events/update/' . $event['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" name="title" id="title" class="form-control" value="<?= esc($event['title']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Gambar (biarkan kosong jika tidak ingin mengganti)</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
        <div class="mt-2">
            <img src="<?= base_url('assets/images/events/' . $event['image']) ?>" alt="" width="100" height="100" style="object-fit: cover;">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('admin/events') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection(); ?>
