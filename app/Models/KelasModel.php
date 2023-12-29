<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table      = 'kelas';
    protected $primaryKey = 'ID_Kelas';
    protected $allowedFields = ['Nama_Kelas','ID_Wali_Kelas'];
}