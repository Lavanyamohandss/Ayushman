<?php

namespace App\Http\Controllers;

use App\Models\Mst_Branch;
use App\Models\Mst_Wellness;
use App\Models\Trn_Wellness_Branch;
use Illuminate\Http\Request;

class MstWellnessController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = "Wellness";
        $branches = Mst_Branch::pluck('branch_name','branch_id');
        $query = Mst_Wellness::query();

        // Apply filters if provided
        if ($request->has('wellness_name')) {
            $query->where('wellness_name', 'LIKE', "%{$request->wellness_name}%");
        }
    
        if ($request->has('branch_id')) {
            $query->where('branch_id', 'LIKE', "%{$request->branch_id}%");
        }
    
        $wellness = $query->orderBy('updated_at', 'desc')->get();
        return view('wellness.index',compact('pageTitle','wellness','branches'));
    }

    public function create()
    {
        $pageTitle = "Create Wellness";
        $branch = Mst_Branch::pluck('branch_name','branch_id');
        return view('wellness.create',compact('pageTitle','branch'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'wellness_name' => 'required',
            'wellness_description' => 'required',
            'wellness_inclusions' => 'required',
            'wellness_terms_conditions' => 'required',
            'branch' => 'required|array',
            'wellness_cost' => 'required|numeric',
            'wellness_duration' => 'required',
            'is_active' => 'required',
        ]);
        $is_active = $request->input('is_active') ? 1 : 0;
       
       
        $wellness = new Mst_Wellness();
        $wellness->wellness_name = $request->input('wellness_name');
        $wellness->wellness_description = $request->input('wellness_description');
        $wellness->wellness_inclusions = $request->input('wellness_inclusions');
        $wellness->wellness_terms_conditions = $request->input('wellness_terms_conditions');
      
        $wellness->wellness_cost = $request->input('wellness_cost');
        $wellness->wellness_duration = $request->input('wellness_duration');
        $wellness->remarks = $request->input('remarks');
        $wellness->is_active = $is_active;
        $wellness->save();

         // Check if 'branch' is an array 
        if (is_array($request->input('branch'))) {
        // Iterate through the selected branches and store them in trn_wellness_branches
        foreach ($request->input('branch') as $branchId) {
            Trn_Wellness_Branch::create([
                'wellness_id' => $wellness->wellness_id, // Link to the newly created wellness record
                'branch_id' => $branchId,
            ]);
        }
    } else {
        // If 'branch' is a single value, store it in Mst_Wellness table 
        $wellness->branch_id = $request->input('branch');
        $wellness->save();
    }

    
        return redirect()->route('wellness.index')->with('success','Wellness added successfully');
    }

    public function edit($wellness_id)
    {
        $pageTitle = "Edit Wellness";
        $wellness = Mst_Wellness::findOrFail($wellness_id);
       // $wellness->load('branches');
        $branch = Mst_Branch::pluck('branch_name','branch_id');
        return view('wellness.edit',compact('pageTitle','wellness','branch'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'wellness_name' => 'required',
            'wellness_description' => 'required',
            'wellness_inclusions' => 'required',
            'wellness_terms_conditions' => 'required',
            'branch' => 'required|array',
            'wellness_cost' => 'required|numeric',
            'wellness_duration' => 'required',
            'is_active' => 'required',
        ]);
    
        $is_active = $request->input('is_active') ? 1 : 0;
    
        // Find the wellness record by its ID
        $wellness = Mst_Wellness::find($id);
    
        if (!$wellness) {
            return redirect()->route('wellness.index')->with('error', 'Wellness not found');
        }
    
        // Update the wellness record with the new values
        $wellness->wellness_name = $request->input('wellness_name');
        $wellness->wellness_description = $request->input('wellness_description');
        $wellness->wellness_inclusions = $request->input('wellness_inclusions');
        $wellness->wellness_terms_conditions = $request->input('wellness_terms_conditions');
        $wellness->wellness_cost = $request->input('wellness_cost');
        $wellness->wellness_duration = $request->input('wellness_duration');
        $wellness->remarks = $request->input('remarks');
        $wellness->is_active = $is_active;
        $wellness->save();
    
        // Delete existing records in trn_wellness_branches for this wellness
        Trn_Wellness_Branch::where('wellness_id', $wellness->wellness_id)->delete();
    
        // Iterate through the selected branches and store them in trn_wellness_branches
        foreach ($request->input('branch') as $branchId) {
            Trn_Wellness_Branch::create([
                'wellness_id' => $wellness->wellness_id,
                'branch_id' => $branchId,
            ]);
        }
    
        return redirect()->route('wellness.index')->with('success', 'Wellness updated successfully');
    }
    
    public function show($id)
    {
        $pageTitle = "View wellness details";
        $show = Mst_Wellness::findOrFail($id);
        $branch = Mst_Branch::pluck('branch_name','branch_id');
        return view('wellness.show',compact('pageTitle','show','branch'));
    }

    public function destroy($wellness_id)
    {
        $wellness = Mst_Wellness::findOrFail($wellness_id);
        $wellness->delete();
        return 1;

        return redirect()->route('wellness.index')->with('success','Wellness deleted successfully');
    }


    public function changeStatus(Request $request, $wellness_id)
    {
        $wellness = Mst_Wellness::findOrFail($wellness_id);

        $wellness->is_active = !$wellness->is_active;
        $wellness->save();
        return 1;

        return redirect()->back()->with('success','Status changed successfully');
    }
}
