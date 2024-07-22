<?php

namespace App\Http\Controllers;
use App\Models\Trn_Wellness_Booking_Invoice;
use App\Models\Mst_Wellness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrnWellnessBillingController extends Controller
{
   public function index()
   {
    $billing = Trn_Wellness_Booking_Invoice::all();
    return view('wellnessBilling.index',compact('billing'));
   }

   public function create()
    {
        // $booking = Trn_Consultation_Booking::pluck()
        $wellness = Mst_Wellness::pluck('wellness_name','id');

        return view('wellnessBilling.create', compact('wellness'));
    }

    public function store(Request $request)
{
    $request->validate([
        
        'booking_id' => 'required|exists:trn_consultation_bookings,id',
        'wellness_id' => 'required|exists:mst_wellness,id',
        'invoice_date' => 'required|date',
        'paid_amount' => 'required|numeric|min:0',
        'payment_type' => 'required',
    ]);

   

    $createdBy = Auth::id();

    $lastInsertedId = Trn_Wellness_Booking_Invoice::insertGetId([
        'booking_id' => $request->booking_id,
        'wellness_id' => $request->wellness_id,
        'booking_invoice_number' => rand(50, 100),
        'invoice_date' => $request->invoice_date,
        'paid_amount' => $request->paid_amount,
        'payment_type' => $request->payment_type,
        'created_by' => $createdBy,
       
         ]);

    $leadingZeros = str_pad('', 3 - strlen($lastInsertedId), '0', STR_PAD_LEFT);
    $newBookingInvoiceNumber = 'BIN' . $leadingZeros . $lastInsertedId;

    Trn_Wellness_Booking_Invoice::where('id', $lastInsertedId)->update([
        'booking_invoice_number' => $newBookingInvoiceNumber
    ]);

    return redirect()->route('wellnessBilling.index');
}



}
