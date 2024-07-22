<?php

namespace App\Http\Controllers;

use App\Models\Mst_Branch;
use App\Models\Mst_Staff;
use App\Models\Mst_Therapy_Room;
use App\Models\Mst_Therapy_Room_Assigning;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MstTherapyRoomAssigningController extends Controller
{
    public function index($id)
    {
        try {
            $pageTitle = "Therapy Room Assigning";
            $basic_details = Mst_Therapy_Room::where('id', $id)->first();
            $branch_id = $basic_details->branch_id;
            $staffs = Mst_Staff::where('staff_type', 19)->where('branch_id', $branch_id)->where('is_active', 1)->get();
            $roomAssigning = Mst_Therapy_Room_Assigning::with('therapyroomName', 'branch', 'staff')
                ->where('mst_therapy_room_assigning.therapy_room_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('therapyroomAssigning.index', compact('pageTitle', 'roomAssigning', 'staffs', 'id', 'branch_id'));
        } catch (QueryException $e) {
            return redirect()->route('home')->with('error', 'Something went wrong.');
        }
    }

    public function create()
    {
        try {
            $pageTitle = "Assign Therapy Room";
            $therapyroom = Mst_Therapy_Room::pluck('room_name', 'id');
            $branch = Mst_Branch::pluck('branch_name', 'branch_id');
            $staff = Mst_Staff::where('staff_type', 19)->pluck('staff_name', 'staff_id');

            return view('therapyroomAssigning.create', compact('pageTitle', 'therapyroom', 'branch', 'staff'));
        } catch (QueryException $e) {
            return redirect()->route('therapyrooms.index')->with('error', 'Something went wrong.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'therapy_room_id' => 'required',
                'branch_id' => 'required',
                'assigned_staff_id' => 'required',
            ]);

            Mst_Therapy_Room_Assigning::where([
                'therapy_room_id' => $request->input('therapy_room_id'),
                'branch_id' => $request->input('branch_id'),
            ])->update(['is_active' => 0]);

            $store = new Mst_Therapy_Room_Assigning();
            $store->therapy_room_id = $request->input('therapy_room_id');
            $store->branch_id = $request->input('branch_id');
            $store->staff_id = $request->input('assigned_staff_id');
            $store->is_active = 1;
            $store->save();

            return redirect()->route('therapyroomassigning.index', $request->therapy_room_id)->with('success', 'Therapy room assigned successfully');
        } catch (QueryException $e) {
            return redirect()->route('therapyroomassigning.index')->with('error', 'Something went wrong.');
        }
    }

    public function edit($id)
    {
        try {
            $pageTitle = "Edit Assigned Room";

            $therapyroom = Mst_Therapy_Room::pluck('room_name', 'id');

            $branch = Mst_Branch::pluck('branch_name', 'branch_id');

            $staff = Mst_Staff::pluck('staff_name', 'staff_id');

            $roomassigning = Mst_Therapy_Room_Assigning::findOrFail($id);

            return view('therapyroomAssigning.edit', compact('pageTitle', 'therapyroom', 'branch', 'staff', 'roomassigning'));
        } catch (QueryException $e) {
            return redirect()->route('therapyrooms.index')->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $is_active = $request->input('is_active') ? 1 : 0;

            $update = Mst_Therapy_Room_Assigning::findOrFail($id);
            $update->therapy_room_id = $request->input('therapy_room_id');
            $update->branch_id = $request->input('branch_id');
            $update->staff_id = $request->input('staff_id');
            $update->is_active = $is_active;
            $update->save();

            return redirect()->route('therapyrooms.index')->with('success', 'updated successfully');
        } catch (QueryException $e) {
            return redirect()->route('therapyrooms.index')->with('error', 'Something went wrong.');
        }
    }

    public function destroy($id)
    {
        try {

            $destroy = Mst_Therapy_Room_Assigning::findOrFail($id);
            $id = $destroy->therapy_room_id;
            $destroy->delete();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('therapyrooms.index')->with('error', 'Something went wrong.');
        }
    }

    public function changeStatus($id)
    {
        try {
            $targetRecord = Mst_Therapy_Room_Assigning::findOrFail($id);

            Mst_Therapy_Room_Assigning::where([
                'therapy_room_id' => $targetRecord->therapy_room_id,
                'branch_id' => $targetRecord->branch_id,
            ])->update(['is_active' => 0]);

            $targetRecord->is_active = !$targetRecord->is_active;
            $targetRecord->save();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('therapyrooms.index')->with('error', 'Something went wrong.');
        }
    }

    public function getTherapyRooms($branchId)
    {
        try {
            $therapyRooms = Mst_Therapy_Room::where('branch_id', $branchId)->pluck('room_name', 'id');
            return response()->json($therapyRooms);
        } catch (QueryException $e) {
            return redirect()->route('therapyrooms.index')->with('error', 'Something went wrong.');
        }
    }
}
