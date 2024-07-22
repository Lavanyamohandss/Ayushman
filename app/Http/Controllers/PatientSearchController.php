<?php

namespace App\Http\Controllers;
use App\Models\Mst_Patient;
use App\Models\Trn_Consultation_Booking;
use Illuminate\Http\Request;

class PatientSearchController extends Controller
{
    public function index(Request $request)
    {
        $patients = Mst_Patient::query();
    
        if ($request->filled('pat_code')) {
            $patients->where('patient_code', $request->input('pat_code'));
        }
    
        if ($request->filled('pat_name')) {
            $patients->where('patient_name', $request->input('pat_name'));
        }
    
        if ($request->filled('pat_mobile')) {
            $patients->where('patient_mobile', $request->input('pat_mobile'));
        }

        if ($request->filled('from_date')) {
            $patients->where('booking_date', $request->input('from_date'));
        }

        if ($request->filled('to_date')) {
            $patients->where('booking_date ', $request->input('to_date'));
        }
    
        $patients = $patients->get();
    
        return view('patient_search.index', compact('patients'));
    }

    public function show($id)
    {
        $patient = Trn_Consultation_Booking::where('patient_id', $id)
            ->with('doctor', 'patient', 'branch', 'timeSlot', 'bookingStatus')
            ->firstOrFail();
    
        return view('patient_search.show', compact('patient'));
    }
    
    


}
