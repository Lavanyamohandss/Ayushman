<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mst_Branch extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='mst_branches';


    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'branch_name',
        'branch_address',
        'is_active',
        'branch_contact_number',
        'branch_email',
        'branch_admin_name',
        'branch_admin_contact_number',
        'latitude',
        'longitude',
        'created_by',
        'deleted_at',
    ];

    protected $attributes = [
       
        'deleted_by' => false,
    ];
    
}
