<?php

namespace App\Http\Controllers;

use App\Models\Mst_Branch;
use App\Models\Mst_Staff;
use App\Models\Mst_Staff_Transfer_Log;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class EmployeeBranchTransferController extends Controller
{
    public function index()
    {
        try {
            $pageTitle = "Employee branch transfer";
            $branch = Mst_Branch::pluck('branch_name', 'branch_id');
            $employees = Mst_Staff::pluck('staff_name', 'staff_id');
            return view('staffbranchTransfer.index', compact('pageTitle', 'branch', 'employees'));
        } catch (QueryException $e) {
            return redirect()->route('home')->with('error', 'Something went wrong.');
        }
    }
    public function getEmployees($branchId)
    {

        try {
            $employees = Mst_Staff::where('branch_id', $branchId)->get();
            return response()->json($employees);
        } catch (QueryException $e) {
            return redirect()->route('branchTransfer.index')->with('error', 'Something went wrong.');
        }
    }


    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'from_branch' => 'required|exists:mst_branches,branch_id',
                    'to_branch' => 'required|exists:mst_branches,branch_id',
                    'transfered_staff_id' => 'required|array',
                ],
                [
                    'from_branch.required' => 'From branch name is required',
                    'to_branch.required' => 'To branch name is required',
                    'transfered_staff_id.required' => 'Transffered staff name is required',
                ]
            );

            if (!$validator->fails()) {

                $fromBranchId = $request->from_branch;
                $toBranchId = $request->to_branch;
                $selectedStaffs = $request->transfered_staff_id;
                if (!is_null($selectedStaffs) && count($selectedStaffs) > 0) {
                    // array is not null and not empty.
                    // Loop through selected staff and store transfer records
                    foreach ($selectedStaffs as $staffId) {
                        // Create a new staff transfer log entry
                        Mst_Staff_Transfer_Log::create([
                            'staff_id' => $staffId,
                            'branch_id_from' => $fromBranchId,
                            'branch_id_to' => $toBranchId,
                            'transfer_date' => carbon::now(),
                            'created_by' => auth()->id(),
                            'updated_by' => auth()->id(),
                            'created_at' => carbon::now(),
                            'updated_at' => carbon::now(),
                        ]);

                        //update the staff's branch in the 'mst_staff' table
                        Mst_Staff::where('staff_id', $staffId)->update(['branch_id' => $toBranchId]);
                    }
                    return redirect()->route('branchTransfer.index')->with('success', 'Employees transferred successfully.');
                } else {
                    //  array is either null or empty.
                    return redirect()->route('branchTransfer.index')->with('error', 'Please select a staff.');
                }
            } else {
                $messages = $validator->errors();
                return redirect()->route('branchTransfer.index')->with('validation', $messages);
            }
        } catch (QueryException $e) {
            return redirect()->route('branchTransfer.index')->with('error', 'Something went wrong');
        }
    }
}
