<?php

namespace App\Http\Controllers;

use App\Models\Mst_Unit;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MstUnitController extends Controller
{

    public function index()
    {
        try {
            $pageTitle = "Units";
            $units = Mst_Unit::latest()->get();
            return view('unit.index', compact('pageTitle', 'units'));
        } catch (QueryException $e) {
            return redirect()->route('home')->with('error', 'Something went wrong.');
        }
    }

    public function create()
    {
        try {
            $pageTitle = "Create Unit";
            return view('unit.create', compact('pageTitle'));
        } catch (QueryException $e) {
            return redirect()->route('unit.index')->with('error', 'Something went wrong.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'unit_name' => 'required',
                'is_active' => 'required',
            ]);

            $is_exists = Mst_Unit::where('unit_name', $request->input('unit_name'))->first();

            if ($is_exists) {
                return redirect()->route('unit.index')->with('error', 'This unit is already exists.');
            } else {
                $is_active = $request->input('is_active') ? 1 : 0;
                $units = new Mst_Unit();
                $units->unit_name = $request->input('unit_name');
                $units->unit_short_name = $request->input('unit_short_name');
                $units->is_active = $is_active;
                $units->save();
                return redirect()->route('unit.index')->with('success', 'Unit added successfully');
            }
        } catch (QueryException $e) {
            return redirect()->route('unit.index')->with('error', 'Something went wrong.');
        }
    }

    public function edit($id)
    {
        try {
            $pageTitle = "Edit Unit";
            $units = Mst_Unit::findOrFail($id);
            return view('unit.edit', compact('pageTitle', 'units'));
        } catch (QueryException $e) {
            return redirect()->route('unit.index')->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'unit_name' => 'required',
                'is_active' => 'required',
            ]);
            $is_exists = Mst_Unit::where('unit_name', $request->input('unit_name'))
                                    ->where('id',!$id)
                                    ->first();
            if ($is_exists) {
                return redirect()->route('unit.index')->with('error', 'This unit is already exists.');
            } else {
                $is_active = $request->input('is_active') ? 1 : 0;
                $units =  Mst_Unit::findOrFail($id);
                $units->unit_name = $request->input('unit_name');
                $units->unit_short_name = $request->input('unit_short_name');
                $units->is_active = $is_active;
                $units->save();

                return redirect()->route('unit.index')->with('success', 'Unit updated successfully');
            }
        } catch (QueryException $e) {
            return redirect()->route('unit.index')->with('error', 'Something went wrong.');
        }
    }

    public function destroy($id)
    {
        try {
            $units =  Mst_Unit::findOrFail($id);
            $units->delete();

            return 1;
        } catch (QueryException $e) {
            return redirect()->route('unit.index')->with('error', 'Something went wrong.');
        }
    }

    public function changeStatus($id)
    {
        try {
            $units = Mst_Unit::findOrFail($id);
            $units->is_active = !$units->is_active;
            $units->save();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('unit.index')->with('error', 'Something went wrong.');
        }
    }
}
