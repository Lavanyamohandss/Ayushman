@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">Create Branch</h3>
            </div>
            <!-- Success message -->
            <div class="col-lg-12 card-background" style="background-color:#fff";>
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
               <form action="{{ route('branches.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Branch Name*</label>
                           <input type="text" class="form-control" required name="branch_name" value="{{old('branch_name')}}" maxlength="100" placeholder="Branch Name">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Branch Address*</label>
                           <textarea class="form-control" required name="branch_address"  placeholder="Branch Address">{{old('branch_address')}}</textarea>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Branch Contact Number</label>
                           <input type="text" class="form-control"  name="branch_contact_number" value="{{old('branch_contact_number')}}" placeholder="Branch Contact Number" pattern="[0-9]{10}" title="Please enter digits only" oninput="validateInput(this)">
                           <p class="error-message" style="color: green; display: none;">Only numbers are allowed.</p>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Branch Email</label>
                           <input type="email" class="form-control"  name="branch_email"  id="contact_email" maxlength="100" value="{{old('branch_email')}}" placeholder="Branch Email">
                           <div class="text-danger" id="email-error"></div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Branch Admin Name</label>
                           <input type="text" class="form-control"  name="branch_admin_name" value="{{old('branch_admin_name')}}" maxlength="100" placeholder="Branch Admin Name">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Branch Admin Contact Number</label>
                           <input type="text" class="form-control" name="branch_admin_contact_number" value="{{old('branch_admin_contact_number')}}" placeholder="Branch Admin Contact Number" pattern="[0-9]+" title="Please enter digits only" oninput="validateInput(this)">
                           <p class="error-message" style="color: green; display: none;">Only numbers are allowed.</p>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Latitude*</label>
                            <input type="text" class="form-control" required name="latitude" value="{{ old('latitude') }}" placeholder="Latitude" 
                                oninput="validateNumericInput(this, 10);">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Longitude*</label>
                            <input type="text" class="form-control" required name="longitude" value="{{ old('longitude') }}" placeholder="Longitude" 
                                oninput="validateNumericInput(this, 10);">
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
                        <a class="btn btn-danger" href="{{route('branches')}}">Cancel</a>
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
<script>
   function validateNumericInput(input, maxLength) {
       // Remove non-numeric characters and multiple periods using regular expression
       input.value = input.value.replace(/[^0-9.]+/g, '');

       // Check if the input length exceeds the maxLength
       if (input.value.length > maxLength) {
           input.value = input.value.slice(0, maxLength); // Truncate to maxLength
       }
   }
</script>

@endsection