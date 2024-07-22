<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_Membership_Package extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'membership_package_id';

    protected $table = 'mst__membership__packages';

    protected $fillable = [
        'package_title',
        'package_duration',
        'package_description',
        'package_price',
        'package_discount_price',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

}
