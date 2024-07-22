@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Search Wellness</h3>
    </div>
    <form action="{{ route('wellness.index') }}" method="GET">
        <div class="card-body">
            <div class="row mb-6">
                <div class="col-md-6">
                    <label class="form-label">Wellness Name: </label>
                    <input type="text" id="wellness-name" name="wellness_name" class="form-control" value="{{ request('wellness_name') }}">
                </div>
              
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Branch: </label>
                        <select class="form-control" name="branch_id" id="branch_id">
                            <option value="">Choose Branch</option>
                            @foreach($branches as $id => $name)
                                <option value="{{ $id }}"{{ request('branch_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
            <div class="col-md-3 d-flex align-items-end">
                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-filter" aria-hidden="true"></i> Filter
                    </button>
                    <a class="btn btn-primary" href="{{ route('wellness.index') }}">
                        <i class="fa fa-times" aria-hidden="true"></i> Reset
                    </a>
                </div>
                </div>
            </div>
        </div> 
    </form>
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
                <h3 class="card-title">Manage Wellness</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('wellness.create') }}" class="btn btn-block btn-info">
                    <i class="fa fa-plus"></i>
                    Create Wellness
                </a>
                
               
                
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="wd-15p">SL.NO</th>
                                    <th class="wd-15p">Wellness Name</th>
                                    <th class="wd-15p">Wellness Cost</th>
                                    <th class="wd-20p">Status</th>
                                    <th class="wd-15p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach($wellness as $wellnes)
                                <tr id="dataRow_{{$wellnes->wellness_id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $wellnes->wellness_name }}</td>      
                                    <td>{{ $wellnes->wellness_cost }}</td>
                                 

                                    <td>
                                        <button type="button" onclick="changeStatus({{$wellnes->wellness_id }})" class="btn btn-sm @if($wellnes->is_active == 0) btn-danger @else btn-success @endif">
                                            @if($wellnes->is_active == 0)
                                            InActive
                                            @else
                                            Active
                                            @endif
                                        </button>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm edit-custom"
                                            href="{{ route('wellness.edit', $wellnes->wellness_id) }}"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                                        <a class="btn btn-secondary btn-sm" href="{{ route('wellness.show', $wellnes->wellness_id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                        <form style="display: inline-block"
                                            action="{{ route('wellness.destroy', $wellnes->wellness_id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" onclick="deleteData({{$wellnes->wellness_id }})"class="btn-danger btn-sm">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
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
                        url: "{{ route('wellness.destroy', '') }}/" + dataId,
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
                            alert('An error occurred while deleting the wellness.');
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
                        url: "{{ route('wellness.changeStatus', '') }}/" + dataId,
                        type: "patch",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response == '1') {
                                var cell = $('#dataRow_' + dataId).find('td:eq(3)');

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
                            alert('An error occurred while changing the therapy status.');
                        },
                    });
                }
            });
    }
    </script>



