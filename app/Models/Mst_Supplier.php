<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mst_Supplier extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'mst_suppliers';
    protected $primaryKey = 'supplier_id';

    protected $fillable = [
       'supplier_id ',
       'supplier_type_id',
       'supplier_code',
       'supplier_name',
       'supplier_address',
       'supplier_city',
       'state',
       'country',
       'pincode',
       'business_name',
       'phone_1',
       'phone_2',
       'email',
       'website',
       'GSTNO',
       'gst_treatment',
       'credit_period',
       'credit_limit',
       'opening_balance',
       'opening_balance_type',
       'is_active',
       'account_ledger_id',
       'terms_and_conditions',
       'opening_balance_date',
       'deleted_at',
    ];
}
