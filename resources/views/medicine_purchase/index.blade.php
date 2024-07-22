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
            <p>{{$message}}</p>
        </div>
        @endif
        @if ($message = Session::get('exists'))
        <div class="alert alert-danger">
            <p>{{$message}}</p>
        </div>
        @endif
        <div class="card-header">
            <h3 class="card-title">{{$pageTitle}}</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('medicine.purchase.create') }}" class="btn btn-block btn-info">
                <i class="fa fa-plus"></i>
                Create {{$pageTitle}}
            </a>



            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                    <thead>
                        <tr>
                            <th class="wd-15p">SL.NO</th>
                            <th class="wd-15p">Invoice Number</th>
                            <th class="wd-15p">Date</th>
                            <th class="wd-20p">Supplier</th>
                            <th class="wd-15p">Branch</th>
                            <th class="wd-15p">Settled/Not</th>
                            <th class="wd-15p">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        <tr>
                            <td>Dummy data</td>
                            <td>Dummy data</td>
                            <td>Dummy data</td>
                            <td>Dummy data</td>
                            <td>Dummy data</td>
                            <td>Dummy data</td>
                            <td>
                                <a class="btn btn-primary" href="">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                </a>
                                <button type="button" onclick="deleteQualification()" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                </button>
                            </td>

                        </tr>
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
    // to delete that selected row 
    function deleteQualification(qualificationId) {
        swal({
                title: "Delete data?",
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
                        url: "{{ route('qualifications.destroy', '') }}/" + qualificationId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response == '1') {
                                $("#qualificationRow_" + qualificationId).remove();
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
    function changeStatus(qualificationId) {
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
                        url: "{{ route('qualifications.changeStatus', '') }}/" + qualificationId,
                        type: "patch",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response == '1') {
                                var cell = $('#qualificationRow_' + qualificationId).find('td:eq(2)');

                                if (cell.find('.btn-success').length) {
                                    cell.html('<button type="button" onclick="changeStatus(' + qualificationId + ')" class="btn btn-sm btn-danger">Inactive</button>');
                                } else {
                                    cell.html('<button type="button" onclick="changeStatus(' + qualificationId + ')" class="btn btn-sm btn-success">Active</button>');
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