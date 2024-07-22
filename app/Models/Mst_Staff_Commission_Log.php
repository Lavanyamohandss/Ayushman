<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_Staff_Commission_Log extends Model
{
    use HasFactory;
    protected $table = 'mst_staff_commission_logs';

    protected $fillable = [
        'staff_id',
        'commission_type',
        'staff_commission',
        'commission_change_date',
        'created_by',
    ];
}
