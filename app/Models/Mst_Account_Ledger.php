<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Mst_Account_Ledger extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='mst__account__ledgers';

    protected $fillable = [
        'account_sub_group_id',
        'ledger_code',
        'ledger_name',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
