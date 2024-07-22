<?php

namespace App\Http\Controllers;

use App\Models\Mst_Master_Value;
use App\Models\Mst_Staff;
use App\Models\Mst_Staff_Specialization;
use Illuminate\Http\Request;

class MstStaffSpecializationController extends Controller
{
    public function index()
    {
        $pageTitle = "Specialization";
        $specializations = Mst_Staff_Specialization::with('staffSpecialization','staff')->latest()->get();
        return view('staffSpecialization.index',compact('specializations','pageTitle'));
    }

    public function create()
    {
        $pageTitle = "Add Specialization";
        $staffspecialization = Mst_Master_Value::where('master_id',9)->pluck('master_value','id');
        $staff = Mst_Staff::pluck('staff_name','staff_id');
        return view('staffSpecialization.create',compact('pageTitle','staffspecialization','staff'));
    }

    public function store(Request $request)
{
    $request->validate([
        'staff_id' => 'required|exists:mst_staffs,staff_id|unique:mst_staff_specializations,staff_id,NULL,staff_id,specialization,' . $request->input('specialization'),
        'specialization' => 'required',
        'is_active' => 'required',
    ]);

    $is_active = $request->input('is_active') ? 1 : 0;

    $store = new Mst_Staff_Specialization();
    $store->staff_id = $request->input('staff_id');
    $store->specialization = $request->input('specialization');
    $store->is_active = $is_active;
    $store->save();

    return redirect()->route('specialization.index')->with('success', 'Specialization added successfully');
}


    public function edit($id)
    {
        $pageTitle = "Edit Specialization"; 
        $staffspecialization = Mst_Master_Value::where('master_id',9)->pluck('master_value','id');
        $staff = Mst_Staff::pluck('staff_name','staff_id');
        $specialization = Mst_Staff_Specialization::findOrFail($id);
        return view('staffSpecialization.edit',compact('pageTitle','staffspecialization','staff','specialization'));
    }

    public function update(Request $request ,$id)
    {
        $is_active = $request->input('is_active')? 1 : 0;

        $update = Mst_Staff_Specialization::findOrFail($id);
        $update->staff_id = $request->input('staff_id');
        $update->specialization = $request->input('specialization');
        $update->is_active = $is_active;
        $update->save();

        return redirect()->route('specialization.index')->with('success','Specialization updated successfully');

    }

    public function destroy($id)
    {
        $destroy = Mst_Staff_Specialization::findOrFail($id);
        $destroy->delete();

        return redirect()->route('specialization.index')->with('success','Specialization deleted successfully');
    }

    public function changeStatus($id)
    {
        $status = Mst_Staff_Specialization::findOrFail($id);

        $status->is_active = !$status->is_active;
        $status->save();

        return redirect()->back()->with('success','Status changed successfully');
    }
}
