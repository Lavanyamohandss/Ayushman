<?php

namespace App\Http\Controllers;

use App\Models\Trn_Consultation_Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingTypeController extends Controller
{

    //Consultation Booking:

    public function index(Request $request)
    {
        $pageTitle = "Consultation Bookings";
        $ConsultationBookings = DB::table('trn_consultation_bookings')
            ->leftJoin('mst_patients', 'trn_consultation_bookings.patient_id', '=', 'mst_patients.id')
            ->leftJoin('mst_users', 'trn_consultation_bookings.doctor_id', '=', 'mst_users.id')
            ->select('trn_consultation_bookings.id','trn_consultation_bookings.booking_type_id','trn_consultation_bookings.booking_reference_number', 'trn_consultation_bookings.booking_date', 'mst_patients.patient_name', 'mst_users.username')
            ->where('booking_type_id',1);

        if (!$request->has('date_from') && !$request->has('date_to')) {
            $ConsultationBookings = $ConsultationBookings->whereDate('booking_date', Carbon::today());
        }

        if ($request->has('date_from')) {
            $dateFrom = $request->input('date_from');
            $ConsultationBookings = $ConsultationBookings->where('booking_date', '>=', $dateFrom);
        }

        if ($request->has('date_to')) {
            $dateTo = $request->input('date_to');
            $ConsultationBookings = $ConsultationBookings->where('booking_date', '<=', $dateTo);
        }

        $ConsultationBookings = $ConsultationBookings->get();

        return view('booking_type.index', compact('pageTitle','ConsultationBookings'));
    }

    public function show($id)
    {
        $pageTitle = "View Booking";
        $booking = Trn_Consultation_Booking::with('doctor', 'patient', 'branch', 'timeSlot', 'bookingStatus')
            ->findOrFail($id);
            
        return view('booking_type.show', compact('pageTitle','pageTitle','booking'));
    }
    

    //WellnessBooking:

    public function wellnessIndex(Request $request)
    {
        $pageTitle = "Wellness Bookings";
        $WellnessBookings = DB::table('trn_consultation_bookings')
        ->leftJoin('mst_patients', 'trn_consultation_bookings.patient_id', '=', 'mst_patients.id')
        ->leftJoin('mst_users', 'trn_consultation_bookings.doctor_id', '=', 'mst_users.id')
        ->select('trn_consultation_bookings.id','trn_consultation_bookings.booking_type_id','trn_consultation_bookings.booking_reference_number', 'trn_consultation_bookings.booking_date', 'mst_patients.patient_name', 'mst_users.username')
        ->where('booking_type_id',2);

    if (!$request->has('date_from') && !$request->has('date_to')) {
        $WellnessBookings = $WellnessBookings->whereDate('booking_date', Carbon::today());
    }

    if ($request->has('date_from')) {
        $dateFrom = $request->input('date_from');
        $WellnessBookings = $WellnessBookings->where('booking_date', '>=', $dateFrom);
    }

    if ($request->has('date_to')) {
        $dateTo = $request->input('date_to');
        $WellnessBookings = $WellnessBookings->where('booking_date', '<=', $dateTo);
    }

    $WellnessBookings = $WellnessBookings->get();

    return view('booking_type.wellnessIndex', compact('pageTitle','WellnessBookings'));

    }


    public function wellnessShow($id)
    {
        $pageTitle = "View Booking";
        $booking = Trn_Consultation_Booking::with('doctor', 'patient', 'branch', 'timeSlot', 'bookingStatus')
        ->findOrFail($id);
        
         return view('booking_type.wellnessShow', compact('pageTitle','booking'));
    }

    //therapyBooking:

    public function therapyIndex(Request $request)
    {
        $pageTitle = "Therapy Bookings";
        $TherapyBookings = DB::table('trn_consultation_bookings')
        ->leftJoin('mst_patients', 'trn_consultation_bookings.patient_id', '=', 'mst_patients.id')
        ->leftJoin('mst_users', 'trn_consultation_bookings.doctor_id', '=', 'mst_users.id')
        ->select('trn_consultation_bookings.id','trn_consultation_bookings.booking_type_id','trn_consultation_bookings.booking_reference_number', 'trn_consultation_bookings.booking_date', 'mst_patients.patient_name', 'mst_users.username')
        ->where('booking_type_id',3);

    if (!$request->has('date_from') && !$request->has('date_to')) {
        $TherapyBookings = $TherapyBookings->whereDate('booking_date', Carbon::today());
    }

    if ($request->has('date_from')) {
        $dateFrom = $request->input('date_from');
        $TherapyBookings = $TherapyBookings->where('booking_date', '>=', $dateFrom);
    }

    if ($request->has('date_to')) {
        $dateTo = $request->input('date_to');
        $TherapyBookings = $TherapyBookings->where('booking_date', '<=', $dateTo);
    }

    $TherapyBookings = $TherapyBookings->get();

    return view('booking_type.therapyIndex', compact('pageTitle','TherapyBookings'));

    }

    public function therapyShow($id)
    {
        $pageTitle = "View Booking";
        $booking = Trn_Consultation_Booking::with('doctor', 'patient', 'branch', 'timeSlot', 'bookingStatus')
        ->findOrFail($id);
        
         return view('booking_type.therapyShow', compact('pageTitle','booking'));
    }

    
}
