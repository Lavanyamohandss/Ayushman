@extends('layouts.app')
@section('content')
<div class="container">
<div class="row" style="min-height: 70vh;">
<div class="col-md-12">
   <div class="card">
      <div class="card-header">
         <h3 class="mb-0 card-title">Show Patient Details</h3>
      </div>
      <div class="col-lg-12" style="background-color:#fff;">
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
         
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Name</label>
                     <input type="text" class="form-control" readonly name="patient_name"  value="{{$show->patient_name}}" placeholder="Patient Name">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Email</label>
                     <input type="email" class="form-control" readonly name="patient_email" value="{{$show->patient_email}}"  placeholder="Patient Email">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Mobile</label>
                     <input type="text" class="form-control" readonly name="patient_mobile" value="{{$show->patient_mobile}}"  placeholder="Patient Mobile">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Address</label>
                     <input type="text" class="form-control" readonly name="patient_address" value="{{$show->patient_address}}"  placeholder="Patient Address">
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="form-group">
                     <label for="patient_gender">Gender</label>
                      <input type="text" class="form-control" readonly name="patient_gender" value="{{$show->gender->master_value}}">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Date Of Birth</label>
                     <input type="date" class="form-control" readonly name="patient_dob" value="{{$show->patient_dob}}">
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="form-group">
                     <label for="patient_blood_group_id" class="form-label">Blood Group</label>
                      <input type="text" class="form-control" readonly name="patient_blood_group_id" value="{{$show->bloodGroup->master_value}}" placeholder=" Blood Group">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Emergency Contact Person</label>
                     <input type="text" class="form-control" readonly name="emergency_contact_person" required name="emergency_contact_person" value="{{$show->emergency_contact_person}}" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Emergency Contact </label>
                     <input type="text" class="form-control" readonly name="emergency_contact"  required name="emergency_contact" value="{{$show->emergency_contact}}" >
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Marital Status</label>
                     <input type="text" class="form-control" readonly name="maritial_status" value="{{$show->maritialStatus->master_value}}" placeholder=" Marital Status">
                  </div>
               </div>
            </div>
            
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Registration Type</label>
                     <input type="text" class="form-control" readonly name="patient_registration_type" value="{{$show->patient_registration_type}}" placeholder=" Patient Registration Type">
                  </div>
               </div>
                <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Whatsapp Number</label>
                     <input type="text" class="form-control" readonly name="whatsapp_number" value="{{$show->whatsapp_number}}" placeholder="Whatsapp Number">
                  </div>
               </div>
            </div>
			<div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Medical History</label>
                     <textarea class="form-control" readonly name="patient_medical_history" id="medicalHistory">{{$show->patient_medical_history}}</textarea>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-label">Patient Current Medication</label>
                     <textarea class="form-control" readonly name="patient_current_medications" id="currentMedication">{{ $show->patient_current_medications }}</textarea>
                  </div>
               </div>
            </div>
          
              
              <div class="col-md-12">
    <div class="form-group">
        <label class="form-label">Status</label>
        <button type="button" class="status-button @if($show->is_active) statusActive @else statusInActive  @endif" disabled>
            @if($show->is_active)
                Active
            @else
                Inactive
            @endif
        </button>
    </div>
</div>

               <div class="col-md-12">
                  <div class="form-group">
                     <center>
                        <a class="btn btn-danger" href="{{route('patients.index')}}">Back</a>
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
@endsection