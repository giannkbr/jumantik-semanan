<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeltetangga extends Model
{
    protected $table      = 'tetangga';
    protected $primaryKey = 'tetangga_id';
    protected $allowedFields = ['nama_tetangga'];

    //backend
    public function list()
    {
        return $this->table('tetangga')
            ->orderBy('nama_tetangga', 'ASC')
            ->get()->getResultArray();
    }

}
