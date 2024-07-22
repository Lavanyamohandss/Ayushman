@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filter Therapy Bookings</h3>
            </div>
            <form action="">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="from-date">From Date:</label>
                            <input type="date" id="from-date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="to-date">To Date:</label>
                            <input type="date" id="to-date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <div>
                                <button type="submit" class="btn btn-secondary"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                                <a class="btn btn-secondary ml-2" href="{{ route('booking_type.therapyIndex') }}"><i class="fa fa-times" aria-hidden="true"></i> Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Therapy Bookings</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th class="wd-15p">SL.NO</th>
                                <th class="wd-15p">Booking Reference Number</th>
                                <th class="wd-20p">Booking Date</th>
                                <th class="wd-15p">Patient Name</th>
                                <th class="wd-15p">Doctor</th>
                                <th class="wd-15p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach($TherapyBookings as $booking)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $booking->booking_reference_number}}</td>
                                <td>{{ $booking->booking_date}}</td>
                                <td>{{ $booking->patient_name}}</td>
                                <td>{{ $booking->username}}</td>
                                <td>
                                
                                    <a class="btn btn-secondary" href="{{ route('booking_type.therapyShow',$booking->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
