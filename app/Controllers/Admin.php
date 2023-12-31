<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\GuruModel;
use App\Models\InvalidCardModel;
use PHPExcel;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $data = [
            'title' => 'Home',
            'jumlah_siswa' => $db->query("SELECT COUNT(id_siswa) as total FROM siswa")->getRow(),
            'jumlah_guru' => $db->query("SELECT COUNT(id_guru) as total FROM guru")->getRow(),
            'jumlah_kelas' => $db->query("SELECT COUNT(id_kelas) as total FROM kelas")->getRow(),
        ];
        echo view('admin/layout/header', $data);
        echo view('admin/layout/navigation');
        echo view('admin/home');
        echo view('admin/layout/footer');
    }

    public function dataSiswa()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $data = [
            'title' => 'Data Siswa',
            'data' => $db->query("SELECT s.*, k.Nama_Kelas,k.ID_Kelas FROM siswa s JOIN kelas k ON s.ID_Kelas = k.ID_Kelas ORDER BY s.Nama_Siswa")->getResult(),
        ];
        echo view('admin/layout/header', $data);
        echo view('admin/layout/navigation');
        echo view('admin/data_siswa');
        echo view('admin/layout/footer');
    }

    public function tambahDataSiswa()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $siswa = new SiswaModel();
        $img = $this->request->getFile('foto');
        // dd($img);
        if (!$img->hasMoved()) {
            $newName = $img->getRandomName();
            $filepath = ROOTPATH . 'public/assets/absen/siswa/';
            $img->move($filepath, $newName);
            $data = [
                'ID_Siswa' => $this->request->getPost('id_siswa'),
                'Nama_Siswa' => $this->request->getPost('nama'),
                'NIS' => $this->request->getPost('nis'),
                'Tanggal_Lahir' => $this->request->getPost('date'),
                'Alamat' => $this->request->getPost('alamat'),
                'Jenis_Kelamin' => $this->request->getPost('jenis_kelamin'),
                'ID_Kelas' => $this->request->getPost('kelas'),
                'foto_siswa' => $newName,
            ];

            $tambah = $siswa->insert($data);
            if ($tambah) {
                return redirect()->back()->with('success', 'Berhasil Tambah Data!');
            } else {
                return redirect()->back()->with('failed', 'Gagal Tambah Data!');
            }
        } else {
            return redirect()->back()->with('failed', 'Gagal Upload Foto!');
        }
    }

    public function ubahDataSiswa()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $siswa = new SiswaModel();
        $ID_Siswa = $this->request->getPost('ID_Siswa');
        $data = [
            'Nama_Siswa' => $this->request->getPost('nama'),
            'NIS' => $this->request->getPost('nis'),
            'Tanggal_Lahir' => $this->request->getPost('date'),
            'Alamat' => $this->request->getPost('alamat'),
            'Jenis_Kelamin' => $this->request->getPost('jenis_kelamin'),
            'ID_Kelas' => $this->request->getPost('kelas'),
        ];

        $ubah = $siswa->update($ID_Siswa, $data);
        if ($ubah) {
            return redirect()->back()->with('success', 'Berhasil Ubah Data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Ubah Data!');
        }
    }

    public function hapusDataSiswa($ID_Siswa = NULL)
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $siswa = new SiswaModel();
        $hapus = $siswa->delete($ID_Siswa);
        if ($hapus) {
            return redirect()->back()->with('success', 'Berhasil Hapus Data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Hapus Data!');
        }
    }

    public function importSiswa()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $data = [
            'title' => 'Import Siswa',
        ];
        echo view('admin/layout/header', $data);
        echo view('admin/layout/navigation');
        echo view('admin/import_siswa');
        echo view('admin/layout/footer');
    }

    public function importFileSiswa()
    {
        $siswa = new SiswaModel();
        $file = $this->request->getFile('fileSiswa');
        $ext = $file->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $data_insert = array();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }
            $data_insert[] = array(
                "Nama_Siswa" => $row[0],
                "NIS" => $row[1],
                "ID_Kelas" => $row[2],
                "Tanggal_Lahir" => $row[3],
                "Alamat" => $row[4],
            );
        }

        $tambah = $siswa->insertBatch($data_insert);
        if ($tambah) {
            return redirect()->back()->with('success', 'Behasil Tambah Kelas!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Tambah Kelas!');
        }
    }

    public function dataKelas()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $data = [
            'title' => 'Data Kelas',
            'data' => $db->query("SELECT kelas.*,guru.Nama_Guru FROM kelas JOIN guru ON kelas.ID_Wali_Kelas=guru.ID_Guru")->getResult(),
        ];
        echo view('admin/layout/header', $data);
        echo view('admin/layout/navigation');
        echo view('admin/data_kelas');
        echo view('admin/layout/footer');
    }

    public function tambahDataKelas()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $kelas = new KelasModel();
        $data = [
            'Nama_Kelas' => $this->request->getPost('nama_kelas'),
            'ID_Wali_Kelas' => $this->request->getPost('wali_kelas'),
        ];
        $tambah = $kelas->insert($data);
        if ($tambah) {
            return redirect()->back()->with('success', 'Behasil Tambah Kelas!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Tambah Kelas!');
        }
    }

    public function ubahDataKelas()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $kelas = new KelasModel();
        $ID_Kelas = $this->request->getPost('ID_Kelas');
        $data = [
            'Nama_Kelas' => $this->request->getPost('nama_kelas'),
            'ID_Wali_Kelas' => $this->request->getPost('wali_kelas'),
        ];
        $ubah = $kelas->update($ID_Kelas, $data);
        if ($ubah) {
            return redirect()->back()->with('success', 'Behasil Ubah Kelas!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Ubah Kelas!');
        }
    }

    public function hapusDataKelas($ID_Kelas = NULL)
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $kelas = new KelasModel();
        $hapus = $kelas->delete($ID_Kelas);
        if ($hapus) {
            return redirect()->back()->with('success', 'Berhasil Hapus Data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Hapus Data!');
        }
    }

    public function dataGuru()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $data = [
            'title' => 'Data Guru',
            'data' => $db->query("SELECT * FROM guru")->getResult(),
        ];
        echo view('admin/layout/header', $data);
        echo view('admin/layout/navigation');
        echo view('admin/data_guru');
        echo view('admin/layout/footer');
    }

    public function tambahDataGuru()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $guru = new GuruModel();
        $data = [
            'Nama_Guru' => $this->request->getPost('nama_guru'),
            'Mata_Pelajaran' => $this->request->getPost('mata_pelajaran'),
        ];
        $tambah = $guru->insert($data);
        if ($tambah) {
            return redirect()->back()->with('success', 'Behasil Tambah Kelas!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Tambah Kelas!');
        }
    }

    public function ubahDataGuru()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $guru = new GuruModel();
        $ID_Guru = $this->request->getPost('id_guru');
        $data = [
            'Nama_Guru' => $this->request->getPost('nama_guru'),
            'Mata_Pelajaran' => $this->request->getPost('mata_pelajaran'),
        ];
        $ubah = $guru->update($ID_Guru, $data);
        if ($ubah) {
            return redirect()->back()->with('success', 'Behasil Ubah Data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Ubah Data!');
        }
    }

    public function hapusDataGuru($ID_Guru = NULL)
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $guru = new GuruModel();
        $hapus = $guru->delete($ID_Guru);
        if ($hapus) {
            return redirect()->back()->with('success', 'Berhasil Hapus Data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Hapus Data!');
        }
    }

    public function dataAbsen()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $data = [
            'title' => 'Data Absen',
            'data' => $db->query("SELECT absensi.*, siswa.Nama_Siswa,siswa.Jenis_Kelamin,siswa.NIS,kelas.Nama_Kelas FROM absensi JOIN siswa ON absensi.ID_Siswa=siswa.ID_Siswa JOIN kelas ON siswa.ID_Kelas=kelas.ID_Kelas")->getResult(),
        ];
        echo view('admin/layout/header', $data);
        echo view('admin/layout/navigation');
        echo view('admin/data_absen');
        echo view('admin/layout/footer');
    }

    public function belumAbsen()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }

        $query = "SELECT siswa.*, kelas.Nama_Kelas
              FROM siswa
              JOIN kelas ON siswa.ID_Kelas = kelas.ID_Kelas
              LEFT JOIN absensi ON siswa.ID_Siswa = absensi.ID_Siswa AND DATE(absensi.Waktu_Absensi) = CURDATE()
              WHERE absensi.ID_Absensi IS NULL";

        $data = [
            'title' => 'Belum Absensi',
            'data' => $db->query($query)->getResult(),
        ];

        echo view('admin/layout/header', $data);
        echo view('admin/layout/navigation');
        echo view('admin/belum_absen');
        echo view('admin/layout/footer');
    }

    public function presensi()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }

        $namaSiswa = $this->request->getPost('Nama_Siswa');

        $presensi = new AbsensiModel();
        $data = [
            'ID_Siswa' => $this->request->getPost('ID_Siswa'),
            'Waktu_Absensi' => date('Y-m-d H:i:s'), // Periksa nama kolom yang benar
            'Keterangan' => $this->request->getPost('Keterangan'),
        ];

        $tambah = $presensi->insert($data);
        if ($tambah) {
            return redirect()->back()->with('success', $namaSiswa . ' Berhasil Presensi!');
        } else {
            return redirect()->back()->with('failed', $namaSiswa . 'Gagal Presensi! ' . $presensi->error());
        }
    }



    public function invalidCard()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $data = [
            'title' => 'Invalid Card',
            'data' => $db->query("SELECT * FROM `invalid_card`")->getResult(),
        ];
        echo view('admin/layout/header', $data);
        echo view('admin/layout/navigation');
        echo view('admin/invalid_card');
        echo view('admin/layout/footer');
    }

    public function convertInvalidCard()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $siswa = new SiswaModel();
        $card = new InvalidCardModel();
        $id_card = $this->request->getPost('id_siswa');
        $data = [
            'ID_Siswa' => $id_card,
            'Nama_Siswa' => $this->request->getPost('nama'),
            'NIS' => $this->request->getPost('nis'),
            'Tanggal_Lahir' => $this->request->getPost('date'),
            'Alamat' => $this->request->getPost('alamat'),
            'Jenis_Kelamin' => $this->request->getPost('jenis_kelamin'),
            'ID_Kelas' => $this->request->getPost('kelas'),
        ];

        $tambah = $siswa->insert($data);
        if ($tambah) {
            $card->delete($id_card);
            return redirect()->back()->with('success', 'Berhasil Tambah Data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Tambah Data!');
        }
    }

    public function laporan()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $data = [
            'title' => 'Laporan'
        ];
        echo view('admin/layout/header', $data);
        echo view('admin/layout/navigation');
        echo view('admin/laporan');
        echo view('admin/layout/footer');
    }

    public function pengaturan()
    {
        $db = db_connect();
        $session = session();
        if ($session->get('level') != 'admin') {
            return redirect()->to('/')->with('message', 'Gagal Memuat Halaman!');
        }
        $data = [
            'title' => 'Pengaturan Sekolah',
            'data' => $db->query("SELECT * FROM `identitas`")->getRow(),
        ];
        echo view('admin/layout/header', $data);
        echo view('admin/layout/navigation');
        echo view('admin/pengaturan_sekolah');
        echo view('admin/layout/footer');
    }
}
