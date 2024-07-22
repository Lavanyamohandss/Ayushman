@extends('layouts.app')
@section('content')
<div class="container">
<div class="row" style="min-height: 70vh;">
<div class="col-md-12">
   <div class="card">
      <div class="card-header">
         <h3 class="mb-0 card-title">Edit Patient</h3>
      </div>
     
      <div class="col-lg-12" style="background-color: #fff;">
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
         <form action="{{route('patients.update',['id'=>$patient->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Name</label>
                     <input type="text" class="form-control" required name="patient_name" maxlength="100" value="{{$patient->patient_name}}" placeholder="Patient Name">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Email</label>
                     <input type="email" class="form-control" name="patient_email" maxlength="200" value="{{$patient->patient_email}}"  placeholder="Patient Email">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Mobile</label>
                     <input type="text" class="form-control" required name="patient_mobile" value="{{$patient->patient_mobile}}"  placeholder="Patient Mobile"  maxlength="10" oninput="validateInput(this)">
                     <p class="error-message" style="color: red; display: none;">Only numbers are allowed.</p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Address</label>
                     <input type="text" class="form-control" name="patient_address" value="{{$patient->patient_address}}"  placeholder="Patient Address">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="patient_gender" class="form-label">Gender</label>
                     <select class="form-control" name="patient_gender" id="patient_gender">
                        <option value="">Choose Gender</option>
                        @foreach($gender as $genderId => $genderName)
                        <option value="{{ $genderId }}"{{ $genderId == $patient->patient_gender ? ' selected' : '' }}>
                        {{ $genderName }}
                        </option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label" class="form-label">Date Of Birth</label>
                     <input type="date" class="form-control" name="patient_dob" value="{{$patient->patient_dob}}">
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="form-group">
                     <label for="patient_blood_group_id" class="form-label">Blood Group*</label>
                     <select class="form-control" name="patient_blood_group_id" id="patient_blood_group_id">
                        <option value="">Choose Blood Group</option>
                        @foreach($bloodgroup as $id => $bloodgroup)
                        <option value="{{ $id }}"{{ $id == $patient->patient_blood_group_id ? ' selected' : '' }}>{{ $bloodgroup }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Emergency Contact Person*</label>
                     <input type="text" class="form-control" name="emergency_contact_person" required name="emergency_contact_person" maxlength="100" value="{{$patient->emergency_contact_person}}" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Emergency Contact *</label>
                     <input type="text" class="form-control" name="emergency_contact"  required name="emergency_contact" value="{{$patient->emergency_contact}}"  maxlength="10" oninput="validateInput(this)">
                     <p class="error-message" style="color: red; display: none;">Only numbers are allowed.</p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Marital Status</label>
                     <select class="form-control" name="marital_status" id="marital_status">
                        <option value="">Choose Maritial Status</option>
                        @foreach($maritialstatus as $masterId => $masterValue)
                        <option value="{{ $masterId }}"{{ $masterId == $patient->maritial_status ? ' selected' : '' }}>{{ $masterValue }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Registration Type</label>
                     <select class="form-control" name="patient_registration_type" id="patient_registration_type">
                        <option value="">Choose Registration Type</option>
                        <option value="Self" @if($patient->patient_registration_type === 'Self') selected @endif>Self</option>
                        <option value="Online" @if($patient->patient_registration_type === 'Online') selected @endif>Online</option>
                     </select>
                  </div>
               </div>
            
           
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Whatsapp Number</label>
                     <input type="text" class="form-control" name="whatsapp_number" value="{{$patient->whatsapp_number}}" placeholder="Whatsapp Number"  maxlength="10" oninput="validateInput(this)">
                     <p class="error-message" style="color: red; display: none;">Only numbers are allowed.</p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Medical History</label>
                     <textarea class="form-control" required name="patient_medical_history" id="medicalHistory">{{$patient->patient_medical_history}}</textarea>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Current Medication</label>
                     <textarea class="form-control" required name="patient_current_medications" id="currentMedication">{{ $patient->patient_current_medications }}</textarea>
                  </div>
               </div>
            </div>
           
               <!-- ... -->
               <div class="col-md-12">
                  <div class="form-group">
                     <div class="form-label">Status</div>
                     <label class="custom-switch">
                     <input type="checkbox" id="is_active" name="is_active" onchange="toggleStatus(this)" class="custom-switch-input" @if($patient->is_active) checked @endif>
                     <span id="statusLabel" class="custom-switch-indicator"></span>
                     <span id="statusText" class="custom-switch-description">
                     @if($patient->is_active)
                     Active
                     @else
                     Inactive
                     @endif
                     </span>
                     </label>
                  </div>
               </div>
               <!-- ... -->
               <div class="col-md-12">
                  <div class="form-group">
                     <center>
                        <button type="submit" class="btn btn-raised btn-primary">
                        <i class="fa fa-check-square-o"></i> update</button>
                        <button type="reset" class="btn btn-raised btn-success">
                        Reset</button>
                        <a class="btn btn-danger" href="{{route('patients.index')}}">Cancel</a>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('medicalHistory', {
            removePlugins: 'image',
           
        });

        $(document).ready(function() {
        CKEDITOR.replace('currentMedication', {
            removePlugins: 'image',
           
        });

        });
      });
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
   function validateInput(input) {
       var inputValue = input.value;

       // Remove any non-numeric characters from the input
       var numericValue = inputValue.replace(/[^0-9]/g, '');

       // Ensure the input does not exceed 10 characters
       if (numericValue.length > 10) {
           // Truncate the input to the first 10 digits
           numericValue = numericValue.slice(0, 10);
       }

       // Update the input value with the numeric value
       input.value = numericValue;

       // Check if the resulting value has exactly 10 digits
       if (numericValue.length !== 10) {
           input.setCustomValidity("Please enter exactly 10-digit numbers.");
           input.parentNode.querySelector('.error-message').style.display = 'block';
       } else {
           input.setCustomValidity("");
           input.parentNode.querySelector('.error-message').style.display = 'none';
       }
   }
</script>

