<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section id="bpn-gesid" class="py-5">

    <div style="max-width: 1000px; margin: auto; padding: 20px; font-family: Arial, sans-serif; color: #fff; line-height: 1.6;">

        <!-- Judul Halaman -->
        <h1 data-aos="fade-up" style="text-align: center; font-size: 28px; font-weight: bold; margin-bottom: 10px;">
            Struktur Organisasi BPN GESID
        </h1>

        <!-- Kepemimpinan -->
        <p style="text-align: justify;" data-aos="fade-up" data-aos-delay="100">
            GESID dipimpin oleh sekelompok individu muda yang berdedikasi dan memiliki visi untuk membangun desa-desa di Indonesia menjadi lebih mandiri dan berkelanjutan. Kepemimpinan GESID berfokus pada kolaborasi dan pemberdayaan, memastikan bahwa setiap program yang dijalankan sesuai dengan kebutuhan dan potensi desa.
        </p>

        <!-- Profil Pemimpin -->
        <div data-aos="fade-right" style="display: flex; flex-wrap: wrap; align-items: flex-start; margin-top: 30px; gap: 20px; background-color: #161b22; padding: 20px; border-radius: 8px;">
            <div style="flex: 1; min-width: 250px; display: flex; justify-content: center; align-items: center;">
                <img src="<?= base_url('assets/img/viviana-hanifa.jpg') ?>" alt="Viviana Hanifa"
                    style="width: 100%; max-width: 250px; border-radius: 8px;">
            </div>
            <div style="flex: 3; min-width: 300px;">
                <h3 style="margin-top: 0; color: #f9d342;">Our Leader</h3>
                <p style="margin: 5px 0; font-weight: bold;">Viviana Hanifa</p>
                <p style="text-align: justify;">
                    Viviana Hanifa lahir di sebuah kota kecil di Sungai Pinang yang terletak di Kabupaten Bengkalis, Provinsi Riau, pada 11 Agustus 1998...
                </p>
                <p style="text-align: justify;">
                    Lulus SMA Negeri 1 Mandau pada tahun 2016, Viviana Hanifa melanjutkan pendidikan di Universitas Riau, mengambil jurusan Ilmu Pemerintahan (S1)...
                </p>
                <p style="text-align: justify;">
                    Viviana juga pernah menjadi Wakil Ketua DPR KNPI Riau (2019–2022), Wakasek DPP KNPI (2022–2025), dan Fungsionaris Sekretaris Jenderal (2021–2024)...
                </p>
            </div>
        </div>

        <!-- Struktur Organisasi -->
        <h2 style="text-align: center; margin-top: 40px;" data-aos="fade-up">Struktur Organisasi</h2>

        <!-- Avatar Pengurus -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; margin-top: 20px; text-align: center;">
            <?php
            $pengurus = [
                ['jabatan' => 'Ketua Umum', 'nama' => 'Viviana Hanifa'],
                ['jabatan' => 'Wakil Ketua', 'nama' => 'Nama Wakil'],
                ['jabatan' => 'Sekretaris', 'nama' => 'Nama Sekretaris'],
                ['jabatan' => 'Bendahara', 'nama' => 'Nama Bendahara'],
                ['jabatan' => 'Koordinator Program', 'nama' => 'Nama Koordinator']
            ];
            $delay = 0;
            foreach ($pengurus as $p): ?>
                <div style="background-color: #161b22; padding: 15px; border-radius: 8px;"
                    data-aos="zoom-in" data-aos-delay="<?= $delay ?>">
                    <img src="<?= base_url('assets/img/pengurusbpn/pengurus2.jpg') ?>" alt="<?= $p['jabatan'] ?>"
                        style="width: 100%; height: 150px; object-fit: cover; border-radius: 4px;">
                    <p style="margin-top: 10px; font-weight: bold; color: #fff;"><?= $p['jabatan'] ?></p>
                    <p style="font-size: 14px; color: #bbb;"><?= $p['nama'] ?></p>
                </div>
            <?php $delay += 100;
            endforeach; ?>
        </div>

        <!-- 5 Bidang Utama -->
        <div style="margin-top: 20px;">
            <h3 style="color: #f9d342; font-size: 26px;" data-aos="fade-up">
                <strong>5 Bidang Utama</strong>
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 10px;">
                <div data-aos="fade-up" data-aos-delay="0" style="background-color: #161b22; padding: 15px; border-radius: 8px;">
                    Organisasi, Kaderisasi, dan Keanggotaan<br>
                    <span style="font-size: 15px; color: #bbb;">Bertanggung jawab memastikan keberlanjutan organisasi melalui pengembangan anggota dan kader yang kompeten.</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="100" style="background-color: #161b22; padding: 15px; border-radius: 8px;">
                    Hukum dan HAM<br>
                    <span style="font-size: 15px; color: #bbb;">Menyediakan dukungan hukum dan edukasi HAM untuk melindungi hak-hak warga desa.</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="200" style="background-color: #161b22; padding: 15px; border-radius: 8px;">
                    Politik dan Pemerintahan<br>
                    <span style="font-size: 15px; color: #bbb;">Fokus pada penguatan hubungan pemerintah dan desa...</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="300" style="background-color: #161b22; padding: 15px; border-radius: 8px;">
                    Digital dan Inovasi Desa<br>
                    <span style="font-size: 15px; color: #bbb;">Mengembangkan teknologi terbarukan yang meningkatkan efisiensi dan produktivitas desa.</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="400" style="background-color: #161b22; padding: 15px; border-radius: 8px;">
                    Sosial Masyarakat dan Kebudayaan<br>
                    <span style="font-size: 15px; color: #bbb;">Meningkatkan kehidupan sosial dan budaya untuk membangun komunitas yang harmonis.</span>
                </div>
            </div>
        </div>

        <!-- 5 Bidang Pendukung -->
        <div style="margin-top: 40px;">
            <h3 style="color: #f9d342; font-size: 26px;" data-aos="fade-up">
                <strong>5 Bidang Pendukung</strong>
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 10px;">
                <div data-aos="fade-up" data-aos-delay="0" style="background-color: #161b22; padding: 15px; border-radius: 8px;">
                    Perempuan dan Anak<br>
                    <span style="font-size: 15px; color: #bbb;">Fokus pada program-program yang mendukung kesejahteraan perempuan dan anak di desa.</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="100" style="background-color: #161b22; padding: 15px; border-radius: 8px;">
                    Ekonomi dan Pembangunan<br>
                    <span style="font-size: 15px; color: #bbb;">Meningkatkan kapasitas ekonomi desa untuk kesejahteraan masyarakat.</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="200" style="background-color: #161b22; padding: 15px; border-radius: 8px;">
                    Pemuda dan Olahraga<br>
                    <span style="font-size: 15px; color: #bbb;">Menyediakan sarana dan kegiatan untuk mengembangkan potensi melalui olahraga...</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="300" style="background-color: #161b22; padding: 15px; border-radius: 8px;">
                    Humas dan Antar Lembaga<br>
                    <span style="font-size: 15px; color: #bbb;">Membangun kemitraan strategis dan menjaga informasi publik.</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="400" style="background-color: #161b22; padding: 15px; border-radius: 8px;">
                    Energi dan Sumber Daya Mineral<br>
                    <span style="font-size: 15px; color: #bbb;">Mengelola SDA secara bijak untuk keberlanjutan desa.</span>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>