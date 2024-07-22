@extends('layouts.app')

@section('content')
<div class="row">
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
            <h3 class="card-title"> {{$pageTitle}}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('therapyroomassigning.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="branch_id" name="branch_id" value="{{$branch_id}}">
                <input type="hidden" id="therapy_room_id" name="therapy_room_id" value="{{$id}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Staff*</label>
                            <select class="form-control" name="assigned_staff_id" id="assigned_staff_id">
                                <option value="">Select staff</option>
                                @foreach($staffs as $staff)
                                <option value="{{ $staff->staff_id }}">{{ $staff->staff_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <center>
                            <button type="submit" class="btn btn-raised btn-primary">
                                <i class="fa fa-check-square-o"></i> Add
                            </button>
                            <button type="reset" class="btn btn-raised btn-success">
                                Reset
                            </button>
                            <a href="{{ route('therapyrooms.index') }}" class="btn btn-secondary">
                                Therapy Rooms
                            </a>

                        </center>
                    </div>
            </form>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                    <thead>
                        <tr>
                            <th class="wd-15p">SL.NO</th>
                            <th class="wd-20p">Therapy Room</th>
                            <th class="wd-20p">Branch</th>
                            <th class="wd-15p">Staff Name</th>
                            <th class="wd-15p">Status</th>
                            <th class="wd-15p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($roomAssigning as $assign)
                        <tr id="dataRow_{{ $assign->id }}">
                            <td>{{ ++$i }}</td>
                            <td>{{ $assign->therapyroomName->room_name}}</td>
                            <td>{{ $assign->branch->branch_name}}</td>
                            <td>{{ $assign->staff->staff_name}}</td>
                            <td>
                                <button type="button" onclick="changeStatus({{ $assign->id }})" class="btn btn-sm @if($assign->is_active == 0) btn-danger @else btn-success @endif">
                                    @if($assign->is_active == 0)
                                    InActive
                                    @else
                                    Active
                                    @endif
                                </button>
                            </td>

                            <td>
                                <button type="button" onclick="deleteData({{ $assign->id }})" class="btn btn-danger">
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
                        url: "{{ route('therapyroomassigning.destroy', '') }}/" + dataId,
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
                        url: "{{ route('therapyroomassigning.changeStatus', '') }}/" + dataId,
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