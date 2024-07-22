<?php

namespace App\Http\Controllers;
use App\Models\Mst_Master_Value;
use App\Models\Sys_Master;
use Illuminate\Http\Request;

class MstMasterValueController extends Controller
{
    public function index()
    {
        $pageTitle = "Master Values";
        $masterValue = Mst_Master_Value::orderBy('created_at','desc')->get();
        return view('masterValues.index',compact('pageTitle','masterValue'));
    }

    public function create()
    {
        $pageTitle = "Add Master Values";
        $master = Sys_Master::pluck('master_name','master_id');
        $group = Sys_Master::pluck('master_name','master_id');
        return view('masterValues.create',compact('pageTitle','master','group'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'master_type' => 'required',
            'master_value' => 'required',
            'is_active' => 'required',
        ]);
    
        $is_active = $request->input('is_active') ? 1 : 0;
    
        $master = new Mst_Master_Value();
        $master->master_id = $request->input('master_type');
        $master->master_value = $request->input('master_value');
    
        if ($request->has('group_id')) {
            $master->group_id = $request->input('group_id'); // Store the provided group_id
        } else {
            $master->group_id = 0; // Set group_id to 0 if it's not provided
        }
    
        $master->is_active = $is_active;
        $master->created_by = auth()->id();
        $master->save();
    
        return redirect()->route('mastervalues.index')->with('success', 'Master value added successfully');
    }
    
    public function edit($id)
    {
        $pageTitle = "Edit Master Value";
        $master = Sys_Master::pluck('master_name','master_id');
        $group = Sys_Master::pluck('master_name','master_id');
        $mastervalue = Mst_Master_Value::findOrFail($id);
        return view('masterValues.edit',compact('pageTitle','master','mastervalue','group'));

    }

    public function update(Request $request,$id)
    {
        $is_active = $request->input('is_active') ? 1 : 0;

        $master = Mst_Master_Value::findOrFail($id);
        $master-> master_id = $request->input('master_type');
        $master->master_value = $request->input('master_value');
        $master->is_active = $is_active;
        $master->save();

       return redirect()->route('mastervalues.index')->with('success','Master value updated successully');
    }

    public function show($id)
    {
        $pageTitle = "View master values";
        $show = Mst_Master_Value::with('masterValue','groupType')->findOrFail($id);
        return view('masterValues.show',compact('pageTitle','show'));
    }

    public function destroy($id)
    {
        $destroy = Mst_Master_Value::findOrFail($id);
        $destroy->delete();

        return redirect()->route('mastervalues.index')->with('success','Master value deleted successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        $master = Mst_Master_Value::findOrFail($id);
    
        $master->is_active = !$master->is_active;
        $master->save();
    
        return redirect()->back()->with('success','Status changed successfully');
    }
     
}
