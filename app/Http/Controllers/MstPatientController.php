<?php

namespace App\Http\Controllers;

use App\Models\Mst_Master_Value;
use App\Models\Mst_Patient;
use App\Models\Mst_Membership;
use App\Models\Mst_Membership_Package;
use App\Models\Mst_Membership_Package_Wellness;
use App\Models\Mst_Patient_Membership_Booking;
use App\Models\Mst_Membership_Benefit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class MstPatientController extends Controller
{
    public function index(Request $request)
{
    $pageTitle = "Patients";
    $query = Mst_Patient::query();

    // Apply filters if provided
    if ($request->has('patient_code')) {
        $query->where('patient_code', 'LIKE', "%{$request->patient_code}%");
    }

    if ($request->has('patient_name')) {
        $query->where('patient_name', 'LIKE', "%{$request->patient_name}%");
    }

    if ($request->has('patient_mobile')) {
        $query->where('patient_mobile', 'LIKE', "%{$request->patient_mobile}%");
    }

    $patients = $query->orderBy('updated_at', 'desc')->get();
    return view('patients.index', compact('pageTitle','patients'));
}

    

    public function create()
    {
        $pageTitle = "Create Patient";
        $gender =  Mst_Master_Value::where('master_id',17)->pluck('master_value','id');
        $membership = Mst_Membership::pluck('membership_name','id');
        $bloodgroup = Mst_Master_Value::where('master_id',19)->pluck('master_value','id');
        $maritialstatus = Mst_Master_Value::where('master_id',12)->pluck('master_value','id');
        // $registrationtype = Mst_Master_Value::where('master_id',11)->pluck('master_value','id');
        return view('patients.create',compact('pageTitle','gender','membership','bloodgroup','maritialstatus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            
            'patient_name' => 'required',
            // 'patient_email' => 'required',
            'patient_mobile' => 'required|digits:10|numeric',
            // 'patient_address' => 'required',
            // 'patient_gender' => 'required',
            // 'patient_dob' => 'required', 
            // 'patient_blood_group_id' => 'required',
            // 'emergency_contact_person' => 'required',
            // 'emergency_contact' => 'required',
            'marital_status' => 'required',
            'patient_medical_history' => 'required',
            'patient_current_medications' => 'required',
            'patient_registration_type' => 'required',
            // 'is_otp_verified' => 'required',
            // 'is_approved' => 'required',
            // 'password' => 'required',
            // 'confirm_password' => 'required|same:password',
            // 'whatsapp_number' => 'required',
            // 'available_membership' => 'required',
            'is_active' => 'required',
            ]);
        $is_active = $request->input('is_active') ? 1 : 0;
        $available_membership = $request->has('available_membership') ? 1 : 0;
        $generatedPassword = Str::random(8);
       
        $lastInsertedId = Mst_Patient::insertGetId([
           
            'patient_code' => rand(50, 100),
            'patient_name' => $request->patient_name,
            'patient_email' => $request->patient_email,
            'patient_mobile' => $request->patient_mobile,
            'patient_address' => $request->patient_address,
            'patient_gender' => $request->patient_gender,
            'patient_dob' => $request->patient_dob,
            'patient_blood_group_id' => $request->patient_blood_group_id,
            'emergency_contact_person' => $request->emergency_contact_person,
            'emergency_contact' => $request->emergency_contact,
            'maritial_status' => $request->marital_status,
            'patient_medical_history' => $request->patient_medical_history,
            'patient_current_medications' => $request->patient_current_medications,
            'patient_registration_type' => $request->patient_registration_type,
            'is_otp_verified' => 1,
            'is_approved' => 1,
            'password' => Hash::make($generatedPassword),
            'whatsapp_number' => $request->whatsapp_number,
            'available_membership' =>  $available_membership,
            'is_active' =>  $is_active ,
            'created_by' => auth()->id(),
        ]);

        $leadingZeros = str_pad('', 3 - strlen($lastInsertedId), '0', STR_PAD_LEFT);
        $patientCode = 'PAT' . $leadingZeros . $lastInsertedId;
    
        Mst_Patient::where('id', $lastInsertedId)->update([
            'patient_code' => $patientCode
        ]);
    
         
        return redirect()->route('patients.index')->with('success','Patient added successfully');
    }


    public function edit($id)
    {
        $pageTitle = "Edit Patient";
        $membership = Mst_Membership::pluck('membership_name','id');
        $gender =  Mst_Master_Value::where('master_id',17)->pluck('master_value','id');
        $bloodgroup = Mst_Master_Value::where('master_id',19)->pluck('master_value','id');
        $maritialstatus = Mst_Master_Value::where('master_id',12)->pluck('master_value','id');
        // $registrationtype = Mst_Master_Value::where('master_id',11)->pluck('master_value','id');
        $patient = Mst_Patient::findOrFail($id);
        return view('patients.edit',compact('pageTitle','patient','gender','membership','bloodgroup','maritialstatus'));
    }

    public function update(Request $request,$id)
    {
       
        $is_active = $request->input('is_active') ? 1 : 0;
        // print_r($request->emergency_contact_person);die();
        $update = Mst_Patient::find($id);
        $update->update([
            'patient_name' => $request->patient_name, 
            'patient_email' => $request->patient_email,
            'patient_mobile' => $request->patient_mobile,
            'patient_address' => $request->patient_address,
            'patient_gender' => $request->patient_gender,
            'patient_dob' => $request->patient_dob,
            'patient_blood_group_id' => $request->patient_blood_group_id,
            'emergency_contact_person' => $request->emergency_contact_person,
            'emergency_contact' => $request->emergency_contact,
            'maritial_status' => $request->marital_status,
            'patient_medical_history' => $request->patient_medical_history,
            'patient_current_medications' => $request->patient_current_medications,
            'patient_registration_type' => $request->patient_registration_type,
            'is_otp_verified' => $request->is_otp_verified,
            'is_approved' => $request->is_approved,
            'whatsapp_number' => $request->whatsapp_number,
            'available_membership' => $request->available_membership,
            'is_active' =>  $is_active ,
        ]);
      
        return redirect()->route('patients.index')->with('success','Patient updated successfully');
    }

    public function show($id)
    {
        $pageTitle = "View patient details";
        $show = Mst_Patient::findOrFail($id);
        return view('patients.show',compact('pageTitle','show'));
    }

    public function destroy($id)
    { 
        $patient = Mst_Patient::findOrFail($id);
        $patient->delete();
        return 1;

        return redirect()->route('patients.index')->with('success','Patient deleted successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        $patient = Mst_Patient::findOrFail($id);
    
        $patient->is_active = !$patient->is_active;
        $patient->save();
        return 1;
    
        return redirect()->back()->with('success','Status changed successfully');
    }

    public function toggleOTPVerification($id)
    {
        $patient = Mst_Patient::findOrFail($id);
        $patient->is_otp_verified = !$patient->is_otp_verified;
        $patient->save();
        return 1;

      return redirect()->back()->with('success','OTP verification status updated successfully');
    }

    public function toggleApproval($id)
    {
        $patient = Mst_Patient::findOrFail($id);
        $patient->is_approved = !$patient->is_approved;
        $patient->save();

      return redirect()->back()->with('success','Approval status updated successfully');
    }


    //adding membership to a particular patient:

    public function addMembershipIndex($id)
    {
        $pageTitle = "Membership details";
        $paymentType = Mst_Master_Value::where('master_id',25)->pluck('master_value','id');
        $memberships = Mst_Membership_Package::pluck('package_title', 'membership_package_id', 'package_duration', 'package_description', 'package_price', 'is_active');
        $patientMemberships = Mst_Patient_Membership_Booking::where('patient_id', $id)->get();
 
        return view('patients.membership_details', compact('pageTitle', 'memberships', 'id', 'patientMemberships','paymentType'));
    }
    
    public function getWellnessDetails($membershipId)
    {
        if (isset($membershipId)) {
         
            $package_details = Mst_Membership_Package::where('membership_package_id', $membershipId)->first();
    
            // Retrieve benefits based on the $membershipId
            $benefits = Mst_Membership_Benefit::where('package_id', $membershipId)->first();

            // Retrieve patient membership bookings
            // $bookingDetails = Mst_Patient_Membership_Booking::findOrFail();
    
            // Retrieve wellness details based on the $membershipId
            $wellnessDetails = Mst_Membership_Package_Wellness::join('mst_wellness', 'mst__membership__package__wellnesses.wellness_id', '=', 'mst_wellness.wellness_id')
                ->where('mst__membership__package__wellnesses.package_id', $membershipId)
                ->where('mst__membership__package__wellnesses.is_active', 1)
                ->selectRaw('mst_wellness.wellness_id, mst_wellness.wellness_name, CONCAT(mst_wellness.wellness_duration, " minutes") as wellness_duration, mst__membership__package__wellnesses.maximum_usage_limit, mst__membership__package__wellnesses.is_active, mst_wellness.wellness_inclusions')
                ->get();
                return response()->json(['wellnessDetails'=> $wellnessDetails , 'benefits'=> $benefits ,'package_details' => $package_details  ]);
    }
}

//storing patient membership details in table mst__patient__membership__bookings:
     
    public function patientMembershipStore(Request $request,$id)
    {
        
        try{
        $request->validate([
           
            'payment_type' => 'required',
            'start_date' => 'required',

        ]);
        $membershipId = $request->input('membership');
        $patientId = $id;
        $selectedMembership = Mst_Membership_Package::findOrFail($membershipId);    
        $startDate = Carbon::parse($request->input('start_date')); 
        $membershipDuration = $selectedMembership->package_duration;
        $expiryDate = $startDate->addDays($membershipDuration); // Calculate expiry date

        $booking = new Mst_Patient_Membership_Booking();
        $booking->patient_id = $patientId;
        $booking->membership_package_id = $membershipId;
        $booking->start_date = $request->input('start_date');
        $booking->payment_type = $request->input('payment_type');

      
        $booking->payment_amount = $selectedMembership->package_price;
        $booking->membership_expiry_date = $expiryDate;
        $booking->is_active = $selectedMembership->is_active;
        $booking->save();

        return redirect()->route('patients.index')->with('success', 'Membership added successfully');
        
    }
    catch (QueryException $e) {
    return redirect()->route('home')->with('error', 'Something went wrong');
    }
 
    }
}