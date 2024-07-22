@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Consultation Billing</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('consultation_billing.create') }}" class="btn btn-block btn-info">
                    <i class="fa fa-plus"></i>
                    Add Billing
                </a>
                
               
                
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="wd-15p">SL.NO</th>
                                    <th class="wd-15p">Booking Reference Number</th>
                                    <th class="wd-20p">Booking Type</th>
                                    <th class="wd-15p">Patient Name</th>
                                    <th class="wd-15p">Membership Status</th>
                                    <th class="wd-15p">Doctor</th>
                                    <th class="wd-15p">Branch</th>
                                    <th class="wd-15p">Booking Date</th>
                                    <th class="wd-15p">Time Slot</th>
                                    <th class="wd-15p">Booking Status</th>
                                    <th class="wd-15p">Availability</th>
                                    <th class="wd-15p">Therapy</th>
                                    <th class="wd-15p">Wellness</th>
                                    <th class="wd-15p">Payment Status</th>
                                    <th class="wd-15p">External Doctor</th>
                                    <th class="wd-15p">Booking Fee</th>
                                    <th class="wd-15p">Discount</th>
                                    <th class="wd-15p">Is For Family Member</th>
                                    {{-- <th class="wd-15p">Status</th> --}}
                                    <th class="wd-15p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp 
                                @foreach($billings as $billing)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $billing->booking_reference_number }}</td>
                                    <td>{{ $billing->bookingType->booking_type_name }}</td>
                                    <td>{{ $billing->patient->patient_name}}</td>
                                    <td>{{ $billing->is_membership_available}}</td>
                                    <td>{{ $billing->doctor->username}}</td>
                                    <td>{{ $billing->branch->branch_name}}</td>
                                    <td>{{ $billing->booking_date}}</td>
                                    <td>{{ $billing->timeSlot->time_slot_name}}</td>
                                    <td>{{ $billing->bookingStatus->status_name}}</td>
                                    <td>{{ $billing->availability_id}}</td>
                                    <td>{{ $billing->therapy->therapy_name}}</td>
                                    <td>{{ $billing->wellness->wellness_name}}</td>
                                    <td>{{ $billing->is_paid}}</td>
                                    <td>{{ $billing->externalDoctor->doctor_name}}</td>
                                    <td>{{ $billing->booking_fee}}</td>
                                    <td>{{ $billing->discount}}</td>
                                    <td>{{ $billing->is_for_family_member}}</td>

                                    {{-- <td>
                                        <form action="{{ route('consultation_billing.changeStatus', $billing->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                            <button type="submit"
                                                onclick="return confirm('Do you want to Change status?');"
                                                class="btn btn-sm @if($billing->is_active == 0) btn-danger @else btn-success @endif">
                                                @if($billing->is_active == 0)
                                                InActive
                                                @else
                                                Active
                                                @endif
                                            </button>
                                        </form>
                                    </td> --}}
                                       
                                    <td>
                                        <a class="btn btn-secondary"
                                            href="{{ route('consultation_billing.edit', $billing->id) }}"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                                        <form style="display: inline-block"
                                            action="{{ route('consultation_billing.destroy', $billing->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                                    aria-hidden="true"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                
                <!-- TABLE WRAPPER -->
            </div>
            <!-- SECTION WRAPPER -->
        </div>
    </div>
</div>
<!-- ROW-1 CLOSED -->
@endsection



