<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sys_Salary_Type extends Model
{
    use HasFactory;
    protected $table = 'sys_salary_types';

    public function salary_type()
    {
    return $this->hasMany(Mst_Staff::class, 'salary_type', 'id');
    }
}
