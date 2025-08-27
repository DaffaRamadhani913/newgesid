<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- Cara Daftar Member Section -->
<section id="daftar-member" class="py-5" style="color: #fff;">

    <!-- Section Title -->
    <div class="container text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold" style="font-size: 2.5rem;">
            Cara Daftar Member
            <span class="d-block mx-auto mt-3" style="height: 4px; width: 60px; background-color: #f5b932;"></span>
        </h2>
    </div>
    <!-- End Section Title -->

    <div class="container">
        <div class="row g-4 justify-content-center">

            <!-- Step 1 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="p-4 rounded shadow-sm h-100" style="background-color: #162530;">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="bi bi-1-circle-fill" style="font-size: 2rem; color: #f5b932;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Isi Formulir Pendaftaran Online</h5>
                            <p class="mb-0">Kunjungi halaman pendaftaran dan isi data diri lengkap dengan akurat seperti nama, alamat, kontak, dan informasi lain.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="150">
                <div class="p-4 rounded shadow-sm h-100" style="background-color: #162530;">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="bi bi-2-circle-fill" style="font-size: 2rem; color: #f5b932;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Unggah Dokumen Pendukung</h5>
                            <p class="mb-0">Beberapa jenis keanggotaan mungkin meminta dokumen seperti KTP atau surat rekomendasi.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="p-4 rounded shadow-sm h-100" style="background-color: #162530;">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="bi bi-3-circle-fill" style="font-size: 2rem; color: #f5b932;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Verifikasi Data oleh Tim Kami</h5>
                            <p class="mb-0">Tim kami akan melakukan pengecekan untuk memastikan data valid dan Anda memenuhi syarat.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="250">
                <div class="p-4 rounded shadow-sm h-100" style="background-color: #162530;">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="bi bi-4-circle-fill" style="font-size: 2rem; color: #f5b932;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Aktivasi Keanggotaan</h5>
                            <p class="mb-0">Setelah data dan pembayaran diverifikasi, Anda akan menerima konfirmasi beserta akses member.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="p-4 rounded shadow-sm h-100" style="background-color: #162530;">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="bi bi-5-circle-fill" style="font-size: 2rem; color: #f5b932;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Nikmati Semua Keuntungan</h5>
                            <p class="mb-0">Gunakan status member Anda untuk mengikuti kegiatan, mengakses materi, dan mendapatkan dukungan dari komunitas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="mt-5 text-center fs-5">
            <strong>Jangan tunggu lagi!</strong> Bergabunglah sekarang dan jadilah bagian dari perubahan positif yang membawa manfaat besar untuk Anda dan desa kita.
        </p>
    </div>
</section>
<!-- /Cara Daftar Member Section -->

<?= $this->endSection() ?>