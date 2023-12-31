<?php date_default_timezone_set("Asia/Jakarta");

// Informasi koneksi ke basis data
$host = "localhost"; // Lokasi server database (biasanya "localhost")
$username = "root"; // Nama pengguna basis data
$password = ""; // Kata sandi pengguna basis data
$database = "absensi"; // Nama basis data yang akan digunakan

// Membuat koneksi ke basis data
$conn = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi ke basis data gagal: " . mysqli_connect_error());
}
$act = (isset($_GET['act'])) ? $_GET['act'] : '';
$tglrange = (isset($_GET['tgl'])) ? $_GET['tgl'] : '';
$kelas = (isset($_GET['kelas'])) ? $_GET['kelas'] : '';
$cari = (isset($_GET['cari'])) ? $_GET['cari'] : '';

$date = explode(" - ", $tglrange);

// Memeriksa apakah $date memiliki setidaknya dua elemen
if (isset($date[0]) && isset($date[1])) {
    $p1 = date("Y-m-d", strtotime($date[0]));
    $p2 = date("Y-m-d", strtotime($date[1]));
} else {
    // Handle kasus di mana $tglrange tidak sesuai dengan ekspektasi
    // Menggunakan nilai default atau tindakan lainnya
    $p1 = date("Y-m-d"); // Nilai default bisa berupa tanggal sekarang atau yang lain sesuai kebutuhan
    $p2 = date("Y-m-d"); // Nilai default bisa berupa tanggal sekarang atau yang lain sesuai kebutuhan
    // Atau, Anda dapat melakukan tindakan lain yang sesuai dengan logika aplikasi Anda.
}

function jumlah_hari($t1 = '', $t2 = '')
{
    $tgl1 = strtotime($t1);
    $tgl2 = strtotime($t2);

    $jarak = $tgl2 - $tgl1;

    $hari = $jarak / 60 / 60 / 24;
    return $hari;
}

