<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trn_Consultation_Booking extends Model
{
    use HasFactory;
    protected $table = 'trn_consultation_bookings';

    protected $fillable = [
        'booking_reference_number',
        'booking_type_id',
        'patient_id',
        'doctor_id',

    ];


    public function bookingType()
    {
        return $this->belongsTo(Sys_Booking_Type::class, 'booking_type_id', 'booking_type_id');
    }

    public function patient()
    {
        return $this->belongsTo(Mst_Patient::class, 'patient_id', 'id');
    }
    
    public function doctor()
    {
        return $this->belongsTo(Mst_User::class, 'doctor_id', 'id');
    }

    public function branch()
   {
    return $this->belongsTo(Mst_Branch::class, 'branch_id', 'branch_id');
   }

    public function timeSlot()
    {
        return $this->belongsTo(Mst_TimeSlot::class, 'time_slot_id', 'id');
    }

    public function bookingStatus()
    {
        return $this->belongsTo(Sys_Booking_Status::class, 'booking_status_id', 'id');
    }

    public function availability()
    {
        return $this->belongsTo(Booking_Availability::class, 'availability_id', 'id');
    }

    public function therapy()
    {
        return $this->belongsTo(Mst_Therapy::class, 'therapy_id', 'id');
    }

    public function wellness()
    {
        return $this->belongsTo(Mst_Wellness::class, 'wellness_id', 'id');
    }

    public function externalDoctor()
    {
        return $this->belongsTo(Mst_External_Doctor::class, 'external_doctor_id', 'id');
    }

    public function familyMember()
    {
        return $this->belongsTo(Trn_Patient_Family_Member::class, 'family_member_id', 'id');
    }
}
