<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mst_Patient extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'mst_patients';

    protected $fillable = [
        'patient_code',
        'patient_name',
        'patient_email',
        'patient_mobile',
        'patient_address',
        'patient_gender',
        'patient_dob',
        'patient_blood_group_id',
        'available_membership',
        'emergency_contact_person',
        'emergency_contact',
        'maritial_status',
        'patient_medical_history',
        'patient_current_medications',
        'patient_registration_type',
        'password',
        'whatsapp_number',
        'is_active',
        'deleted_at',

    ];

    public function gender()
    {
      return $this->belongsTo(Mst_Master_Value::class,'patient_gender','id');
    }

    public function membership()
    {
      return $this->belongsTo(Mst_Membership::class,'available_membership','id');
    }

    public function bloodGroup()
    {
      return $this->belongsTo(Mst_Master_Value::class,'patient_blood_group_id','id');
    }

    public function maritialStatus()
    {
      return $this->belongsTo(Mst_Master_Value::class,'maritial_status','id');
    }

    public function registrationType()
    {
      return $this->belongsTo(Mst_Master_Value::class,'patient_registration_type','id');
    }



}
