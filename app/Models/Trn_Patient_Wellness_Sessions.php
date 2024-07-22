<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trn_Patient_Wellness_Sessions extends Model
{
    use HasFactory;

    protected $table = 'trn__patient__wellness__sessions';

    protected $fillable = [
        'membership_patient_id',
        'wellness_id',
        'created_by',
        'updated_by',
    ];
}
