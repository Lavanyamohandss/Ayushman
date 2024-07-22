<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mst_Tax;
use App\Models\Mst_Tax_Group_Included_Taxes;
use App\Models\Mst_Tax_Group;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class MstTaxGroupController extends Controller
{
    public function index()
    {
        try {
            $pageTitle = "Tax Groups";
            $taxes = [];
            $tax_groups = Mst_Tax_Group::get();
            foreach ($tax_groups as $tax) {
                $included_tax_ids = Mst_Tax_Group_Included_Taxes::where('tax_group_id', $tax->id)->pluck('included_tax')->toArray();
                $rate = Mst_Tax::whereIn('id', $included_tax_ids)->pluck('tax_rate')->toArray();
                $rateSum = array_sum($rate);
                $taxes[] = [
                    'id' => $tax->id,
                    'tax_group_name' => $tax->tax_group_name,
                    'rate' => $rateSum,
                ];
            }
            return view('tax-group.index', compact('pageTitle', 'taxes'));
        } catch (QueryException $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $pageTitle = "Create Tax Groups";
            $taxes = Mst_Tax::where('is_active',1)->get();
            return view('tax-group.create', compact('pageTitle', 'taxes'));
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', 'Something went wrong');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tax_group_name' => 'required',
                'included_tax' => 'required',
            ]);

            $is_exists = Mst_Tax_Group::where('tax_group_name', $request->tax_group_name)->first();
            if (!$is_exists) {
                $lastInsertedId = Mst_Tax_Group::insertGetId([
                    'tax_group_name' => $request->tax_group_name,
                    'is_active' => 1,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                return redirect()->route('tax.group.index')->with('error', 'This group name is already taken.');
            }

            if (count($request->included_tax) > 0) {
                $i = 0;
                for ($i = 0; $i < count($request->included_tax); $i++) {
                    $checkWellness = Mst_Tax_Group_Included_Taxes::where('tax_group_id', $lastInsertedId)->where('included_tax', $request->included_tax[$i])->first();
                    if (!$checkWellness) {
                        $included_tax = Mst_Tax_Group_Included_Taxes::create([
                            'tax_group_id' => $lastInsertedId,
                            'included_tax' => $request->included_tax[$i],
                            'is_active' => 1,
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
            }
            return redirect()->route('tax.group.index')->with('success', 'Tax group added successfully');
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $pageTitle = "Edit Tax Groups";
            $tax = Mst_Tax_Group::where('id', $id)->first();
            $included_tax_ids = Mst_Tax_Group_Included_Taxes::where('tax_group_id', $id)->get()->pluck('included_tax')->toArray();
            $taxes = Mst_Tax::where('is_active', 1)->get();
            return view('tax-group.edit', compact('pageTitle', 'tax', 'taxes', 'included_tax_ids'));
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'tax_group_name' => 'required',
                'included_tax' => 'required',
            ]);

            $is_exists = Mst_Tax_Group::where('tax_group_name', $request->tax_group_name)
                ->where('id', '!=', $id)
                ->first();

            if (!$is_exists) {
                Mst_Tax_Group::where('id', $id)->update([
                    'tax_group_name' => $request->tax_group_name,
                    'is_active' => 1,
                    'updated_by' => Auth::id(),
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                return redirect()->route('tax.group.index')->with('error', 'This group name is already taken.');
            }

            if(count($request->included_tax)>0){
                $saved_taxes = Mst_Tax_Group_Included_Taxes::where('tax_group_id', $id)->where('is_active', 1)->pluck('included_tax')->toArray();
                $request_taxes = $request->included_tax;
                $changing_status = Mst_Tax_Group_Included_Taxes::where('tax_group_id', $id)->delete();
                $i = 0; 
                for ($i = 0; $i < count($request->included_tax); $i++) {

                    $included_tax = Mst_Tax_Group_Included_Taxes::create([
                        'tax_group_id' => $id,
                        'included_tax' => $request->included_tax[$i],
                        'is_active' => 1,
                        'created_by' => Auth::id(),
                        'updated_by' => Auth::id(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
            return redirect()->route('tax.group.index')->with('success', 'Tax group updated successfully');
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        try {
            $taxes =  Mst_Tax_Group::findOrFail($id);
            $taxes->delete();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', 'Something went wrong');
        }
    }


    public function changeStatus($id)
    {
        try {
            $taxes = Mst_Tax_Group::findOrFail($id);
            $taxes->is_active = !$taxes->is_active;
            $taxes->save();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', 'Something went wrong');
        }
    }
}
