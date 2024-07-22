@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">Consultation Billing</h3>
            </div>
            <div class="card-body">
               @if ($message = Session::get('status'))
               <div class="alert alert-success">
                  <p></p>
               </div>
               @endif
            </div>
            <div class="col-lg-12">
               @if ($errors->any())
               <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
              <form action="{{ route('consultation_billing.store') }}" method="POST" enctype="multipart/form-data">
              @csrf


<div class="row">
<div class="form-group">
    <label for="booking_type_id">Booking Type</label>
    <select class="form-control" name="booking_type_id" id="booking_type_id">
        <option value="">Choose Booking Type</option>
        @foreach($bookingTypes as $id => $bookingTypes)
            <option value="{{ $id }}">{{ $bookingTypes }}</option>
        @endforeach
    </select>
</div>


                                <div class="form-group">
                                    <label for="patient_id">Patient</label>
                                    <select class="form-control" name="patient_id" id="patient_id">
                                        <option value="">Choose Patient</option>
                                        @foreach($patients as $id => $patient)
                                            <option value="{{ $id }}">{{ $patient }}</option>
                                        @endforeach
                                    </select>
                                </div> 

<div class="form-group">
    <label for="is_membership_available">Membership Status</label>
    <select class="form-control" name="is_membership_available" id="is_membership_available">
        <option value="">Is Membership Available</option>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
</div>


<div class="col-md-6">
    <label for="doctor_id">Doctor</label>
    <select class="form-control" name="doctor_id" id="doctor_id">
        <option value="">Select Doctor</option>
        @foreach($doctors as $id => $doctor)
            <option value="{{ $id }}">{{ $doctor }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-6">
    <label for="branch_id">Branch</label>
    <select class="form-control" name="branch_id" id="branch_id">
        <option value="">Choose Branch</option>
        @foreach($branches as $id => $branch)
            <option value="{{ $id }}">{{ $branch }}</option>
        @endforeach
    </select>
</div>


                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Booking Date</label>
                           <input type="date" class="form-control" required name="booking_date"  placeholder="Booking Date">
                        </div>
                     </div>



                 <div class="col-md-6">
                     <label for="time_slot_id">Time Slot</label>
                      <select class="form-control" name="time_slot_id" id="time_slot_id">
                        <option value="">Choose Time Slot</option>
                     @foreach($timeSlots as $id => $timeSlot)
                        <option value="{{ $id }}">{{ $timeSlot }}</option>
                     @endforeach
                      </select>
                 </div>


                     <div class="col-md-6">
                     <label for="booking_status_id">Booking Status</label>
                      <select class="form-control" name="booking_status_id" id="booking_status_id">
                        <option value="">Choose Booking Status</option>
                     @foreach($bookingStatus as $id => $bookingstatus)
                        <option value="{{ $id }}">{{ $bookingstatus }}</option>
                     @endforeach
                      </select>
                 </div>

                     <div class="col-md-6">
                     <label for="availability_id">Availability</label>
                      <select class="form-control" name="availability_id" id="availability_id">
                        <option value="">Choose Availability</option>
                     @foreach($availability as $id => $available)
                        <option value="{{ $id }}">{{ $available }}</option>
                     @endforeach
                      </select>
                 </div>


                     
                     <div class="col-md-6">
                     <label for="therapy_id">Therapy</label>
                      <select class="form-control" name="therapy_id" id="therapy_id">
                        <option value="">Choose Therapy</option>
                     @foreach($therapies as $id => $therapy)
                        <option value="{{ $id }}">{{ $therapy }}</option>
                     @endforeach
                      </select>
                 </div>

                 <div class="col-md-6">
                     <label for="wellness_id">Wellness</label>
                      <select class="form-control" name="wellness_id" id="wellness_id">
                        <option value="">Choose Wellness</option>
                     @foreach($wellness as $id => $wellnes)
                        <option value="{{ $id }}">{{ $wellnes }}</option>
                     @endforeach
                      </select>
                 </div>


            <div class="form-group">
               <label for="is_paid">Payment Status</label>
                  <select class="form-control" name="is_paid" id="is_paid">
                     <option value="">Is Paid</option>
                     <option value="1">Yes</option>
                     <option value="0">No</option>
                   </select>
            </div>

            <div class="form-group">
               <label for="is_otp_verified">Otp Verification Status</label>
                  <select class="form-control" name="is_otp_verified" id="is_otp_verified">
                     <option value="">Is Otp Verified</option>
                     <option value="1">Yes</option>
                     <option value="0">No</option>
                   </select>
            </div>

             <div class="col-md-6">
                     <label for="external_doctor_id">External Doctor</label>
                      <select class="form-control" name="external_doctor_id" id="external_doctor_id">
                        <option value="">Choose External Doctor</option>
                     @foreach($externalDoctors as $id => $externalDoctor)
                        <option value="{{ $id }}">{{ $externalDoctor }}</option>
                     @endforeach
                      </select>
                 </div>


                  <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Booking Fee</label>
                           <input type="text" class="form-control" required name="booking_fee"  placeholder="Booking Fee">
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Discount</label>
                           <input type="text" class="form-control" required name="discount"  placeholder="Discount">
                        </div>
                     </div>

                     <div class="form-group">
                       <label for="is_for_family_member">Is For Family Member</label>
                        <select class="form-control" name="is_for_family_member" id="is_for_family_member">
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                         </select>
                     </div>


             
  <!-- ... -->
                      
{{-- <div class="col-md-6">
   <div class="form-group">
      <div class="form-label">Status</div>
      <label class="custom-switch">
         <input type="hidden" name="is_active" value="0"> <!-- Hidden field for false value -->
         <input type="checkbox" id="is_active" name="is_active" onchange="toggleStatus(this)" class="custom-switch-input" checked>
         <span id="statusLabel" class="custom-switch-indicator"></span>
         <span id="statusText" class="custom-switch-description">Active</span>
      </label>
   </div>
</div>
</div> --}}

<!-- ... -->

                  


                        <div class="form-group">
                           <center>
                           <button type="submit" class="btn btn-raised btn-primary">
                           <i class="fa fa-check-square-o"></i> Add</button>
                           <button type="reset" class="btn btn-raised btn-success">
                           Reset</button>
                           <a class="btn btn-danger" href="{{route('consultation_billing.index')}}">Cancel</a>
                           </center>
                        </div>
                     </div>
                  </div>

               </form>

      </div>
   </div>
</div>


@endsection
@section('js')
{{-- <script>
    function toggleStatus(checkbox) {
        if (checkbox.checked) {
            $("#statusText").text('Active');
            $("input[name=is_active]").val(1); // Set the value to 1 when checked
        } else {
            $("#statusText").text('Inactive');
            $("input[name=is_active]").val(0); // Set the value to 0 when unchecked
        }
    }
</script> --}}


@endsection
