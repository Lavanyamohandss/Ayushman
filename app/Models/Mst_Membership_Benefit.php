<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_Membership_Benefit extends Model
{
    use HasFactory;

    protected $table = 'mst__membership__benefits';

    protected $fillable = [
        'package_id',
        'title',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
