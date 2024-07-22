@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Search Medicine</h3>
            </div>
            <form action="{{ route('medicine.index') }}" method="GET" class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="medicine-name" class="form-label">Medicine Name:</label>
                        <input type="text" id="medicine-name" name="medicine_name" class="form-control" value="{{ request('medicine_name') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="generic-name" class="form-label">Generic Name:</label>
                        <input type="text" id="generic-name" name="generic_name" class="form-control" value="{{ request('generic_name') }}">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Medicine Type</label>
                            <select class="form-control" name="medicine_type" id="medicine_type">
                                <option value="">Select Medicine Type</option>
                                @foreach($medicineType as $masterId => $masterValue)
                                    <option value="{{ $masterId }}"{{ request('medicine_type') == $masterId ? 'selected' : '' }}>
                                        {{ $masterValue }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>    
                    <div class="col-md-3 d-flex align-items-end">
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>&nbsp;
                            <a class="btn btn-primary" href="{{ route('medicine.index') }}"><i class="fa fa-times" aria-hidden="true"></i> Reset</a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manage Medicines</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('medicine.create') }}" class="btn btn-block btn-info">
                    <i class="fa fa-plus"></i>
                    Create Medicine
                </a>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th class="wd-15p">SL.NO</th>
                                <th class="wd-20p">Medicine Name</th>
                                <th class="wd-15p">Generic Name</th>
                                <th class="wd-15p">Medicine Type</th>
                                <th class="wd-15p">Status</th>
                                <th class="wd-15p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0;
                            @endphp
                            @foreach($medicines as $medicine)
                            <tr id="dataRow_{{ $medicine->id }}">
                                <td>{{ ++$i }}</td>
                                <td>{{ $medicine->medicine_name }}</td>
                                <td>{{ $medicine->generic_name }}</td>
                                <td>{{ $medicine->medicineType->master_value }}</td>
                               
                                <td>
                                    <button type="button" onclick="changeStatus({{ $medicine->id}})" class="btn btn-sm @if($medicine->is_active == 0) btn-danger @else btn-success @endif">
                                        @if($medicine->is_active == 0)
                                        InActive
                                        @else
                                        Active
                                        @endif
                                    </button>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm edit-custom"
                                        href="{{ route('medicine.edit', $medicine->id) }}"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                                    <a class="btn btn-secondary btn-sm" href="{{ route('medicine.show', $medicine->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View </a>
                                        <form style="display: inline-block"
                                        action="{{ route('medicine.destroy', $medicine->id ) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" onclick="deleteData({{ $medicine->id  }})"class="btn-danger btn-sm">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    {{-- </div> --}}
</div>
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
                        url: "{{ route('medicine.destroy', '') }}/" + dataId,
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
                            alert('An error occurred while deleting the medicine.');
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
                        url: "{{ route('medicine.changeStatus', '') }}/" + dataId,
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
                            alert('An error occurred while changing the medicine status.');
                        },
                    });
                }
            });
    }
</script>
