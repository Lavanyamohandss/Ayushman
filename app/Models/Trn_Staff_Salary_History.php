<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trn_Staff_Salary_History extends Model
{
    use HasFactory;
    protected $table = 'trn_staff_salary_history';

    protected $fillable = [
        'staff_id',
        'old_salary',
        'new_salary',
        'updated_date',
        'created_by',
    ];
}
