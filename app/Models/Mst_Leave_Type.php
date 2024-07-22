<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_Leave_Type extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'mst_leave_types';

    protected $primaryKey = 'leave_type_id';

    protected $fillable = [
        'name',
        'is_active',
        'is_dedactable',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
    
}
