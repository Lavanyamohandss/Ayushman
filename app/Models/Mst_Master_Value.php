<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_Master_Value extends Model
{
    use HasFactory;
    protected $table = 'mst_master_values';

    // protected $attributes = [
    //     'group_id' => 0, // Set the default value for the 'group_id' column
    // ];
    public function groupType()
    {
        return $this->belongsTo(Sys_Master::class,'group_id','master_id');
    }

    public function patientGender()
    {
    return $this->belongsTo(Mst_Patient::class,'patient_gender','master_id');
    }

    public function masterValue()
    {
    return $this->belongsTo(Sys_Master::class,'master_id','master_id');
    }

    public function therapyRooms()
    {
    return $this->hasMany(Mst_Therapy_Room::class, 'room_type', 'master_id');
    }

    public function item_type()
    {
    return $this->hasMany(Mst_Medicine::class, 'item_type', 'master_id');
    }

    public function medicine_type()
    {
    return $this->hasMany(Mst_Medicine::class, 'medicine_type', 'master_id');
    }

    public function dosage_form()
    {
    return $this->hasMany(Mst_Medicine::class, 'dosage_form', 'master_id');
    }

    public function Manufacturer()
    {
    return $this->hasMany(Mst_Medicine::class, 'manufacturer', 'master_id');
    }

    public function staff_type()
    {
    return $this->hasMany(Mst_Staff::class, 'staff_type', 'master_id');
    }

    public function employment_type()
    {
    return $this->hasMany(Mst_Staff::class, 'employment_type', 'master_id');
    }

    public function staff_logon_type()
    {
    return $this->hasMany(Mst_Staff::class, 'staff_logon_type', 'master_id');
    }

    public function staff_qualification()
    {
    return $this->hasMany(Mst_Staff::class, 'staff_qualification', 'master_id');
    }

    public function staff_commission_type()
    {
    return $this->hasMany(Mst_Staff::class, 'staff_commission_type', 'master_id');
    }

    public function maritial_status()
    {
    return $this->hasMany(Mst_Patient::class, 'maritial_status', 'master_id');
    }

     public function patient_registration_type()
    {
    return $this->hasMany(Mst_Patient::class, 'patient_registration_type', 'master_id');
    }

    public function week_day()
    {
    return $this->hasMany(Mst_TimeSlot::class, 'week_day', 'master_id');
    }

    public function specialization()
    {
    return $this->hasMany(Mst_Staff_Specialization::class, 'specialization', 'master_id');
    }

    public function users()
    {
        return $this->hasMany(Mst_User::class, 'user_type_id', 'id');
    }
    
}
