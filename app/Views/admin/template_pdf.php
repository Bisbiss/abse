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


function jumlah_hari($t1 = '', $t2 = '')
{
    $tgl1 = strtotime($t1);
    $tgl2 = strtotime($t2);

    $jarak = $tgl2 - $tgl1;

    $hari = $jarak / 60 / 60 / 24;
    return $hari;
}

function indo_tgl($tgl)
{
    $baru = explode("-", $tgl);
    if ($baru[1] == '01')
        $mo = "Januari";
    if ($baru[1] == '02')
        $mo = "Februari";
    if ($baru[1] == '03')
        $mo = "Maret";
    if ($baru[1] == '04')
        $mo = "April";
    if ($baru[1] == '05')
        $mo = "Mei";
    if ($baru[1] == '06')
        $mo = "Juni";
    if ($baru[1] == '07')
        $mo = "Juli";
    if ($baru[1] == '08')
        $mo = "Agustus";
    if ($baru[1] == '09')
        $mo = "September";
    if ($baru[1] == '10')
        $mo = "Oktober";
    if ($baru[1] == '11')
        $mo = "November";
    if ($baru[1] == '12')
        $mo = "Desember";
    $new = "$baru[2] $mo $baru[0]";

    return $new;
}

$nama_hari  = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");

$query_kelas = "SELECT ID_Kelas, Nama_Kelas FROM kelas WHERE ID_Kelas='$kelas'";
$result_kelas = mysqli_query($conn, $query_kelas);
$row_kelas = mysqli_fetch_assoc($result_kelas);
$nama_kelas = $row_kelas['Nama_Kelas'];

