<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_Qualification extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'mst_qualifications';
    
    protected $primaryKey = 'qualification_id';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
}
