<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
    <!-- Content Header -->
    <div class="content">
        <div class="container-fluid">
            <?php
                if (session()->getFlashdata('message')) {
                    echo "<div class='alert alert-success'><marquee>".session()->getFlashdata('message')."</marquee></div>";
                }
            ?>
            <!-- Main content -->
            <div class="row">
                <div class="col-12">
                <!-- Jumlah Data -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $jumlah_siswa->total ?></h3>
                                <p>Siswa</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="/admin/datasiswa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $jumlah_guru->total ?></h3>
                                <p>Guru</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <a href="/admin/dataguru" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $jumlah_kelas->total ?></h3>
                                <p>Kelas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chalkboard"></i>
                            </div>
                            <a href="/admin/datakelas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Jumlah Data -->
                <!-- Tribute Card -->
                <div class="card collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Aplikasi Absensi RFID</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <!-- Deskripsi Aplikasi -->
                        <p>Aplikasi Absensi RFID ini adalah hasil karya dari Fajar Shodiq, seorang mahasiswa yang sedang menyelesaikan studi di Institut Bhakti Nusantara. Aplikasi ini dikembangkan khusus untuk memenuhi kebutuhan absensi di SMK Yasfika Kalirejo, sebagai bagian dari proyek skripsi mahasiswa tersebut.</p>
                        <p><strong>Deskripsi Singkat:</strong></p>
                        <p>Aplikasi Absensi RFID ini merupakan solusi modern untuk manajemen absensi di SMK Yasfika Kalirejo. Dengan menggunakan teknologi RFID (Radio-Frequency Identification), aplikasi ini memungkinkan proses absensi menjadi lebih efisien dan akurat.</p>
                        <!-- Fitur Utama -->
                        <p><strong>Fitur Utama:</strong></p>
                        <ol>
                            <li><strong>Absensi Cepat:</strong> Siswa dapat melakukan absensi hanya dengan menggantungkan kartu RFID mereka ke perangkat yang sesuai, menghemat waktu dan mencegah penipuan absensi.</li>
                            <li><strong>Mengambil Gambar dan Mengirim ke Wali Murid:</strong> Fitur ini memungkinkan pengambilan gambar siswa saat melakukan absensi dan otomatis mengirimkannya ke Wali Murid melalui Telegram sebagai notifikasi kehadiran. Pastikan telah mengonfigurasi API Telegram dan detail pengiriman pesan.</li>
                            <li><strong>Manajemen Kelas:</strong> Aplikasi ini memungkinkan pengelolaan data siswa dan kelas dengan mudah, termasuk penambahan dan penghapusan siswa.</li>
                            <li><strong>Rekam Absensi:</strong> Data absensi siswa tersimpan dengan rapi, memberikan visibilitas yang baik untuk pemantauan kehadiran.</li>
                            <li><strong>Laporan dan Analisis:</strong> Aplikasi menyediakan laporan kehadiran yang dapat diakses dengan mudah untuk evaluasi dan analisis.</li>
                        </ol>
                        <p>Aplikasi ini merupakan wujud komitmen Fajar Shodiq untuk meningkatkan efisiensi dan kualitas manajemen absensi di SMK Yasfika Kalirejo. Semoga aplikasi ini dapat membantu sekolah dalam mencapai tujuan pendidikan yang lebih baik.</p>
                        <p>Terima kasih telah menggunakan Aplikasi Absensi RFID ini!</p>
                    </div>
                </div>

                <!-- Tribute Card -->
                </div>
            </div>
            <!-- Main content -->
        </div>
        <!-- Content Wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
        </aside>
        <!-- Control Sidebar -->

        <!-- Main Footer -->

    </div>

    </div>