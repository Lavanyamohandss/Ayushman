<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sys_Gender extends Model
{
    use HasFactory;
    protected $table = 'sys_gender';

    public function gender()
    {
    return $this->hasMany(Mst_Staff::class, 'gender', 'id');
    }

}
