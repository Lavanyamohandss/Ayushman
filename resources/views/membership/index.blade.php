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
        <p id="error-message" class="alert alert-danger" style="display: none;"></p>

        <div class="card-header">
            <h3 class="card-title">{{$pageTitle}}</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('membership.create') }}" class="btn btn-block btn-info">
                <i class="fa fa-plus"></i>
                Create Membership Package
            </a>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                    <thead>
                        <tr>
                            <th class="wd-15p">SL.NO</th>
                            <th class="wd-15p">Name</th>
                            <th class="wd-20p">Duration </th>
                            <!-- <th class="wd-15p">Description</th> -->
                            <th class="wd-15p">Regular Price</th>
                            <th class="wd-15p">Offer Price</th>
                            <th class="wd-15p">Status</th>
                            <th class="wd-15p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($memberships as $membership)
                        <tr id="dataRow_{{ $membership->membership_package_id }}">
                            <td>{{ ++$i }}</td>
                            <td>{{ $membership->package_title }}</td>
                            <td>{{ $membership->package_duration }} days</td>
                            <!-- <td>{{ $membership->package_description }}</td> -->
                            <td>{{ $membership->package_price }}</td>
                            <td>{{ $membership->package_discount_price }}</td>
                            <td>
                                <form action="{{ route('membership.changeStatus', $membership->membership_package_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" onclick="return confirm('Do you want to Change status?');" class="btn btn-sm @if($membership->is_active == 0) btn-danger @else btn-success @endif">
                                        @if($membership->is_active == 0)
                                        InActive
                                        @else
                                        Active
                                        @endif
                                    </button>
                                </form>
                            </td>

                            <td>
                                <a class="btn btn-secondary" href="{{ route('membership.view', ['id' => $membership->membership_package_id])}}">
                                    <i class="fa fa-eye" aria-hidden="true" style="color: white !important;"></i>
                                    View
                                </a>
                                <a class="btn btn-secondary" href="{{ route('membership.edit', ['id' => $membership->membership_package_id, 'active_tab' => 1]) }}">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                </a>
                                <button type="button" onclick="deleteData({{ $membership->membership_package_id }})" class="btn btn-danger">
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
@section('js')
<script type="text/javascript">
    // deleteData
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
                        url: "{{ route('membership.destroy', '') }}/" + dataId,
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
                                $active_tab = 2;
                                $('#basic-details-button').removeClass('active');
                                $('#included-wellnesses-button').addClass('active');

                            } else if (response == '2') {
                                $('#error-message').text('Cannot delete this item because it is already in use by some users.').toggle(true);
                            } else if (response == '3') {
                                $('#error-message').text('Something went wrong').toggle(true);
                            } else {
                                $('#error-message').text('An error occured! Please try again later.').toggle(true);
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
</script>
@endsection