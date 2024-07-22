@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<div class="container">
    <div class="row" style="min-height: 70vh;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 card-title">Create Wellness</h3>
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
                    <form action="{{ route('wellness.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Wellness Name*</label>
                                    <input type="text" class="form-control" required name="wellness_name"
                                        value="{{ old('wellness_name') }}" placeholder="Wellness Name" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Wellness Description*</label>
                                    <textarea class="form-control" name="wellness_description" required name="wellness_description"
                                        placeholder="Wellness Description">{{ old('wellness_description') }}</textarea>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Wellness Cost*</label>
                                    <input type="text" class="form-control" required name="wellness_cost"
                                        value="{{ old('wellness_cost') }}" placeholder="Wellness Cost" oninput="validateDecimalInput(this)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Wellness Duration*</label>
                                    <input type="text" class="form-control" name="wellness_duration" required
                                        value="{{ old('wellness_duration') }}" placeholder="Wellness Duration" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" value="{{ old('remarks') }}"
                                        placeholder="Remarks">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group checkbox">
                                    <label for="branch_id" class="form-label">Branch*</label>
                                    <select class="multi-select"  name="branch[]" multiple style="width: 100%;">
                                      
                                        @foreach($branch as $id => $branchName)
                                            <option value="{{ $id }}">{{ $branchName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Wellness Inclusions*</label>
                                    <textarea class="form-control" name="wellness_inclusions" id="wellnessInclusion" required name="wellness_inclusions"
                                         placeholder="Wellness Inclusions">{{ old('wellness_inclusions') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Wellness T&C*</label>
                                    <textarea class="form-control" name="wellness_terms_conditions" id="termsandCondition" required name="wellness_terms_conditions"
                                        placeholder="Wellness T&C">{{ old('wellness_terms_conditions') }}</textarea>
                                </div>
                            </div>

                          
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label">Status</div>
                                    <label class="custom-switch">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" id="is_active" name="is_active"
                                            onchange="toggleStatus(this)" class="custom-switch-input" checked>
                                        <span id="statusLabel" class="custom-switch-indicator"></span>
                                        <span id="statusText" class="custom-switch-description">Active</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-raised btn-primary">
                                    <i class="fa fa-check-square-o"></i> Add
                                </button>
                                <button type="reset" class="btn btn-raised btn-success">Reset</button>
                                <a class="btn btn-danger" href="{{ route('wellness.index') }}">Cancel</a>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('wellnessInclusion', {
            removePlugins: 'image',
           
        });

        $(document).ready(function() {
        CKEDITOR.replace('termsandCondition', {
            removePlugins: 'image',
           
        });

      });

    function toggleStatus(checkbox) {
        if (checkbox.checked) {
            $("#statusText").text('Active');
            $("input[name=is_active]").val(1);
        } else {
            $("#statusText").text('Inactive');
            $("input[name=is_active]").val(0);
        }

    }
});
 //js for dropdown:
 $(document).ready(function() {
    //alert(1);
   
    $('.select2').select2();
});

    
</script>
<script>
    function validateDecimalInput(input) {
        var numericValue = input.value.replace(/[^0-9.]/g, '').slice(0, 13);
        input.value = numericValue;

        var isValid = /^\d{1,10}(\.\d{1,2})?$/.test(numericValue);
        input.setCustomValidity(isValid ? '' : 'Please enter a valid decimal number (up to 10 digits before the decimal point and up to 2 digits after).');
        input.parentNode.querySelector('.error-message').style.display = isValid ? 'none' : 'block';
    }
</script>


