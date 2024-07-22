@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{$message}}</p>
        </div>
        @endif
        @if ($messages = Session::get('validation'))
            <div class="alert alert-danger">
               <ul>
                  @foreach (json_decode($messages, true) as $field => $errorMessages)
                  @foreach ($errorMessages as $errorMessage)
                  <li>{{$errorMessage}}</li>
                  @endforeach
                  @endforeach
               </ul>
            </div>
            @endif
            <div class="card-header">
                <h3 class="card-title"><strong>EMPLOYEE BRANCH TRANSFER</strong></h3>
            </div>
            <form action="{{ route('branchTransfer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="from_branch" class="form-label"> From Branch</label>
                                <select required class="form-control" name="from_branch" id="from_branch" onchange="loadEmployees()">
                                    <option value="">Choose Branch</option>
                                    @foreach($branch as $id => $branchName)
                                    <option value="{{ $id }}" {{ old('branch_id') == $id ? 'selected' : '' }}>
                                        {{ $branchName }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="to_branch" class="form-label"> To Branch</label>
                                <select required class="form-control" name="to_branch" id="to_branch">
                                    <option value="">Choose Branch</option>
                                    @foreach($branch as $id => $branchName)
                                    <option value="{{ $id }}" {{ old('branch_id') == $id ? 'selected' : '' }}>
                                        {{ $branchName }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="search-sec col-sm-12 float-left" style="display:flex;align-items:center;">
                        <div class="col-sm-12 col-md-5 float-left card mt-3">
                            <div class="card-header" style="padding-top: 10px; padding-bottom:10px">
                                <h6 class="mb-0 card-title" style="width:95%">Employees </h6>
                            </div>
                            <div class="content vscroll h-200 mt-1">
                                <div class="table-responsive" id="employee_list">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2 float-left waves_btn_sec " style="">
                            <div class="btn_wrap" style="text-align:center;">
                                <button type="button" onclick="transferEmployees()" class="btn btn-info waves-effect waves-light" tabindex="4"> >> </button>
                            </div>
                            <div class="btn_wrap mt-7" style="text-align:center;">
                                <button type="button" onclick=" transferEmployeesBack()" id="transfer_back_button" ng-click="UnAssignActivity()" my-click-once class="btn btn-info waves-effect waves-light" tabindex="5">
                                    << </button>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-5 float-left card mt-3">
                            <div class="card-header" style="padding-top: 10px; padding-bottom:10px">
                                <h6 class="mb-0 card-title" style="width:95%">Transferred Employees</h6>
                            </div>
                            <div class="content vscroll h-200">
                                <div class=" table-responsive " id="transferred_employee_list" ng-show="CategoryActivityList.length>0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div>
                            <button type="submit" class="btn btn-raised btn-primary">
                                <i class="fa fa-check-square-o"></i>Save
                            </button>
                            <a class="btn btn-primary" href="{{ route('branchTransfer.index') }}">
                                <i class="fa fa-times" aria-hidden="true"></i> Close
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // This function will be triggered when the "From Branch" selection changes
    function loadEmployees() {
        var fromBranchId = $("#from_branch").val();
        // Make an AJAX request to fetch employees based on the selected branch
        $.ajax({
            url: '/get-employees/' + fromBranchId,
            method: 'GET',
            success: function(data) {
                // Clear the current list of employees
                $("#employee_list").empty();
                // Append the fetched employees to the list
                $.each(data, function(index, employee) {
                    console.log(employee);
                    var checkbox = $('<input type="checkbox" name="coming_staff_id[]" onclick="valEmployee.call(this)" class="chck_btn get-staff-val" style="display:inline;">')
                        .data('staff_id', employee.staff_id);
                    var label = $('<label class="ng-binding" style="display:inline;">').text(employee.staff_name);
                    var row = $('<tr>').append($('<td>').append(checkbox, label));
                    $("#employee_list").append(row);
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            }
        });
        $("#transferred_employee_list").empty();
    }

    function transferEmployees() {
        // Get the selected employees from the "From Branch" container
        var selectedEmployees = [];
        $("input[type=checkbox]:checked", "#employee_list").each(function() {
            var labelText = $(this).closest('tr').find('label').text();
            var staff_id = $(this).data('staff_id');

            selectedEmployees.push({
                label: labelText,
                id: staff_id
            });

            // Remove the selected employee row from the "From Branch" container
            $(this).closest('tr').remove();
        });

        // Append the selected employees to the "To Branch" container
        $.each(selectedEmployees, function(index, employee) {
            var checkbox = $('<input type="checkbox" onclick="valStaff.call(this)" class="chck_btn" style="display:inline;">')
                .val(employee.id);
            // Set the checkbox value to the id
            var label = $('<label class="ng-binding" style="display:inline;">').text(employee.label);
            var hiddenInput = $('<input type="hidden" name="transfered_staff_id[]">').val(employee.id);

            var row = $('<tr>').append($('<td>').append(checkbox, label, hiddenInput));
            $("#transferred_employee_list").append(row);
        });
    }


    function transferEmployeesBack() {
        // Get the selected employees from the "Transferred Employees" container
        var selectedEmployees = [];
        $("#transferred_employee_list input[type=checkbox]:checked").each(function() {
            var checkbox = $(this);
            var staff_id = checkbox.val();
            // Store the staff_id as a data attribute in the checkbox
            checkbox.data('staff_id', staff_id);
            selectedEmployees.push(checkbox.closest('tr')); // Store the whole row
        });

        // Append the selected employees back to the "Employees" container
        $.each(selectedEmployees, function(index, employeeRow) {
            var checkbox = $('<input type="checkbox" class="chck_btn" name="transfer_back_staff_id[]" onclick="backCodeStaff.call(this)" style="display:inline;">')
                .val(employeeRow.find('input[type=checkbox]').val())
                .data('staff_id', employeeRow.find('input[type=checkbox]').data('staff_id')); // Retrieve staff_id from data attribute
            // var hiddenInput = $('<input type="hidden" name="transfered_staff_id">').val(employee.id);
            var label = $('<label class="ng-binding" style="display:inline;">').text(employeeRow.find('label').text());
            var row = $('<tr>').append($('<td>').append(checkbox, label));
            $("#employee_list").append(row);
            // Remove the selected employee row from the "Transferred Employees" container
            employeeRow.remove();
        });
    }

    function backCodeStaff() {
        // 'this' refers to the clicked checkbox element
        var staff_id = $(this).data('staff_id');
        // alert(staff_id);
    }

    // Event handling to trigger the transfer back operation
    $(document).ready(function() {
        $("#transfer_back_button").click(function() {
            transferEmployeesBack();
        });
    });
</script>

@endsection