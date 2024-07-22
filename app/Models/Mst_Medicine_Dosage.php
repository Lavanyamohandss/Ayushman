<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_Medicine_Dosage extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'mst_medicine_dosages';
    
    protected $primaryKey = 'medicine_dosage_id';

    protected $fillable = [
        'name',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

}
