@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Search Therapy Room</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('therapyrooms.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select class="form-control" name="branch_id" id="branch_id">
                                    <option value="">Choose Branch</option>
                                    @foreach($branch as $id => $branchName)
                                    <option value="{{ $id }}" {{ old('branch_id') == $id ? 'selected' : '' }}>
                                        {{ $branchName }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-end">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>&nbsp;&nbsp;
                                <a class="btn btn-primary" href="{{ route('therapyrooms.index') }}"><i class="fa fa-times" aria-hidden="true"></i> Reset</a>
                            </div>
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
        <p>{{$message}}</p>
    </div>
    @endif
    <div class="card-header">
        <h3 class="card-title">{{$pageTitle}}</h3>
    </div>
    <div class="card-body">
        <a href="{{ route('therapyrooms.create') }}" class="btn btn-block btn-info">
            <i class="fa fa-plus"></i>
            Create Therapy Room
        </a>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                <thead>
                    <tr>
                        <th class="wd-15p">SL.NO</th>
                        <th class="wd-15p">Branch</th>
                        <th class="wd-20p">Room Name</th>
                        <!-- <th class="wd-20p">Room Type</th>
                                    <th class="wd-20p">Room Capacity</th> -->
                        <th class="wd-20p">Room Assigning</th>
                        <th class="wd-15p">Status</th>
                        <th class="wd-15p">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 0;
                    @endphp
                    @foreach($therapyrooms as $therapyroom)
                    <tr id="dataRow_{{ $therapyroom->id }}">
                        <td>{{ ++$i }}</td>
                        <td>{{ $therapyroom->branch->branch_name }}</td>
                        <td>{{ $therapyroom->room_name }}</td>
                        <!-- <td>{{ $therapyroom->roomType->master_value}}</td>
                                    <td>{{ $therapyroom->room_capacity }}</td> -->

                        <td>
                            <a class="btn btn-sm  btn-outline-success " href="{{ route('therapyroomassigning.index', $therapyroom->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>RoomAssigning</a>
                        </td>
                        <td>
                            <button type="button" onclick="changeStatus({{ $therapyroom->id }})" class="btn btn-sm @if($therapyroom->is_active == 0) btn-danger @else btn-success @endif">
                                @if($therapyroom->is_active == 0)
                                InActive
                                @else
                                Active
                                @endif
                            </button>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm edit-custom" href="{{ route('therapyrooms.edit', $therapyroom->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                            <button type="button" onclick="deleteData({{ $therapyroom->id }})" class="btn-danger btn-sm">
                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                            </button>
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
                        url: "{{ route('therapyrooms.destroy', '') }}/" + dataId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            // Handle the success response, e.g., remove the row from the table
                            if (response == '1') {
                                $("#dataRow_" + dataId).remove();
                                i = 0;
                                $("#example tbody tr").each(function() {
                                    i++;
                                    $(this).find("td:first").text(i);
                                });
                                flashMessage('s', 'Data deleted successfully');
                            } else {
                                flashMessage('e', 'An error occured! Please try again later.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while deleting the qualification.');
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
                        url: "{{ route('therapyrooms.changeStatus', '') }}/" + dataId,
                        type: "patch",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response == '1') {
                                var cell = $('#dataRow_' + dataId).find('td:eq(4)');

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