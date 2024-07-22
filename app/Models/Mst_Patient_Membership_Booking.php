<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_Patient_Membership_Booking extends Model
{
    use HasFactory;
    protected $table = 'mst__patient__membership__bookings';

    protected $fillable = [
        'patient_id ',
        'membership_package_id ',
        'membership_expiry_date',
        'payment_type',
        'payment_amount',
        'details',
    ];

    public function membershipPackage()
    {
        return $this->belongsTo(Mst_Membership_Package::class,'membership_package_id','membership_package_id');
       
    }
}
