<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_Account_Sub_Head extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='mst_account_sub_head';


    protected $primaryKey = 'id';

    protected $fillable = [
        'account_group_id',
        'account_sub_group_name',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
