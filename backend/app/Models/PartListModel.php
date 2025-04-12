<?php

namespace App\Models;

use CodeIgniter\Model;

class PartListModel extends Model
{
    protected $table            = 'part_lists';
    protected $primaryKey       = 'part_no';  // Karena kita pakai part_no sebagai PK
    protected $allowedFields    = [
        'part_no',
        'job_no',
        'part_name',
        'pack_qty',
        'part_status',
        'routing_process',
        'process',
        'machine_id',
        'uph',
        'model_id',
        'customer_id',
        'created_at',
        'updated_at'
    ];

    // Jika ingin otomatis isi created_at, updated_at:
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
