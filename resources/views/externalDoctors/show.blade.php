@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">View External Doctor</h3>
            </div>
            <div class="card-body">
               @if ($message = Session::get('status'))
               <div class="alert alert-success">
                  <p>{{ $message }}</p>
               </div>
               @endif
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
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">Doctor Name</label>
                        <input type="text" class="form-control" readonly name="doctor_name" value="{{ $show->doctor_name }}" placeholder="Doctor Name">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">Contact No</label>
                        <input type="text" class="form-control" readonly name="contact_no" value="{{ $show->contact_no }}" placeholder="Contact No">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control"  readonly name="contact_email" id="contact_email" value="{{ $show->contact_email }}" placeholder="Email">
                        <div class="text-danger" id="email-error"></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" readonly name="address" placeholder="Address">{{ $show->address }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">Remarks</label>
                        <textarea class="form-control" readonly name="remarks" placeholder="Remarks">{{ $show->remarks }}</textarea>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                         <label class="form-label">Commission(%)</label>
                         <input type="text" class="form-control"  readonly name ="commission" value="{{ $show->commission }}" placeholder="Commission">
                     </div>
                 </div>
               </div>
            
            <div class="row">
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
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <center>
                     <a class="btn btn-danger" href="{{ route('externaldoctors.index') }}">Back</a>
                  </center>
               </div>
            </div>

            </form>
			</div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
@section('js')
<script>
   $(document).ready(function() {
       $('#contact_email').on('input', function() {
           var emailInput = $(this).val();
           var emailErrorDiv = $('#email-error');
           
           if (emailInput.trim() === '' || isValidEmail(emailInput)) {
               emailErrorDiv.text('');
           } else {
               emailErrorDiv.text('Please enter a valid email address.');
           }
       });
       
       function isValidEmail(email) {
           var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
           return emailRegex.test(email);
       }
   });
</script>
@endsection