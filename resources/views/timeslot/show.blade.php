@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Timeslot Details</h3>
    
    <div class="show-container">
    
        <p><strong>Staff Name:</strong> {{ $show->Doctor->staff_name }}</p>
        <p><strong>Day:</strong> {{ $show->weekDay->master_value }}</p>
        <p><strong>Time From:</strong> {{ \Carbon\Carbon::createFromFormat('H:i:s', $show->time_from)->format('h:i A') }}</p>
        <p><strong>Time To:</strong> {{ \Carbon\Carbon::createFromFormat('H:i:s', $show->time_to)->format('h:i A') }}</p>
        <p><strong>Average Time For Patient:</strong> {{ $show->avg_time_patient }}</p>
        <p><strong>No. of tokens:</strong> {{ $show->no_tokens }}</p>
        <p><strong>Available Status:</strong> {{ $show->is_available }}</p>

        <a class="btn btn-secondary ml-2" href="{{ route('timeslot.index') }}">
            <i class="fa fa-times" aria-hidden="true"></i> Back
        </a>
       
    </div>
</div>
@endsection
