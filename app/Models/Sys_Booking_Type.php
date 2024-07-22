<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sys_Booking_Type extends Model
{
    use HasFactory;
    protected $table = 'sys_booking_types';

    protected $fillable = [
        'booking_type_id',
        'booking_type_name',

    ];
}