$query_wali_kelas = "SELECT guru.Nama_Guru
FROM kelas
JOIN guru ON kelas.ID_Wali_Kelas = guru.ID_Guru
WHERE kelas.ID_Kelas = '$kelas'";
$result_wali_kelas = mysqli_query($conn, $query_wali_kelas);
$row_wali_kelas = mysqli_fetch_assoc($result_wali_kelas);
$nama_wali_kelas = $row_wali_kelas['Nama_Guru'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        table {
            border-collapse: collapse;
            padding: 10px;

        }

        table.small {
            font-size: 10px;
            /* Sesuaikan ukuran font untuk membuatnya lebih kecil */
        }

        th,
        td {
            padding: 5px;
            /* Sesuaikan padding sel */
            text-align: center;
        }

        .badge {
            padding: 2px 5px;
            /* Sesuaikan padding badge */
            font-size: 10px;
            /* Sesuaikan ukuran font badge */
        }

        /* Tambahkan kelas untuk header yang lebih kecil jika diperlukan */
        .small-header {
            font-size: 14px;
            /* Sesuaikan ukuran font header */
        }

        @media print {

            /* Sembunyikan elemen title */
            title {
                display: none;
            }
        }
    </style>

    <title>Cetak Absensi</title>

<body onload="window.print()">

    <?php
    $sql = "SELECT * FROM identitas";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    ?>
    <center>
        <table width="100%">
            <tr>
                <td style="text-align: right; width: 30px">
                    <img src="<?= base_url() . 'assets/img/yasfika.png' ?>" height="100px">
                </td>
                <td style="margin: 0; padding: 0;">
                    <h3 style="margin: 0;">YAYASAN ASHABUL KAHFI KALIREJO</h3>
                    <h4 style="margin: 0;">SMK YASFIKA KALIREJO KABUPATEN LAMPUNG TENGAH</h4>
                    <h5 style="margin: 0;">KOMPETENSI KEAHLIAN : SIJA - TKRO</h5>
                    <h5 style="margin: 0;">STATUS: TERDAFTAR /NPSN: 70013986</h5>
                    <h4 style="margin: 0;">NOMOR IZIN OPERASI :463/6492/A0000863/V.16/2021</h4>
                    <p style="margin: 0;">Website: https://smkyasfika.sch.id / E-mail: smkyasfikakalirejo@gmail.com</p>
                    <p style="margin: 0; font-size: 12px;">Alamat : jl. Jend. Sudirman Sinarmarga Balairejo Kec.Kalirejo Lampung Tengah Kode Pos :34174</p>
                </td>
            </tr>
        </table>
    </center>
    <hr>
    <center>
        <h5 style="margin: 0;">ABSEN SISWA SEMESTER GANJIL</h5>
        <h5 style="margin: 0;">TAHUN PELAJARAN <?php echo $row['tahun_ajaran'] ?></h5>
    </center>
    <br>
    <table class="small" width="100%">
        <tr>
            <td style="text-align: left;">Kelas : <?php echo $nama_kelas ?></td>
            <td style="text-align: right;">Tanggal : <?php echo $p1 . ' S/d ' . $p2 ?></td>
        </tr>
    </table>
    <?php

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
    echo '<table class="table table-bordered text-xs nowrap small" border="1" width="100%">';
    echo '<thead>';
    echo '<tr>';
    echo '<th rowspan="2">#</th>';
    echo '<th rowspan="2" class="nama-siswa">Nama Siswa</th>';
    echo '<th rowspan="2">L/P</th>';
    for ($day = 0; $day <= $jmlhari; $day++) {
        $date = date("Y-m-d", strtotime("$currentDate +$day day"));
        $dayOfWeek = date("N", strtotime($date));
        $cellColor = ($dayOfWeek == 7) ? ' style="background-color: red;"' : '';

        // Cek apakah tanggal saat ini adalah hari libur
        if (in_array($date, $liburDates)) {
            $cellColor .= ' style="background-color: red;"'; // Tambahkan warna merah jika tanggal adalah hari libur
        }

        echo '<th rowspan="2" style="width: 40px;' . $cellColor . '">' . $nama_hari[date("w", strtotime($date))] . '</th>';
    }

    echo '<th colspan="3">Jumlah</th>';
    echo '</tr>';
    echo '<tr>';




    echo '<th>Sakit</th>';
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
        echo '<td style="text-align: left;">' . $rowSiswa['Nama_Siswa'] . '</td>';
        echo '<td>' . ((isset($rowSiswa['Jenis_Kelamin']) && $rowSiswa['Jenis_Kelamin'] == 'LAKI - LAKI') ? 'L' : 'P') . '</td>';



        $totalSakit = 0;
        $totalIzin = 0;
        $totalAlpha = 0;

        for ($day = 0; $day <= $jmlhari; $day++) {
            $date = date("Y-m-d", strtotime("$currentDate +$day day"));
            $dayOfWeek = date("N", strtotime($date));
            $cellColor = ($dayOfWeek == 7 || in_array($date, $liburDates)) ? ' style="background-color: red;"' : '';

            // Cek apakah tanggal saat ini adalah hari Minggu atau hari libur
            if ($dayOfWeek == 7 || in_array($date, $liburDates)) {
                echo '<td' . $cellColor . '></td>'; // Tanggal kosong untuk hari Minggu atau hari libur
            } else {
                // Query untuk mengambil data absensi sesuai tanggal dan NIS siswa
                $queryAbsensi = "SELECT Keterangan FROM absensi WHERE DATE(Waktu_Absensi) = '$date' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "'";
                $resultAbsensi = $conn->query($queryAbsensi);
                // var_dump($queryAbsensi);

                // Inisialisasi $rowAbsensi
                $rowAbsensi = ['Keterangan' => ''];

                if ($resultAbsensi) {
                    if ($resultAbsensi->num_rows > 0) {
                        $rowAbsensi = $resultAbsensi->fetch_assoc();
                        $badgeColor = '';
                        $label = '';

                        if ($rowAbsensi['Keterangan'] == 'hadir') {
                            $label = '<span style="font-family: Wingdings; font-size: 10px;">ü</span>';
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
                        echo '<td' . $cellColor . '></td>';
                    }
                } else {
                    echo '<td' . $cellColor . '>Error: ' . $conn->error . '</td>';
                }

                // Hitung total sakit, izin, dan alpha di sini
                if ($rowAbsensi['Keterangan'] == 'sakit') {
                    $totalSakit++;
                } elseif ($rowAbsensi['Keterangan'] == 'izin') {
                    $totalIzin++;
                } elseif ($rowAbsensi['Keterangan'] == 'alpha') {
                    $totalAlpha++;
                }
            }
        }

        // // Setelah loop, tampilkan total sakit, izin, dan alpha
        // echo '<td style=" text-align:center;">' . $totalSakit . '</td>';
        // echo '<td style=" text-align:center;">' . $totalIzin . '</td>';
        // echo '<td style=" text-align:center;">' . $totalAlpha . '</td>';




        // $bulansekarang = date('m');
        // $queryAbsensiSakit = "SELECT COUNT(*) AS totalSakit FROM absensi WHERE MONTH(Waktu_Absensi) = '$bulansekarang' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'sakit'";
        // $queryAbsensiIzin = "SELECT COUNT(*) AS totalizin FROM absensi WHERE MONTH(Waktu_Absensi) = '$bulansekarang' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'izin'";
        // $queryAbsensiAlpha = "SELECT COUNT(*) AS totalalpha FROM absensi WHERE MONTH(Waktu_Absensi) = '$bulansekarang' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'alpha'";
        // $resultAbsensiSakit = $conn->query($queryAbsensiSakit);
        // $resultAbsensiizin = $conn->query($queryAbsensiIzin);
        // $resultAbsensialpha = $conn->query($queryAbsensiAlpha);
        // $rowAbsensiSakit = $resultAbsensiSakit->fetch_assoc();
        // $rowAbsensiIzin = $resultAbsensiizin->fetch_assoc();
        // $rowAbsensiAlpha = $resultAbsensialpha->fetch_assoc();
        // $totalSakit += (int)$rowAbsensiSakit['totalSakit'];
        // $totalIzin += (int)$rowAbsensiIzin['totalizin'];
        // $totalAlpha += (int)$rowAbsensiAlpha['totalalpha'];

        echo '<td style=" text-align:center;">' . $totalSakit . '</td>';
        echo '<td style=" text-align:center;">' . $totalIzin . '</td>';
        echo '<td style=" text-align:center;">' . $totalAlpha . '</td>';

        echo '</tr>';
        $nomorUrut++;
    }
    echo '</tbody>';
    echo '</table>';
    ?>
    <br>
    <?php
    $querySiswa = "SELECT * FROM siswa WHERE ID_Kelas='$kelas'";
    $resultSiswa = $conn->query($querySiswa);

    // Inisialisasi variabel jumlah laki-laki dan perempuan
    $jumlahLakiLaki = 0;
    $jumlahPerempuan = 0;

    // Menghitung jumlah laki-laki dan perempuan
    while ($rowSiswa = $resultSiswa->fetch_assoc()) {
        $jenisKelamin = $rowSiswa['Jenis_Kelamin'];
        if ($jenisKelamin == 'LAKI - LAKI') {
            $jumlahLakiLaki++;
        } elseif ($jenisKelamin == 'PEREMPUAN') {
            $jumlahPerempuan++;
        }
    }

    // Menampilkan tabel dengan jumlah laki-laki dan perempuan
    echo '<table class="small" border="1">';
    echo '<tr><td>P</td><td>' . $jumlahPerempuan . '</td></tr>';
    echo '<tr><td>L</td><td>' . $jumlahLakiLaki . '</td></tr>';
    echo '<tr><td>JML</td><td>' . ($jumlahLakiLaki + $jumlahPerempuan) . '</td></tr>';
    echo '</table>';
    ?>
    <table class="small" width="30%" align="left">
        <tr>
            <td align="center">Mengetahui</td>
        </tr>
        <tr>
            <td align="center">Kepala Sekolah</td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
        </tr>
        <tr>
            <td align="center"><strong>Dewi Rahmadani, S.Pd</strong></td>
        </tr>
        <tr>
            <td align="center"></td>
        </tr>
    </table>
    <table class="small" width="30%" align="right">
        <tr>
            <td style="text-align: left;">Kalirejo, <?= indo_tgl(date("Y-m-d")) ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Wali Kelas</td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align: left;"><?= $nama_wali_kelas; ?></td>
        </tr>
    </table>
</body>