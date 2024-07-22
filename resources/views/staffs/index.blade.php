@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Search Staff</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('staffs.index') }}" method="GET">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="staff-code">Staff Code:</label>
                            <input type="text" id="staff-code" name="staff_code" class="form-control" value="{{ request('staff_code') }}">
                        </div>
                         <div class="col-md-4">
                            <label for="staff-name">Staff Name:</label>
                            <input type="text" id="staff-name" name="staff_name" class="form-control" value="{{ request('staff_name') }}">
                        </div>
                         <div class="col-md-4">
                            <label for="contact-number">Contact Number:</label>
                            <input type="text" id="contact-number" name="contact_number" class="form-control" value="{{ request('contact_number') }}">
                        </div>
                   </div>
                   <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="staff_type">Staff Type*</label>
                                <select class="form-control" name="staff_type" id="staff_type" onchange="toggleBookingFeeField()">
                                    <option value="">Select Staff Type</option>
                                    @foreach($stafftype as $masterId => $masterValue)
                                    <option value="{{ $masterId }}" {{ old('staff_type') == $masterId ? 'selected' : '' }}>
                                        {{ $masterValue }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select class="form-control" name="branch_id" id="branch_id">
                                    <option value="">Choose Branch</option>
                                    @foreach($branch as $id => $branchName)
                                    <option value="{{ $id }}"{{ old('branch_id') == $id ? 'selected' : '' }}>
                                        {{ $branchName }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                
                   
                       
                        <div class="col-md-12 d-flex align-items-end">
                           
                                <button type="submit" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button> &nbsp; &nbsp;
                                <a class="btn btn-primary" href="{{ route('staffs.index') }}"><i class="fa fa-times" aria-hidden="true"></i> Reset</a>
                          
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        <div class="card">

      
@if ($message = Session::get('success'))
               <div class="alert alert-success">
                  <p>{{$message}}</p>
               </div>
               @endif
                 @if ($message = Session::get('error'))
               <div class="alert alert-danger">
                  <p></p>
               </div>
               @endif
            <div class="card-header">
                <h3 class="card-title">List Staffs</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('staffs.create') }}" class="btn btn-block btn-info">
                    <i class="fa fa-plus"></i>
                    Create Staff
                </a>
                
               
                
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="wd-15p">SL.NO</th>
                                     <th class="wd-15p">Staff Code</th>
                                    <th class="wd-15p">Staff Type</th>
                                    <th class="wd-15p">Staff Name</th>
                                    <th class="wd-15p">Branch</th> 
                                    <th class="wd-15p">Contact Number</th>
                                    <th class="wd-15p">Qualification</th>
                                  
                                    <th class="wd-15p">Status</th>
                                    <th class="wd-15p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach($staffs as $staff)
                                <tr id="dataRow_{{ $staff->staff_id }}">
                                    <td>{{ ++$i }}</td>
                                     <td>{{ $staff->staff_code}}</td>
                                    <td>{{ $staff->staffType->master_value }}</td>
                                    <td>{{ $staff->staff_name}}</td>
                                    <td>{{ $staff->branch->branch_name ?? ''}}</td>
                                    <td>{{ $staff->staff_contact_number }}</td>
                                    <td>{{ $staff->staff_qualification}}</td>
                                     
                                    
                                    <td>
                                        <form action="{{ route('staffs.changeStatus', $staff->staff_id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                            <button type="submit"
                                                onclick="return confirm('Do you want to Change status?');"
                                                class="btn btn-sm @if($staff->is_active == 0) btn-danger @else btn-success @endif status-custom">
                                                @if($staff->is_active == 0)
                                                InActive
                                                @else
                                                Active
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                       
                                    <td>
                                        <a class="btn btn-primary btn-sm edit-custom"
                                            href="{{ route('staffs.edit', $staff->staff_id) }}"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true" ></i> Edit </a>
                                                   <a class="btn btn-secondary btn-sm" href="{{ route('staffs.show', $staff->staff_id) }}" style="    font-size: 0.65rem;
                                                    margin-right: 0;">
                                                   <i class="fa fa-eye" aria-hidden="true"></i> View</a>

                                        <form style="display: inline-block"
                                            action="{{ route('staffs.destroy', $staff->staff_id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" onclick="deleteData({{ $staff->staff_id }})"class="btn-danger btn-sm">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                        <br>
                                        @if($staff->staff_type == '20')
                                        <a class="btn btn-sm  btn-primary"
                                        href="{{ route('staff.slot', $staff->staff_id) }}" style="    font-size: 0.65rem;
                                        margin-right: 0;
                                        margin-top: 2px;"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>Slot</a>
                                            @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                
                <!-- TABLE WRAPPER -->
            </div>
            <!-- SECTION WRAPPER -->
        </div>
    </div>
</div>
<!-- ROW-1 CLOSED -->
@endsection

    <script>
    function deleteData(dataId) {
        swal({
                title: "Delete selected data?",
                text: "Are you sure you want to delete this data",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ route('staffs.destroy', '') }}/" + dataId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            // Handle the success response, e.g., remove the row from the table
                            if (response == '1') {
                                $("#dataRow_" + dataId).remove();
                                flashMessage('s', 'Data deleted successfully');
                            } else {
                                flashMessage('e', 'An error occured! Please try again later.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while deleting the staff.');
                        },
                    });
                } else {
                    return;
                }
            });
    }
    // Change status 
    function changeStatus(dataId) {
        swal({
                title: "Change Status?",
                text: "Are you sure you want to change the status?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ route('manufacturer.changeStatus', '') }}/" + dataId,
                        type: "patch",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response == '1') {
                                var cell = $('#dataRow_' + dataId).find('td:eq(2)');

                                if (cell.find('.btn-success').length) {
                                    cell.html('<button type="button" onclick="changeStatus(' + dataId + ')" class="btn btn-sm btn-danger">Inactive</button>');
                                } else {
                                    cell.html('<button type="button" onclick="changeStatus(' + dataId + ')" class="btn btn-sm btn-success">Active</button>');
                                }

                                flashMessage('s', 'Status changed successfully');
                            } else {
                                flashMessage('e', 'An error occurred! Please try again later.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while changing the qualification status.');
                        },
                    });
                }
            });
    }
    </script>



