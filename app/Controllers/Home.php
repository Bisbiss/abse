<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\InvalidCardModel;
use App\Controllers\Telegram;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function login()
    {
        $session = session();
        $db = db_connect();
        $user = new UsersModel();

        $username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));
        $cek = $user->where('username',$username)
                    ->where('password', $password)
                    ->find();
        if(!$cek){
            return redirect()->back()->with('message', 'Data Tidak Ditemukan!');
        }else{
            $user_session = [
                'username' => $username,
                'nama_lengkap' => $cek[0]['nama_lengkap'],
                'level' => $cek[0]['level'],
            ];
            $session->set($user_session);
            return redirect()->to('/admin')->with('message', 'Selamat Datang '.$cek[0]['nama_lengkap']);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    public function absensi()
    {
        $db = db_connect();
        $absensi = new AbsensiModel();
        $this->validate([
            'imageFile' => 'uploaded[imageFile]|mime_in[imageFile,image/png,image/jpeg]',
        ]);
        $id_siswa =  intval($this->request->getPost('textData'));
        $img = $this->request->getFile('imageFile');
        if (!$img->hasMoved()) {
            $newName = $img->getRandomName();
            $filepath = ROOTPATH.'public/assets/absen/capture/';
            $img->move($filepath,$newName);
            $cek = $db->query('SELECT Nama_Siswa FROM siswa WHERE ID_Siswa='.$id_siswa)->getRow();
            if($cek){
                $data = [
                    'ID_Siswa' => $id_siswa,
                    'Waktu_Absensi' => date('Y-m-d H:i:s'),
                    'Keterangan' => 'hadir',
                    'foto_siswa' => $newName,
                    'ID_Hari_Libur' => NULL
                ];
                $tambah = $absensi->insert($data);
                if($tambah){
                    $telegram = new Telegram();
                    echo "Berhasil Absen";
                    $telegram->send($newName,$cek->Nama_Siswa);
                }else{
                    echo "Gagal Absen";
                }
            }else{
                $dataInvalid = [
                    'id_card' => $id_siswa,
                    'waktu' => date('Y-m-d H:i:s')
                ];
                $invalid = new InvalidCardModel();
                $invalid->insert($dataInvalid);
                echo "Data Tidak Ditemukan";
            }
        }
    }
}
