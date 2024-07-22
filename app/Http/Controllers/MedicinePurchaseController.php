<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Mst_Supplier;
use App\Models\TrnMedicinePurchaseInvoice;
use App\Models\TrnMedicinePurchaseInvoiceDetails;
use App\Models\TrnLedgerPosting;
use App\Models\Mst_Branch;

class MedicinePurchaseController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageTitle = "Medicine Purchase";
            $account_ledgers = TrnMedicinePurchaseInvoice::join('mst_suppliers', 'trn_medicine_purchase_invoices.supplier_id', 'mst_suppliers.supplier_id')
            ->join('mst_branches', 'trn_medicine_purchase_invoices.branch_id', 'mst_branches.branch_id')
            ->select('trn_medicine_purchase_invoices.purchase_invoice_id', 'trn_medicine_purchase_invoices.invoice_date', 'trn_medicine_purchase_invoices.ledger_name', 'trn_medicine_purchase_invoices.ledger_code', 'trn_medicine_purchase_invoices.is_active', 'trn_medicine_purchase_invoices.account_sub_group_name')
            ->orderBy('trn_medicine_purchase_invoices.created_at', 'desc')
            ->get();
        
                
            return view('medicine_purchase.index', compact('pageTitle'));
        } catch (QueryException $e) {
            return redirect()->route('account.ledger.index')->with('error', 'Something went wrong');
        }
    }

    public function create(Request $request)
    {
        try {
            $pageTitle = "Create Medicine Purchase";
            $suppliers = Mst_Supplier::where('is_active',1)->get();
            $branches = Mst_Branch::where('is_active',1)->get();
            return view('medicine_purchase.create', compact('pageTitle','suppliers','branches'));
        } catch (QueryException $e) {
            return redirect()->route('medicine.purchase.index')->with('error', 'Something went wrong');
        }
    }
}
