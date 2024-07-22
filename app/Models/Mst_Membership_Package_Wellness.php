<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_Membership_Package_Wellness extends Model
{
    use HasFactory;
    protected $table = 'mst__membership__package__wellnesses';

    protected $fillable = [
        'package_id',
        'wellness_id',
        'maximum_usage_limit',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
