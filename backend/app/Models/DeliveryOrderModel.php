<?php

namespace App\Models;

use CodeIgniter\Model;

class DeliveryOrderModel extends Model
{
    protected $table            = 'deliveries';
    protected $primaryKey       = 'id';  // Karena kita pakai part_no sebagai PK
    protected $allowedFields    = [
        'id',
        'part_no',
        'delivery_date',
        'delivery_qty',
        'created_at',
        'updated_at'
    ];

    // Jika ingin otomatis isi created_at, updated_at:
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
