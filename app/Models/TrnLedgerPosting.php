<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TrnLedgerPosting extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'trn_ledger_postings';
    
    protected $primaryKey = 'ledger_posting_id';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'posting_date',
        'voucher_type_id',
        'master_id',
        'account_ledger_id',
        'debit',
        'credit',
        'branch_id',
        'transaction_amount',
        'narration',
    ];
}
