@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="min-height: 70vh;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 card-title">Edit External Doctor</h3>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('status'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

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

                    <form action="{{ route('externaldoctors.update', ['id' => $doctor->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Doctor Name</label>
                                    <input type="text" class="form-control" required name="doctor_name" maxlength="100" value="{{ $doctor->doctor_name }}" placeholder="Doctor Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Contact No</label>
                                    <input type="text" class="form-control" required name="contact_no" value="{{ $doctor->contact_no }}" placeholder="Contact No" pattern="[0-9]{10}" title="Please enter digits only" oninput="validateInput(this)">
                                    <p class="error-message" style="color: red; display: none;">Only numbers are allowed.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                     <input type="email" class="form-control"  name="contact_email" maxlength="100" id="contact_email" value="{{ $doctor->contact_email }}" placeholder="Email">
                                      <div class="text-danger" id="email-error"></div>
                                </div>
                            </div>
                       
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control"  name="address" placeholder="Address">{{ $doctor->address }}</textarea>
                                </div>
                            </div>
                        </div>  
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control"  name="remarks" placeholder="Remarks">{{ $doctor->remarks }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Commission(%)</label>
                                    <input type="text" class="form-control"  required name ="commission" value="{{ $doctor->commission }}" placeholder="Commission" maxlength="3" oninput="validateCommission(this);">
                                </div>
                            </div>
                        
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label">Status</div>
                                    <label class="custom-switch">
                                        <input type="checkbox" id="is_active" name="is_active" onchange="toggleStatus(this)" class="custom-switch-input" {{ $doctor->is_active ? 'checked' : '' }}>
                                        <span id="statusLabel" class="custom-switch-indicator"></span>
                                        <span id="statusText" class="custom-switch-description">
                                            @if($doctor->is_active)
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <center>
                                    <button type="submit" class="btn btn-raised btn-primary">
                                        <i class="fa fa-check-square-o"></i> Update
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('externaldoctors.index') }}">Cancel</a>
                                </center>
                            </div>
                        </div>
                    </form>
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

    function validateCommission(input) {
        // Remove any non-numeric characters from the input
        input.value = input.value.replace(/[^0-9]/g, '');

        // Ensure the value is within the min and max limits
        var numericValue = parseInt(input.value, 10);
        if (isNaN(numericValue)) {
            input.value = ''; // Clear the input if it's not a valid number
        } else if (numericValue < 0) {
            input.value = '0'; // Set to the minimum value (0) if it's below 0
        } else if (numericValue > 100) {
            input.value = '100'; // Set to the maximum value (100) if it's above 100
        }
    }
</script>
@endsection


