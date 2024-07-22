<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_Staff_Specialization extends Model
{
    use HasFactory;
    protected $table = 'mst_staff_specializations';


    public function staffSpecialization()
    {
        return $this->belongsTo(Mst_Master_Value::class,'specialization','id');
    }

    public function staff()
    {
        return $this->belongsTo(Mst_Staff::class,'staff_id','staff_id');
    }
}
