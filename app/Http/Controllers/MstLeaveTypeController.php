<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mst_Leave_Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class MstLeaveTypeController extends Controller
{
    public function index()
    {
        try {
            $pageTitle = "Leave Types";
            $leave_types = Mst_Leave_Type::orderBy('created_at', 'desc')->get();
            return view('leave_types.index', compact('pageTitle', 'leave_types'));
        } catch (QueryException $e) {
            return redirect()->route('home')->with('error', 'Something went wrong.');
        }
    }


    public function create()
    {
        try {
            $pageTitle = "Create Leave Types";
            return view('leave_types.create', compact('pageTitle'));
        } catch (QueryException $e) {
            return redirect()->route('leave.type.index')->with('error', 'Something went wrong');
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'leave_types' => ['required'],
                    'is_active' => ['required'],
                    'is_dedactable' => ['required'],
                ],
                [
                    'leave_types.required' => 'Medicine dosage field is required',
                    'is_active.required' => 'Medicine dosage status is required',
                    'is_dedactable.required' => 'Deductable status is required',
                ]
            );

            if (!$validator->fails()) {
                if (isset($request->hidden_id)) {
                    Mst_Leave_Type::where('leave_type_id', $request->hidden_id)->update([
                        'name' => $request->leave_types,
                        'is_active' => $request->is_active,
                        'is_dedactable' => $request->is_dedactable,
                        'updated_by' => Auth::id(),
                        'updated_at' => Carbon::now(),
                    ]);
                    $message = 'Leave type updated successfully';
                } else {
                    $checkExists = Mst_Leave_Type::where('name', $request->leave_types)->first();
                    if ($checkExists) {
                        return redirect()->route('leave.type.index')->with('exists', 'This leave type is aready exists.');
                    } else {
                        Mst_Leave_Type::create([
                            'name' => $request->leave_types,
                            'is_active' => $request->is_active,
                            'is_dedactable' => $request->is_dedactable,
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        $message = 'Leave type added successfully';
                    }
                }
                return redirect()->route('leave.type.index')->with('success', $message);
            } else {
                $messages = $validator->errors();

                return redirect()->route('leave.type.create')->with('error', $messages);
            }
        } catch (QueryException $e) {
            return redirect()->route('leave.type.index')->with('error', 'Something went wrong');
        }
    }


    public function destroy($id)
    {
        try {
            $leave_types = Mst_Leave_Type::findOrFail($id);
            $leave_types->deleted_by = Auth::id();
            $leave_types->save();
            $leave_types->delete();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('leave.type.index')->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        try {
            $pageTitle = "Edit Leave Types";
            $leave_types = Mst_Leave_Type::findOrFail($id);
            return view('leave_types.create', compact('pageTitle', 'leave_types'));
        } catch (QueryException $e) {
            return redirect()->route('leave.type.index')->with('error', 'Something went wrong');
        }
    }

    public function changeStatus($id)
    {
        try {
            $leave_types = Mst_Leave_Type::findOrFail($id);
            $leave_types->is_active = !$leave_types->is_active;
            $leave_types->save();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('leave.type.index')->with('error', 'Something went wrong');
        }
    }

    public function changeDeductible($id)
    {
        try {
            $leave_types = Mst_Leave_Type::findOrFail($id);
            $leave_types->is_dedactable = !$leave_types->is_dedactable;
            $leave_types->save();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('leave.type.index')->with('error', 'Something went wrong');
        }
    }
}
