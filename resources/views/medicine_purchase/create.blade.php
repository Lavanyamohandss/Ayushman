@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row" style="min-height: 70vh;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 card-title">{{$pageTitle}}</h3>
                </div>
                <!-- Success message -->
                <div class="col-lg-12 card-background" style="background-color:#fff" ;>
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
                                    <label class="form-label">Supplier*</label>
                                    <select required class="form-control" name="supplier_id" id="supplier_id">
                                        <option value="">Choose Branch</option>
                                        @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('branch_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->supplier_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Branch*</label>
                                    <select required class="form-control" name="branch_id" id="branch_id">
                                        <option value="">Choose Branch</option>
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->branch_id }}" {{ old('branch_id') == $branch->branch_id ? 'selected' : '' }}>
                                            {{ $branch->branch_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Purchase Date</label>
                                    <input type="date" class="form-control" name="purchase_date" value="{{old('purchase_date')}}" placeholder="Purchase Date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Due Date</label>
                                    <input type="date" class="form-control" name="due_date" value="{{old('due_date')}}" placeholder="Due Date">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-label">Has free quantity</div>
                                    <label class="custom-switch">
                                        <input type="hidden" name="has_free_quantity" value="0"> <!-- Hidden field for false value -->
                                        <input type="checkbox" id="has_free_quantity" name="has_free_quantity" onchange="toggleStatus(this)" class="custom-switch-input" notchecked>
                                        <span id="statusLabel" class="custom-switch-indicator"></span>
                                        <span id="statusText" class="custom-switch-description">No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Notes</label>
                                    <input type="text" class="form-control" name="purchase_notes" value="{{old('purchase_notes')}}" placeholder="Notes">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Terms & Conditions</label>
                                    <input type="text" class="form-control" name="terms_and_conditions" value="{{old('terms_and_conditions')}}" placeholder="Terms & Conditions">
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
            $("#statusText").text('Yes');
            $("input[name=has_free_quantity]").val(1); // Set the value to 1 when checked
        } else {
            $("#statusText").text('No');
            $("input[name=has_free_quantity]").val(0); // Set the value to 0 when unchecked
        }
    }
</script>
<script>
    function validateInput(input) {
        var inputValue = input.value;
        var numberPattern = /^[0-9]*$/;

        if (!numberPattern.test(inputValue)) {
            input.setCustomValidity("Only numbers are allowed.");
            input.parentNode.querySelector('.error-message').style.display = 'block';
        } else {
            input.setCustomValidity("");
            input.parentNode.querySelector('.error-message').style.display = 'none';
        }
    }
</script>
@endsection