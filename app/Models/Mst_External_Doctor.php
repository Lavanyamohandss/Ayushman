<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mst_External_Doctor extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'mst_external_doctors';

    protected $fillable=[
        'doctor_name',
        'contact_no',
        'contact_email',
        'address',
        'commission',
        'remarks',
        'deleted_at',
    ];


    public function branch()
    {
        return $this->belongsTo(Mst_Branch::class,'branch_id','branch_id');
    }
}