$nama_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Laporan</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            padding: 10px;
            /* Menambahkan ruang padding di sekitar tabel */
            margin: 0;
        }

        .tbl-head {
            vertical-align: middle;
        }

        th,
        td {
            font-size: 12px;
            /* Mengurangi ukuran teks dalam sel */
            padding: 5px;
        }

        thead>tr:nth-child(1)>th:nth-child(1) {
            background-color: none;
            text-align: center;
            vertical-align: middle;
            align-items: center;
        }

        thead>tr:nth-child(1)>th:nth-child(2) {
            background-color: none;
            text-align: center;
            min-width: 150px;
            vertical-align: middle;
            align-items: center;
        }

        thead>tr:nth-child(1)>th:nth-child(3) {
            background-color: none;
            text-align: center;
            vertical-align: middle;
            align-items: center;
        }

        thead>tr:nth-child(1)>th:nth-child(4) {
            background-color: none;
            text-align: center;
            vertical-align: middle;
            align-items: center;
        }

        thead>tr:nth-child(1)>th:nth-child(5) {
            background-color: none;
            text-align: center;
            vertical-align: middle;
            align-items: center;
        }

        thead>tr:nth-child(1)>th:nth-child(6) {
            background-color: none;
            text-align: center;
            vertical-align: middle;
            align-items: center;
        }


        thead>tr:nth-child(2)>th {
            background-color: none;
        }

        @media (max-width: 600px) {
            table {
                width: 100%;
                /* Mengatur ulang lebar tabel untuk tampilan seluler */
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Laporan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Data Laporan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            // ...

                                            // Mengambil nama bulan sekarang

                                            echo '<h3 class="card-title">Data Laporan Absensi</h3>';

                                            // ...
                                            ?>
                                        </div>
                                        <div class="col-md-6 text-right">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body overflow-auto">
                                    <?php if ($act == '') { ?>
                                        <form method="GET" id="frmlap">
                                            <div class="col-md-12 row">
                                                <div class="col-md-5">
                                                    <div class="form-group row">
                                                        <label class="aria-label col-md-4">Range Tanggal</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control " name="tgl" id="reservation" value="<?= $tglrange ?>">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 control-label ">Kelas </label>
                                                        <div class="col-md-8">
                                                            <select name="kelas" class="form-control select2 " style="width: 100%;">
                                                                <option value="User" selected="selected">-- Pilih Kelas --</option>
                                                                <?php
                                                                $query_kelas = "SELECT ID_Kelas, Nama_Kelas FROM kelas";
                                                                $result_kelas = mysqli_query($conn, $query_kelas);
                                                                while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                                                                    $sel = ($kelas == $row_kelas['ID_Kelas']) ? 'selected' : '';
                                                                    echo '<option value="' . $row_kelas['ID_Kelas'] . '" ' . $sel . '>' . $row_kelas['Nama_Kelas'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="hidden" name="cari" value="cr">
                                                    <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                                                    <button type="button" class="btn btn-primary" onclick="cetak_absen()"><i class="fas fa-print"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php } ?>
                                    <div class="table-responsive">
                                        <?php
                                        if ($cari == 'cr') {

                                            $querySiswa = "SELECT * FROM siswa WHERE ID_Kelas='$kelas' ORDER BY Nama_Siswa ASC";
                                            $resultSiswa = $conn->query($querySiswa);
                                            //query hari libur
                                            $queryLibur = "SELECT tanggal FROM hari_libur";
                                            $resultLibur = $conn->query($queryLibur);
                                            $liburDates = [];

                                            if ($resultLibur->num_rows > 0) {
                                                while ($rowLibur = $resultLibur->fetch_assoc()) {
                                                    $liburDates[] = $rowLibur['tanggal'];
                                                }
                                            }
                                            /*$str = $p1;
                                            $date = DateTime::createFromFormat('d/m/Y', $str);*/
                                            $currentDate = $p1;
                                            // Mengambil tanggal sekarang
                                            // $currentDate = date('Y-m-d');
                                            // Mengambil nama bulan sekarang
                                            $currentMonth = date('F');
                                            // Menghitung jumlah hari dalam bulan ini
                                            $daysInMonth = date('t');
                                            $jmlhari = jumlah_hari($p1, $p2);
                                            $jhari = intval($jmlhari) + 1;
                                            // var_dump($jhari);
                                            echo '<table class="table table-bordered text-xs nowrap">';
                                            echo '<thead>';
                                            echo '<tr>';
                                            echo '<th rowspan="2">#</th>';
                                            echo '<th rowspan="2" class="nama-siswa">Nama Siswa</th>';
                                            echo '<th rowspan="2">NIS</th>';
                                            echo '<th rowspan="2">L/P</th>';
                                            echo '<th colspan="' . $jhari . '" text-align:center;>Tanggal</th>';
                                            echo '<th colspan="5">Jumlah</th>';



                                            echo '</tr>';
                                            echo '<tr>';


                                            for ($day = 0; $day <= $jmlhari; $day++) {
                                                $date = date("Y-m-d", strtotime("$currentDate +$day day"));
                                                $dayOfWeek = date("N", strtotime($date));
                                                $cellColor = ($dayOfWeek == 7) ? ' style="background-color: red;"' : '';

                                                // Cek apakah tanggal saat ini adalah hari libur
                                                if (in_array($date, $liburDates)) {
                                                    $cellColor .= ' style="background-color: red;"'; // Tambahkan warna merah jika tanggal adalah hari libur
                                                }

                                                echo '<th' . $cellColor . '>' . $nama_hari[date("w", strtotime($date))] . '</th>';
                                            }
                                            echo '<th >Hadir</th>';
                                            echo '<th >Sakit</th>';
                                            echo '<th >Izin</th>';
                                            echo '<th >Alpha</th>';
                                            echo '</tr>';
                                            echo '<tr>';
                                            echo '</tr>';
                                            echo '</thead>';
                                            echo '<tbody>';
                                            $nomorUrut = 1;
                                            while ($rowSiswa = $resultSiswa->fetch_assoc()) {
                                                echo '<tr>';
                                                echo '<td>' . $nomorUrut . '</td>';
                                                echo '<td>' . $rowSiswa['Nama_Siswa'] . '</td>';
                                                echo '<td>' . $rowSiswa['NIS'] . '</td>';
                                                // Ganti baris berikut di dalam loop while
                                                echo '<td>' . (isset($rowSiswa['Jenis_Kelamin']) ? ($rowSiswa['Jenis_Kelamin'] == 'LAKI - LAKI' ? 'L' : 'P') : '') . '</td>';


                                                $totalSakit = 0;
                                                $totalIzin = 0;
                                                $totalAlpha = 0;
                                                $totalHadir = 0;

                                                // Mengisi sel data absensi dengan loop
                                                // ...

                                                for ($day = 0; $day <= $jmlhari; $day++) {
                                                    $date = date("Y-m-d", strtotime("$currentDate +$day day"));
                                                    $dayOfWeek = date("N", strtotime($date));
                                                    $cellColor = ($dayOfWeek == 7 || in_array($date, $liburDates)) ? ' style="background-color: red;"' : '';

                                                    // Cek apakah tanggal saat ini adalah hari Minggu atau hari libur
                                                    if ($dayOfWeek == 7 || in_array($date, $liburDates)) {
                                                        echo '<td' . $cellColor . '></td>'; // Tanggal kosong untuk hari Minggu atau hari libur
                                                    } else {
                                                        // Query untuk mengambil data absensi sesuai tanggal dan NIS siswa
                                                        $queryAbsensi = "SELECT Keterangan FROM absensi WHERE DATE(Waktu_Absensi) = '$date' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' ";
                                                        $resultAbsensi = $conn->query($queryAbsensi);
                                                        // var_dump($queryAbsensi);
                                                        if ($resultAbsensi) {
                                                            if ($resultAbsensi->num_rows > 0) {
                                                                $rowAbsensi = $resultAbsensi->fetch_assoc();
                                                                $badgeColor = '';
                                                                $label = '';

                                                                if ($rowAbsensi['Keterangan'] == 'hadir') {
                                                                    $badgeColor = 'badge-success';
                                                                    $label = 'H';
                                                                } elseif ($rowAbsensi['Keterangan'] == 'izin') {
                                                                    $badgeColor = 'badge-warning';
                                                                    $label = 'I';
                                                                } elseif ($rowAbsensi['Keterangan'] == 'sakit') {
                                                                    $badgeColor = 'badge-secondary';
                                                                    $label = 'S';
                                                                } elseif ($rowAbsensi['Keterangan'] == 'alpha') {
                                                                    $badgeColor = 'badge-danger';
                                                                    $label = 'A';
                                                                }

                                                                echo '<td' . $cellColor . '><span class="badge ' . $badgeColor . '">' .  $label . '</span></td>';
                                                            } else {
                                                                echo '<td' . $cellColor . '>?</td>';
                                                            }
                                                        } else {
                                                            echo '<td' . $cellColor . '>Error: ' . $conn->error . '</td>';
                                                        }
                                                    }
                                                }



                                                $bulansekarang = date('m');
                                                $queryAbsensiSakit = "SELECT COUNT(*) AS totalSakit FROM absensi WHERE  date(Waktu_Absensi) BETWEEN '$p1' AND '$p2'  AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'sakit'";
                                                $queryAbsensiIzin = "SELECT COUNT(*) AS totalizin FROM absensi WHERE  date(Waktu_Absensi) BETWEEN '$p1' AND '$p2' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'izin'";
                                                $queryAbsensiHadir = "SELECT COUNT(*) AS totalhadir FROM absensi WHERE  date(Waktu_Absensi) BETWEEN '$p1' AND '$p2' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'hadir'";
                                                $queryAbsensiAlpha = "SELECT COUNT(*) AS totalalpha FROM absensi WHERE  date(Waktu_Absensi) BETWEEN '$p1' AND '$p2' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'alpha'";
                                                $resultAbsensiSakit = $conn->query($queryAbsensiSakit);
                                                $resultAbsensiizin = $conn->query($queryAbsensiIzin);
                                                $resultAbsensihadir = $conn->query($queryAbsensiHadir);
                                                $resultAbsensialpha = $conn->query($queryAbsensiAlpha);
                                                $rowAbsensiSakit = $resultAbsensiSakit->fetch_assoc();
                                                $rowAbsensiIzin = $resultAbsensiizin->fetch_assoc();
                                                $rowAbsensiHadir = $resultAbsensihadir->fetch_assoc();
                                                $rowAbsensiAlpha = $resultAbsensialpha->fetch_assoc();
                                                $totalSakit += (int)$rowAbsensiSakit['totalSakit'];
                                                $totalIzin += (int)$rowAbsensiIzin['totalizin'];
                                                $totalHadir += (int)$rowAbsensiHadir['totalhadir'];
                                                $totalAlpha += (int)$rowAbsensiAlpha['totalalpha'];


                                                echo '<td style=" text-align:center;">' . $totalHadir . '</td>';
                                                echo '<td style=" text-align:center;">' . $totalSakit . '</td>';
                                                echo '<td style=" text-align:center;">' . $totalIzin . '</td>';
                                                echo '<td style=" text-align:center;">' . $totalAlpha . '</td>';

                                                echo '</tr>';
                                                $nomorUrut++;
                                            }
                                            echo '</tbody>';
                                            echo '</table>';
                                        ?>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>


    <script>
        var date2 = new Date();
        date2.setDate(date2.getDate());
        $('#reservation').daterangepicker({
            startDate: moment().subtract(5, 'days'),
            maxDate: date2,
            dateLimit: {
                days: 5
            }

        })


        $(function() {
            $('.select2').select2();
        })

        function cetak_absen() {
            $.ajax({
                url: 'cetak_laporan.php',
                data: $('#frmlap').serialize(),
                type: 'GET',
                dataType: 'html',
                success: function(respon) {
                    /$("#load").html(respon);/
                    var doc = window.open();
                    doc.document.write(respon);
                    doc.print();
                }
            })
        }
    </script>
</body>

</html>