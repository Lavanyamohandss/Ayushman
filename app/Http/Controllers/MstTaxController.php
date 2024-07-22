<?php

namespace App\Http\Controllers;

use App\Models\Mst_Tax;
use App\Models\Sys_Tax;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MstTaxController extends Controller
{
    public function index()
    {
        try {
            $pageTitle = "Taxes";
            $taxes = Mst_Tax::join('sys__taxes', 'mst_taxes.tax_type', 'sys__taxes.id')
                ->select('sys__taxes.tax_name as tax', 'mst_taxes.id', 'mst_taxes.tax_name', 'mst_taxes.tax_rate', 'mst_taxes.is_active',)
                ->get();
            return view('tax.index', compact('pageTitle', 'taxes'));
        } catch (QueryException $e) {
            return redirect()->route('home')->with('error', 'Something went wrong');
        }
    }

    public function create()
    {
        try {
            $pageTitle = "Create Tax";
            $taxes  = Sys_Tax::where('is_active', 1)->get();
            $all_taxes = Mst_Tax::join('sys__taxes', 'mst_taxes.tax_type', 'sys__taxes.id')
                ->select('sys__taxes.tax_name as tax', 'mst_taxes.id', 'mst_taxes.tax_name', 'mst_taxes.tax_rate', 'mst_taxes.is_active',)
                ->get();
            return view('tax.create', compact('pageTitle', 'taxes','all_taxes'));
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', 'Something went wrong');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tax_name' => 'required',
                'tax_rate' => 'required|numeric',
                'tax_type' => 'required',
                'is_active' => 'required',

            ]);
            $checkExists = Mst_Tax::where('tax_name', $request->tax_name)->first();
            if ($checkExists) {
                return redirect()->route('tax.create')->with('exists', 'This tax name is aready exists.');
            } else {
                $is_active = $request->input('is_active') ? 1 : 0;
                $taxes = new Mst_Tax();
                $taxes->tax_name = $request->input('tax_name');
                $taxes->tax_rate = $request->input('tax_rate');
                $taxes->tax_type = $request->input('tax_type');
                $taxes->is_active  = $is_active;
                $taxes->created_by = auth()->id();
                $taxes->updated_by = auth()->id();
                $taxes->save();

                return redirect()->route('tax.create')->with('success', 'Tax added successfully');
            }
        } catch (QueryException $e) {
            return redirect()->route('tax.create')->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        try {
            $pageTitle = "Edit Tax";
            $tax = Mst_Tax::findOrFail($id);
            $taxes  = Sys_Tax::where('is_active', 1)->get();
            return view('tax.edit', compact('pageTitle', 'tax', 'taxes'));
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'tax_title' => 'required',
                'split_value_1' => 'required',
                'split_value_2' => 'required',
            ]);
            $checkExists = Mst_Tax::where('tax_name', $request->tax_name)->first();

            if ($checkExists) {
                return redirect()->route('tax.group.index')->with('exists', 'This tax name is aready exists.');
            } else {
                $is_active = $request->input('is_active') ? 1 : 0;
                $taxes = Mst_Tax::findOrFail($id);
                $taxes->tax_name = $request->input('tax_name');
                $taxes->tax_rate = $request->input('tax_rate');
                $taxes->tax_type = $request->input('tax_type');
                $taxes->is_active  = $is_active;
                $taxes->created_by = auth()->id();
                $taxes->updated_by = auth()->id();
                $taxes->save();
            }
            return redirect()->route('tax.group.index')->with('success', 'Tax updated successfully');
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        try {
            $taxes =  Mst_Tax::findOrFail($id);
            $taxes->delete();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', 'Something went wrong');
        }
    }


    public function changeStatus($id)
    {
        try {
            $taxes = Mst_Tax::findOrFail($id);
            $taxes->is_active = !$taxes->is_active;
            $taxes->save();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('tax.group.index')->with('error', 'Something went wrong');
        }
    }
}
