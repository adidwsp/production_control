<?php

namespace App\Models;

use CodeIgniter\Model;

class MachineModel extends Model
{
    protected $table            = 'machines';
    protected $primaryKey       = 'id';  // Karena kita pakai part_no sebagai PK
    protected $allowedFields    = [
        'id',
        'id_machine',
        'machine_name',
        'line_name',
        'created_at',
        'updated_at'
    ];

    // Jika ingin otomatis isi created_at, updated_at:
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
