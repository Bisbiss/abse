<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table      = 'guru';
    protected $primaryKey = 'ID_Guru';
    protected $allowedFields = ['Nama_Guru','Mata_Pelajaran'];
}