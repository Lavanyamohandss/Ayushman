<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TrnMedicinePurchaseInvoice extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'trn_medicine_purchase_invoices';
    
    protected $primaryKey = 'purchase_invoice_id';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'purchase_invoice_no',
        'supplier_id',
        'invoice_date',
        'due_date',
        'branch_id',
        'financial_year_id',
        'notes',
        'terms_and_conditions',
        'sub_total',
        'item_discount',
        'total_tax',
        'total_amount',
        'has_payment',
        'is_settled',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_deleted',
    ];
}
