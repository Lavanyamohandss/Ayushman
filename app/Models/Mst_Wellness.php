<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_Wellness extends Model
{
    use HasFactory;
    protected $table = 'mst_wellness';

    protected $primaryKey = 'wellness_id';

    public function branch()
    {
        return $this->belongsTo(Mst_Branch::class,'branch_id','branch_id');
    }

    public function branches()
{
    return $this->hasMany(Trn_Wellness_Branch::class, 'wellness_id');
}

}
