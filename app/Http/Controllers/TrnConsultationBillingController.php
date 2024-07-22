<?php

namespace App\Http\Controllers;

use App\Models\Booking_Availability;
use App\Models\Mst_Branch;
use App\Models\Mst_External_Doctor;
use App\Models\Trn_Consultation_Billing;
use App\Models\Sys_Booking_Type;
use App\Models\Mst_Patient;
use App\Models\Mst_Therapy;
use App\Models\Mst_TimeSlot;
use App\Models\Mst_User;
use App\Models\Mst_Wellness;
use App\Models\Sys_Booking_Status;
use App\Models\Trn_Patient_Family_Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class TrnConsultationBillingController extends Controller
{
    public function index()
    {
        $billings = Trn_Consultation_Billing::with('bookingType', 'patient', 'doctor', 'branch', 'timeSlot', 'bookingStatus', 'availability', 'therapy', 'wellness', 'externalDoctor', 'familyMember')->get();
        return view('consultation_billing.index',compact('billings'));
    }

    public function create()
{
    $bookingTypes = Sys_Booking_Type::pluck('booking_type_name', 'booking_type_id');
    $patients = Mst_Patient::pluck('patient_name', 'id');
    $doctors = Mst_User::pluck('username', 'id');
    $branches = Mst_Branch::pluck('branch_name', 'id');
    $timeSlots = Mst_TimeSlot::pluck('time_slot_name', 'id');
    $bookingStatus = Sys_Booking_Status::pluck('status_name', 'id');
    $availability = Booking_Availability::pluck('availability_date', 'id');
    $therapies = Mst_Therapy::pluck('therapy_name', 'id');
    $wellness = Mst_Wellness::pluck('wellness_name', 'id');
    $externalDoctors = Mst_External_Doctor::pluck('doctor_name', 'id');
    $familyMember = Trn_Patient_Family_Member::pluck('family_member_name', 'id');

    return view('consultation_billing.create', compact('bookingTypes', 'patients', 'doctors', 'branches', 'timeSlots', 'bookingStatus', 'availability', 'therapies', 'wellness', 'externalDoctors', 'familyMember'));
}


    public function store(Request $request)
{
    $request->validate([
        // 'booking_reference_number' => 'required',
        'booking_type_id' => 'required|exists:sys_booking_types,booking_type_id',
        'patient_id' => 'required|exists:mst_patients,id',
        'doctor_id' => 'required|exists:mst_users,id',
        'branch_id' => 'required|exists:mst_branches,id',
        'booking_date' => 'required',
        'time_slot_id' => 'required|exists:mst_timeslots,id',
        'booking_status_id' => 'required|exists:sys_booking_status,id',
        'availability_id' => 'required|exists:booking_availabilities,id',
        'therapy_id' => 'required|exists:mst_therapies,id',
        'wellness_id' => 'required|exists:mst_wellness,id',
         'is_paid' => 'required',
         'is_otp_verified' => 'required',
        // 'verification_otp' => 'required',
        'external_doctor_id' => 'required|exists:mst_external_doctors,id',
        'booking_fee' => 'required',
        'discount' => 'required',
        'is_for_family_member' => 'required',
        // 'family_member_id' => 'required|exists:trn_patient_family_member,id',
    ]);

    $patient = Mst_Patient::find($request->patient_id);

    $is_membership_available = $patient->available_membership ? 1 : 0;

    $createdBy = Auth::id();

    $lastInsertedId = Trn_Consultation_Billing::insertGetId([
        'booking_type_id' => $request->booking_type_id,
        'patient_id' => $request->patient_id,
        'is_membership_available' => $is_membership_available,
        'doctor_id' => $request->doctor_id,
        'branch_id' => $request->branch_id,
        'booking_date' => $request->booking_date,
        'time_slot_id' => $request->time_slot_id,
        'booking_status_id' => $request->booking_status_id,
        'availability_id' => $request->availability_id,
        'therapy_id' => $request->therapy_id,
        'wellness_id' => $request->wellness_id,
        'is_paid' => $request->is_paid,
        'is_otp_verified' => $request->is_otp_verified,
        'verification_otp' => rand(50, 100),
        'external_doctor_id' => $request->external_doctor_id,
        'booking_fee' => $request->booking_fee,
        'discount' => $request->discount,
        'is_for_family_member' => $request->is_for_family_member,
        'family_member_id' => $request->family_member_id,
        'created_by' => $createdBy,
        'booking_reference_number' => rand(50, 100),
    ]);

    $leadingZeros = str_pad('', 3 - strlen($lastInsertedId), '0', STR_PAD_LEFT);
    $newBookingReferenceNumber = 'BRN' . $leadingZeros . $lastInsertedId;

    Trn_Consultation_Billing::where('id', $lastInsertedId)->update([
        'booking_reference_number' => $newBookingReferenceNumber
    ]);

    return redirect()->route('consultation_billing.index');
}


 public function edit($id)
 {
    $billings = Trn_Consultation_Billing::findOrFail($id);

    $bookingTypes = Sys_Booking_Type::pluck('booking_type_name', 'booking_type_id');
    $patients = Mst_Patient::pluck('patient_name', 'id');
    $doctors = Mst_User::pluck('username', 'id');
    $branches = Mst_Branch::pluck('branch_name', 'id');
    $timeSlots = Mst_TimeSlot::pluck('time_slot_name', 'id');
    $bookingStatus = Sys_Booking_Status::pluck('status_name', 'id');
    $availability = Booking_Availability::pluck('availability_date', 'id');
    $therapies = Mst_Therapy::pluck('therapy_name', 'id');
    $wellness = Mst_Wellness::pluck('wellness_name', 'id');
    $externalDoctors = Mst_External_Doctor::pluck('doctor_name', 'id');
    $familyMember = Trn_Patient_Family_Member::pluck('family_member_name', 'id');

        return view('consultation_billing.edit', compact('billings','bookingTypes', 'patients', 'doctors', 'branches', 'timeSlots', 'bookingStatus', 'availability', 'therapies', 'wellness', 'externalDoctors', 'familyMember'));
 }

 public function update(Request $request,$id)
 {
    $request->validate([
        
        'booking_type_id' => 'required|exists:sys_booking_types,booking_type_id',
        'patient_id' => 'required|exists:mst_patients,id',
        'doctor_id' => 'required|exists:mst_users,id',
        'branch_id' => 'required|exists:mst_branches,id',
        'booking_date' => 'required',
        'time_slot_id' => 'required|exists:mst_timeslots,id',
        'booking_status_id' => 'required|exists:sys_booking_status,id',
        'availability_id' => 'required|exists:booking_availabilities,id',
        'therapy_id' => 'required|exists:mst_therapies,id',
        'wellness_id' => 'required|exists:mst_wellness,id',
         'is_paid' => 'required',
         'is_otp_verified' => 'required',
        // 'verification_otp' => 'required',
        'external_doctor_id' => 'required|exists:mst_external_doctors,id',
        'booking_fee' => 'required',
        'discount' => 'required',
        'is_for_family_member' => 'required',
        // 'family_member_id' => 'required|exists:trn_patient_family_member,id',
    ]);

    $patient = Mst_Patient::find($request->patient_id);

    $is_membership_available = $patient->available_membership ? 1 : 0;

    $createdBy = Auth::id();

    $update = Trn_Consultation_Billing::find($id);

$update->update([
    'booking_type_id' => $request->booking_type_id,
    'patient_id' => $request->patient_id,
    'is_membership_available' => $is_membership_available,
    'doctor_id' => $request->doctor_id,
    'branch_id' => $request->branch_id,
    'booking_date' => $request->booking_date,
    'time_slot_id' => $request->time_slot_id,
    'booking_status_id' => $request->booking_status_id,
    'availability_id' => $request->availability_id,
    'therapy_id' => $request->therapy_id,
    'wellness_id' => $request->wellness_id,
    'is_paid' => $request->is_paid,
    'is_otp_verified' => $request->is_otp_verified,
    'verification_otp' => rand(50, 100),
    'external_doctor_id' => $request->external_doctor_id,
    'booking_fee' => $request->booking_fee,
    'discount' => $request->discount,
    'is_for_family_member' => $request->is_for_family_member,
    'family_member_id' => $request->family_member_id,
    'created_by' => $createdBy,
    
]);

return redirect()->route('consultation_billing.index');

 }

 public function destroy($id)
 {
     $billing = Trn_Consultation_Billing::findOrFail($id);
     $billing->delete();

     return redirect()->route('consultation_billing.index');
 }

//  public function changeStatus(Request $request, $id)
//  {
//      $billing = Trn_Consultation_Billing::findOrFail($id);
 
//      $billing->is_active = !$billing->is_active;
//      $billing->save();
 
//      return redirect()->back();
//  }


}
