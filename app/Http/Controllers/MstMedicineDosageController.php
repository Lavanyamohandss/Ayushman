<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mst_Medicine_Dosage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class MstMedicineDosageController extends Controller
{
    public function index()
    {
        try {
            $pageTitle = "Medicine Dosages";
            $medicine_dosages = Mst_Medicine_Dosage::orderBy('created_at', 'desc')->get();
            return view('medicine_dosages.index', compact('pageTitle', 'medicine_dosages'));
        } catch (QueryException $e) {
            return redirect()->route('home')->with('error', 'Something went wrong.');
        }
    }


    public function create()
    {
        try {
            $pageTitle = "Create Medicine Dosages";
            return view('medicine_dosages.create', compact('pageTitle'));
        } catch (QueryException $e) {
            return redirect()->route('medicine.dosage.index')->with('error', 'Something went wrong');
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'medicine_dosages' => ['required'],
                    'is_active' => ['required'],
                ],
                [
                    'medicine_dosages.required' => 'Medicine dosage field is required',
                    'is_active.required' => 'Medicine dosage status is required',
                ]
            );

            if (!$validator->fails()) {
                if (isset($request->hidden_id)) {
                    Mst_Medicine_Dosage::where('medicine_dosage_id', $request->hidden_id)->update([
                        'name' => $request->medicine_dosages,
                        'is_active' => $request->is_active,
                        'updated_by' => Auth::id(),
                        'updated_at' => Carbon::now(),
                    ]);
                    $message = 'Medicine dosage updated successfully';
                } else {
                    $checkExists = Mst_Medicine_Dosage::where('name', $request->medicine_dosages)->first();
                    if ($checkExists) {
                        return redirect()->route('medicine.dosage.index')->with('exists', 'This medicine dosage is aready exists.');
                    } else {
                        Mst_Medicine_Dosage::create([
                            'name' => $request->medicine_dosages,
                            'is_active' => $request->is_active,
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        $message = 'Medicine dosage added successfully';
                    }
                }
                return redirect()->route('medicine.dosage.index')->with('success', $message);
            } else {
                $messages = $validator->errors();

                return redirect()->route('medicine.dosage.create')->with('error', $messages);
            }
        } catch (QueryException $e) {
            return redirect()->route('medicine.dosage.index')->with('error', 'Something went wrong');
        }
    }


    public function destroy($id)
    {
        try {
            $medicine_dosages = Mst_Medicine_Dosage::findOrFail($id);
            $medicine_dosages->deleted_by = Auth::id();
            $medicine_dosages->save();
            $medicine_dosages->delete();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('medicine.dosage.index')->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        try {
            $pageTitle = "Edit Medicine Dosages";
            $medicine_dosages = Mst_Medicine_Dosage::findOrFail($id);
            return view('medicine_dosages.create', compact('pageTitle', 'medicine_dosages'));
        } catch (QueryException $e) {
            return redirect()->route('medicine.dosage.index')->with('error', 'Something went wrong');
        }
    }

    public function changeStatus($id)
    {
        try {
            $medicine_dosages = Mst_Medicine_Dosage::findOrFail($id);

            $medicine_dosages->is_active = !$medicine_dosages->is_active;
            $medicine_dosages->save();
            return 1;
            return redirect()->back()->with('success', 'Status changed successfully');
        } catch (QueryException $e) {
            return redirect()->route('medicine.dosage.index')->with('error', 'Something went wrong');
        }
    }
}
