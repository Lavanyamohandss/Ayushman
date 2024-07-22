@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Patient Details</h1>
    
    <div class="show-container">
    
        <p><strong>Patient Code:</strong> {{ $patient->patient->patient_code }}</p>
        <p><strong>Patient Name:</strong> {{ $patient->patient->patient_name }}</p>
        <p><strong>Doctor:</strong> {{ $patient->doctor->username }}</p>
        <p><strong>Branch:</strong> {{ $patient->branch->branch_name }}</p>
        <p><strong>Booking Date:</strong> {{ $patient->booking_date }}</p>
        <p><strong>Time Slot:</strong> {{ $patient->timeSlot->time_slot_name }}</p>
        <p><strong>Booking Status:</strong> {{ $patient->bookingStatus->status_name }}</p>
        <p><strong>Booking Fee:</strong> {{ $patient->booking_fee}}</p>

           <a class="btn btn-secondary ml-2" href="{{ route('patient_search.index') }}"><i class="fa fa-times" aria-hidden="true"></i> Back</a>

       
</div>

@endsection
