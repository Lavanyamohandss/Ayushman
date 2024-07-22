<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mst_Therapy_Room extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'mst_therapy_rooms';


    protected $fillable = [
        'branch_id',
        'room_name',
        'room_type',
        'room_capacity',
        'is_active',
        'deleted_at',
    ];


    public function branch()
    {
        return $this->belongsTo(Mst_Branch::class,'branch_id','branch_id');
    }

    public function roomType()
    {
    return $this->belongsTo(Mst_Master_Value::class, 'room_type', 'id');
    }

    
}
