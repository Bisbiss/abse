<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table      = 'absensi';
    protected $primaryKey = 'ID_Absensi';
    protected $allowedFields = ['ID_Siswa','Waktu_Absensi','Keterangan','foto_siswa','ID_Hari_Libur'];
}