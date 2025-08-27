<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<main>
    <!-- Event Section -->
    <section id="member" class="member section">

    <!-- Section Title -->
    <div class="container text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold" style="font-size: 2.5rem;">
            Formulir Pendaftaran Member
            <span class="d-block mx-auto mt-3" style="height: 4px; width: 60px; background-color: #f5b932;"></span>
        </h2>
    </div>
    <!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-form-wrapper">
                        <form action="<?= base_url(relativePath: 'formulir') ?>" method="post"
                            enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row g-3">

                                <!-- Nama Lengkap -->
                                <div class="col-md-12">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan nama lengkap" required>
                                </div>

                                <!-- Provinsi -->
                                <div class="col-md-6">
                                    <label for="id_provinsi" class="form-label">Provinsi</label>
                                    <select class="form-control" id="id_provinsi" name="id_provinsi" required>
                                        <option value="">-- Pilih Provinsi --</option>
                                        <?php foreach ($provinsi as $p): ?>
                                            <option value="<?= $p['id_provinsi'] ?>"><?= $p['nama_provinsi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Kota/Kabupaten -->
                                <div class="col-md-6">
                                    <label for="id_kota" class="form-label">Kota/Kabupaten</label>
                                    <select class="form-control" id="id_kota" name="id_kota" required>
                                        <option value="">-- Pilih Kota/Kabupaten --</option>
                                    </select>
                                </div>

                                <!-- Kecamatan -->
                                <div class="col-md-6">
                                    <label for="id_kecamatan" class="form-label">Kecamatan</label>
                                    <select class="form-control" id="id_kecamatan" name="id_kecamatan" required>
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>
                                </div>

                                <!-- Desa/Kelurahan -->
                                <div class="col-md-6">
                                    <label for="id_desa" class="form-label">Desa/Kelurahan</label>
                                    <select class="form-control" id="id_desa" name="id_desa" required>
                                        <option value="">-- Pilih Desa/Kelurahan --</option>
                                    </select>
                                </div>

                                <!-- Alamat -->
                                <div class="col-md-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                        required></textarea>
                                </div>

                                <!-- No. Telepon -->
                                <div class="col-md-6">
                                    <label for="telepon" class="form-label">No. Telepon</label>
                                    <input type="text" class="form-control" id="telepon" name="telepon" required>
                                </div>

                                <!-- Email Aktif -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Aktif</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <!-- Pekerjaan -->
                                <div class="col-md-12">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                                </div>

                                <!-- Foto KTP -->
                                <div class="col-md-6">
                                    <label for="foto_ktp" class="form-label">Foto KTP</label>
                                    <input type="file" class="form-control" id="foto_ktp" name="foto_ktp"
                                        accept="image/*" required>
                                </div>

                                <!-- Foto Wajah -->
                                <div class="col-md-6">
                                    <label for="foto_wajah" class="form-label">Foto Wajah</label>
                                    <input type="file" class="form-control" id="foto_wajah" name="foto_wajah"
                                        accept="image/*" required>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-warning btn-submit">Selanjutnya</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Event Section -->
</main>

<!-- Script Fetch Wilayah -->
<script>
    const baseUrl = "<?= base_url() ?>";

    document.getElementById("id_provinsi").addEventListener("change", function () {
        const idProvinsi = this.value;
        fetch(`${baseUrl}wilayah/kota/${idProvinsi}`)
            .then(response => response.json())
            .then(data => {
                let kotaOptions = '<option value="">-- Pilih Kota/Kabupaten --</option>';
                data.forEach(item => {
                    kotaOptions += `<option value="${item.id_kota}">${item.nama_kota}</option>`;
                });
                document.getElementById("id_kota").innerHTML = kotaOptions;
                document.getElementById("id_kecamatan").innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                document.getElementById("id_desa").innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
            });
    });

    document.getElementById("id_kota").addEventListener("change", function () {
        const idKota = this.value;
        fetch(`${baseUrl}wilayah/kecamatan/${idKota}`)
            .then(response => response.json())
            .then(data => {
                let kecamatanOptions = '<option value="">-- Pilih Kecamatan --</option>';
                data.forEach(item => {
                    kecamatanOptions += `<option value="${item.id_kecamatan}">${item.nama_kecamatan}</option>`;
                });
                document.getElementById("id_kecamatan").innerHTML = kecamatanOptions;
                document.getElementById("id_desa").innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
            });
    });

    document.getElementById("id_kecamatan").addEventListener("change", function () {
        const idKecamatan = this.value;
        fetch(`${baseUrl}wilayah/desa/${idKecamatan}`)
            .then(response => response.json())
            .then(data => {
                let desaOptions = '<option value="">-- Pilih Desa/Kelurahan --</option>';
                data.forEach(item => {
                    desaOptions += `<option value="${item.id_desa}">${item.nama_desa}</option>`;
                });
                document.getElementById("id_desa").innerHTML = desaOptions;
            });
    });
</script>

<?= $this->endSection() ?>