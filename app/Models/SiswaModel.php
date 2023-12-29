<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'siswa';
    protected $primaryKey = 'ID_Siswa';
    protected $allowedFields = ['ID_Siswa','Nama_Siswa','NIS','Tanggal_Lahir','Alamat','Jenis_Kelamin','ID_Kelas','foto_siswa','token','chat_id'];
}