@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Consultation Booking</h1>
    
    <div class="show-container">
    
            <p><strong>Booking Reference Number:</strong> {{$booking->booking_reference_number}}</p>
            <p><strong>Patient Name:</strong> {{ $booking->patient->patient_name }}</p>
            <p><strong>Doctor:</strong> {{ $booking->doctor->username }}</p>
            <p><strong>Branch:</strong> {{ $booking->branch->branch_name }}</p>
            <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
            <p><strong>Time Slot:</strong> {{ $booking->timeSlot->time_slot_name }}</p>
            <p><strong>Booking Status:</strong> {{ $booking->bookingStatus->status_name }}</p>


             <a class="btn btn-secondary ml-2" href="{{ route('booking_type.index') }}"><i class="fa fa-times" aria-hidden="true"></i>Back</a>
       
</div>

@endsection
