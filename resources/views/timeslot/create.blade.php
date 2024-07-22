@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">Create Timeslot</h3>
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
               <form action="{{ route('timeslot.store') }}" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                   <div class="col-md-6">
                     <div class="form-group">
                        <label for="staff_id" class="form-label">Staff*</label>
                        <select class="form-control" name="staff" id="staff_id">
                           <option value="">Choose Staff</option>
                           @foreach($doctors as $id => $doctor)
                           <option value="{{ $id }}"{{ old('staff') == $id ? 'selected' : '' }}>{{ $doctor }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>


                  <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Week Day*</label>
                                    <select class="form-control" name="week_day" id="week_day">
                                        <option value="">Select Day</option>
                                        @foreach($weekday as $masterId => $masterValue)
                                        <option value="{{ $masterId }}"{{ old('week_day') == $masterId ? 'selected' : '' }}>{{ $masterValue }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                   

                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Time From*</label>
                                <input type="time" class="form-control" required name="time_from" oninput="validateTime()" value="{{ old('time_from') }}" placeholder="Time From">
                            </div>
                        </div>


                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Time To*</label>
                                <input type="time" class="form-control" required name="time_to" oninput="validateTime()" value="{{ old('time_to') }}" placeholder="Time To">
                                <div class="text-danger" id="time-validation-error"></div>
                            </div>
                        </div>


                       <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Average Time Patients*</label>
                           <input type="text" class="form-control" required name="avg_time_patient" value="{{ old('avg_time_patient') }}" placeholder="Average Time ">
                        </div>
                     </div>

                      <div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Is Available*</label>
        <select class="form-control" name="is_available">
            <option value="">Select Availability Status</option>
            <option value="No" @if(old('is_available') === 'No') selected @endif>No</option>
            <option value="Yes" @if(old('is_available') === 'Yes') selected @endif>Yes</option>
        </select>
    </div>
</div>

                  </div>
  <!-- ... -->
                      
<div class="col-md-6">
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
</div>

<!-- ... -->

                  


                        <div class="form-group">
                           <center>
                           <button type="submit" class="btn btn-raised btn-primary">
                           <i class="fa fa-check-square-o"></i> Add</button>
                           <button type="reset" class="btn btn-raised btn-success">
                           Reset</button>
                           <a class="btn btn-danger" href="{{route('timeslot.index')}}">Cancel</a>
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
<script>
    function toggleStatus(checkbox) {
        if (checkbox.checked) {
            $("#statusText").text('Active');
            $("input[name=is_active]").val(1); // Set the value to 1 when checked
        } else {
            $("#statusText").text('Inactive');
            $("input[name=is_active]").val(0); // Set the value to 0 when unchecked
        }
    }
</script>

<script>
    
    function validateTime() {
        const timeFrom = document.querySelector('input[name="time_from"]').value;
        const timeTo = document.querySelector('input[name="time_to"]').value;
        const validationError = document.getElementById('time-validation-error');

        if (timeFrom > timeTo) {
            validationError.textContent = 'Time To should be greater than Time From.';
        } else {
            validationError.textContent = '';
        }
    }
</script>


@endsection
