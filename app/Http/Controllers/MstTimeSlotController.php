<?php

namespace App\Http\Controllers;

use App\Models\Mst_Master_Value;
use App\Models\Mst_Staff;
use App\Models\Mst_User;
use App\Models\Mst_TimeSlot;
use Illuminate\Http\Request;
use carbon\Carbon;

class MstTimeSlotController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = "Timeslots";
        $timeslots = Mst_Master_Value::where('master_id', 24)->orderBy('updated_at', 'desc')->get();
        return view('timeslot.index', compact('pageTitle', 'timeslots'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'master_value' => 'required|unique:mst_master_values,master_value',
        ]);

        $slot = new Mst_Master_Value();
        $slot->master_id = 24;
        $slot->master_value = $request->input('master_value');
        $slot->group_id = 0;
        $slot->is_active = 1;
        $slot->created_by = auth()->id();
        $slot->save();


        return redirect()->route('timeslot.index')->with('success', 'Timeslot added successfully');
    }
 
    public function edit($id)
    {
        $pageTitle = "Edit Timeslot";
        $timeslot = Mst_Master_Value::findOrFail($id);
        return view('timeslot.edit', compact('pageTitle','timeslot'));
    }
    
    public function update(Request $request,$id)
    {
        $request->validate([
            'slot_name' => 'required|unique:mst_master_values,master_value',
        ]);
         $slot = Mst_Master_Value::findOrFail($id);
         $slot->master_id = 24;
         $slot->master_value = $request->input('slot_name');
         $slot->group_id = 0;
         $slot->is_active = 1;
         $slot->created_by = auth()->id();
         $slot->update();

         return redirect()->route('timeslot.index')->with('success','Timeslot updated successfully');

    }

    public function destroy($id)
    {
        $timeslot = Mst_Master_Value::findOrFail($id);
        $timeslot->delete();
        return 1;
        return redirect()->route('timeslot.index')->with('success','Timeslot deleted successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        $timeslot = Mst_Master_Value::findOrFail($id);
    
        $timeslot->is_active = !$timeslot->is_active;
        $timeslot->save();
    
        return redirect()->back()->with('success','Status changed successfully');
    }

    //Adding timeslot for a particular staff:

    public function slotIndex($id)
    {
        $pageTitle = "Timeslots";
        $timeslot = Mst_TimeSlot::where('staff_id',$id)->with('weekDay','timeSlot')->latest()->get();
        $weekday = Mst_Master_Value::where('master_id',3)->pluck('master_value','id');
        $slot = Mst_Master_Value::where('master_id',24)->pluck('master_value','id');

        return view('timeslot.slot',compact('pageTitle','timeslot','weekday','slot','id'));
    }

    public function slotStore(Request $request)
    {
   
        $request->validate([
            'staff_id' => 'required',
            'week_day' => 'required',
            'slot' => 'required',
            'tokens' => 'required',
            
        ]);
       $is_exists = Mst_TimeSlot::where('week_day',$request->input('week_day'))->where('time_slot',$request->input('slot'))->first();
       if($is_exists){
        return redirect()->back()->with('error', 'This timeslot is already assigned.');
       } else {
      
        $staffslot = new Mst_TimeSlot();
       
        $staffslot->staff_id = $request->input('staff_id');
        $staffslot->week_day = $request->input('week_day');
        $staffslot->time_slot = $request->input('slot');
        $staffslot->max_tokens = $request->input('tokens');
        $staffslot->is_available = 1;
        $staffslot->is_active = 1;
        $staffslot->created_by  = auth()->id();
        $staffslot->save();


        return redirect()->route('staff.slot',['id'=> $request->input('staff_id')])->with('success','Timeslot added successfully');
    }
}

    public function slotDelete(Request $request, $id)
{
    $delete = Mst_TimeSlot::findOrFail($id);
    $delete->delete();
    return redirect()->back()->with('success', 'Timeslot deleted successfully');
}

}



   
