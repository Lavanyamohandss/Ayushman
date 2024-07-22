<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_Staff_Transfer_Log extends Model
{
    use HasFactory;
    protected $table = 'mst_staff_transfer_logs';

    protected $fillable = [
        'staff_id',
        'transfer_date',
        'branch_id_from',
        'branch_id_to',
        'created_by',
        'updated_by',
    ];
}
