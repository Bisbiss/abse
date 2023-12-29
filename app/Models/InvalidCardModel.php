<?php

namespace App\Models;

use CodeIgniter\Model;

class invalidCardModel extends Model
{
    protected $table      = 'invalid_card';
    protected $primaryKey = 'id_card';
    protected $allowedFields = ['id_card','waktu'];
}