<?= $this->extend('admin/layout/base_admin_template') ?>
<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <h4 class="mb-1 fw-bold">Verifikasi Member BPD</h4>
    <p class="text-muted mb-4">Tinjau dan verifikasi data pendaftaran member GESID yang berada di desa Anda.</p>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-3">Daftar Pendaftaran Member Desa</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Pekerjaan</th>
                            <th>Provinsi</th>
                            <th>Kota</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Foto KTP</th>
                            <th>Foto Wajah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $member): ?>
                            <tr>
                                <td><?= esc($member['id']) ?></td>
                                <td><?= esc($member['nama']) ?></td>
                                <td><?= esc($member['alamat']) ?></td>
                                <td><?= esc($member['telepon']) ?></td>
                                <td><?= esc($member['email']) ?></td>
                                <td><?= esc($member['pekerjaan']) ?></td>
                                <td><?= esc($member['nama_provinsi']) ?></td>
                                <td><?= esc($member['nama_kota']) ?></td>
                                <td><?= esc($member['nama_kecamatan']) ?></td>
                                <td><?= esc($member['nama_desa']) ?></td>
                                <td class="text-center">
                                    <?php if (!empty($member['foto_ktp'])): ?>
                                        <img src="<?= base_url('assets/images/verifikasi/ktp/' . $member['foto_ktp']) ?>" alt="KTP" width="50">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($member['foto_wajah'])): ?>
                                        <img src="<?= base_url('assets/images/verifikasi/wajah/' . $member['foto_wajah']) ?>" alt="Wajah" width="50">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($member['status'] === 'Aktif'): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($member['status'] !== 'Aktif'): ?>
                                        <a href="<?= base_url('bpdadmin/member/activate/' . $member['id']) ?>" class="btn btn-sm btn-success">Aktifkan</a>
                                    <?php endif; ?>
                                    <?php if ($member['status'] !== 'Nonaktif'): ?>
                                        <a href="<?= base_url('bpdadmin/member/deactivate/' . $member['id']) ?>" class="btn btn-sm btn-danger">Nonaktifkan</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($members)): ?>
                            <tr>
                                <td colspan="14" class="text-center text-muted">Tidak ada data member dari desa Anda.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
