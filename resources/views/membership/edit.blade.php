@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <!-- style="min-height: 70vh;" -->
        <div class="col-md-12">
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
                @if ($messages = Session::get('validation error'))
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
                <p id="error-message" class="alert alert-danger" style="display: none;"></p>
                <input type="hidden" id="active_tab" value="{{$active_tab}}">
                <div class="card-header">
                    <h3 class="mb-0 card-title">Edit Membership Packages</h3>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-outline-dark{{ $active_tab === 1 ? ' active' : '' }}" id="basic-details-button">Basic Details</button>
                                <button type="button" class="btn btn-outline-dark{{ $active_tab === 2 ? ' active' : '' }}" id="included-wellnesses-button">Included Wellnesses</button>
                                <button type="button" class="btn btn-outline-dark{{ $active_tab === 3 ? ' active' : '' }}" id="included-benefits-button">Included Benefits</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 1: Basic Details -->
                    <div id="basic-details-content">
                        <div class="row">
                            <form action="{{ route('membership.update',['id'=>request()->route('id')]) }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="update_type" value="1">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Membership Package Name*</label>
                                                <input type="text" class="form-control" required name="membership_package_name" value="{{ isset($membership->package_title) ? $membership->package_title : old('membership_package_name') }}" placeholder="Membership Package Name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Membership Package Duration(Days)*</label>
                                                <input type="number" class="form-control" required name="membership_package_duration" value="{{ isset($membership->package_duration) ? $membership->package_duration : old('package_duration') }}" placeholder="Membership Package Duration">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Membership Package Price*</label>
                                                <input type="number" class="form-control" required name="membership_package_price" value="{{ isset($membership->package_price) ? $membership->package_price : old('package_price') }}" placeholder="Membership Package Price">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Offer Price*</label>
                                                <input type="number" class="form-control" required name="discount_price" value="{{ isset($membership->package_discount_price) ? $membership->package_discount_price : old('package_discount_price') }}" placeholder="Discount Price">
                                            </div>
                                        </div>

                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label class="form-label">Membership Package Description</label>
                                                <textarea class="form-control ckeditor" name="membership_package_description" placeholder="Membership Package Description">{{ isset($membership->package_description) ? $membership->package_description : old('package_description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <div class="form-label">Status</div>
                                                <label class="custom-switch">
                                                    <input type="hidden" name="membership_package_active" value="0">
                                                    <input type="checkbox" id="membership_package_active_checkbox" name="membership_package_active" class="custom-switch-input" @if($membership->is_active) checked @endif>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span id="statusText" class="custom-switch-description">
                                                        {{ $membership->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <center>
                                                    <button type="submit" class="btn btn-raised btn-primary"><i class="fa fa-check-square-o"></i>Update</button>
                                                    <a class="btn btn-danger" href="{{route('membership.index')}}">Cancel</a>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Add more form fields for Basic Details here -->
                        </div>
                    </div>
                    <!-- Tab 2: Included Wellnesses -->
                    <div id="included-wellnesses-content" style="display: none;">
                        <div class="container">
                            <form action="{{ route('membership.update',['id'=>request()->route('id')]) }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="update_type" value="2">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label">Select wellness*</label>
                                                <select class="form-control" required name="wellness_id" id="wellness-select">
                                                    <option value="">Select Wellness</option>
                                                    @foreach ($wellnesses as $wellness)
                                                    <option value="{{ $wellness->wellness_id }}" data-duration="{{ $wellness->wellness_duration }}" data-cost="{{ $wellness->wellness_cost }}">
                                                        {{ $wellness->wellness_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <label id="wellness-details">Wellness Duration: 0 minutes, Wellness Cost: 0 ₹</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Max usage limit*</label>
                                                <input type="number" class="form-control" required name="max_usage_limit" placeholder="Max usage limit">
                                            </div>
                                        </div>

                                        <div class="col-md-3 text-center"> <!-- Added "text-center" class -->
                                            <div class="form-group">
                                                <label class="form-label">Actions</label>
                                                <!-- Removed the <center> tag as it's not recommended -->
                                                <button type="submit" class="btn btn-raised btn-primary"><i class="fa fa-check-square-o"></i> Add</button>
                                                <a class="btn btn-danger" href="{{ route('membership.index') }}">Cancel</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                            <div class="card-header">
                                <h3 class="card-title">Currently included wellnesses</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="exampleWellness" class="table table-striped table-bordered text-nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p">SL.NO</th>
                                                <th class="wd-15p"> Wellness Name</th>
                                                <th class="wd-20p">Max usage limit </th>
                                                <th class="wd-15p">Status</th>
                                                <th class="wd-15p">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i = 0;
                                            @endphp
                                            @foreach($included_wellness as $wellness)
                                            <tr id="dataRow_{{ $wellness->package_wellness_id }}">
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $wellness->wellness_name }}</td>
                                                <td>{{ $wellness->maximum_usage_limit }} times</td>
                                                <td><span class="@if($wellness->is_active == 0) badge badge-danger @else badge badge-success @endif" style="width: 60px"> @if($wellness->is_active == 0)
                                                        InActive
                                                        @else
                                                        Active
                                                        @endif </span>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="deleteWellness({{ $wellness->package_wellness_id }})" class="btn btn-danger">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Tab 3: Included Benefits -->
                    <div id="included-benefits-content" style="display: none;">
                        <div class="container">
                            <form action="{{ route('membership.update',['id'=>request()->route('id')]) }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="update_type" value="3">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <label class="form-label">Include other benefits</label>
                                            <!-- <h6 class="mb-0 card-title" style="margin-left:15px;">Include other benefits</h6><br> -->
                                            <div class="form-group">
                                                <textarea class="form-control ckeditor" required id="benefitsEditor" name="benefit_title" placeholder="Include other benefits">{{ old('package_description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-1 text-center"> <!-- Added "text-center" class -->
                                            <div class="form-group">
                                                <label class="form-label">Actions</label>
                                                <!-- Removed the <center> tag as it's not recommended -->
                                                <button type="submit" class="btn btn-raised btn-primary mt-5 mb-5"><i class="fa fa-check-square-o"></i> Add</button> <br>
                                                <a class="btn btn-danger" href="{{ route('membership.index') }}">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="card-header">
                                <h3 class="card-title">Currently included benefits</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p">SL.NO</th>
                                                <th class="wd-15p">Title</th>
                                                <th class="wd-15p">Status</th>
                                                <th class="wd-15p">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i = 0;
                                            @endphp
                                            @foreach($included_benefits as $benefit)
                                            <tr id="dataRow_{{ $benefit->membership_benefits_id }}">
                                                <td>{{ ++$i }}</td>
                                                <td>{!! $benefit->title !!}</td>
                                                <td>
                                                    <span class="@if($benefit->is_active == 0) badge badge-danger @else badge badge-success @endif" style="width: 60px">
                                                        @if($benefit->is_active == 0) InActive @else Active @endif
                                                    </span>
                                                </td>

                                                <td>
                                                    <button type="button" onclick="deleteBenefit({{ $benefit->membership_benefits_id }})" class="btn btn-danger">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').each(function() {
            CKEDITOR.replace($(this).attr('id'));
        });
        $("#wellness-select").on('change', function() {
            var selectedOption = $(this).find(':selected');
            var duration = selectedOption.data('duration');
            var cost = selectedOption.data('cost');

            var wellnessDetailsLabel = 'Wellness Duration: ' + (duration >= 60 ? (duration / 60) + ' hour' : duration + ' minutes') + ', Wellness Cost: ' + cost + ' ₹';

            $("#wellness-details").text(wellnessDetailsLabel);
        });

        toggleStatus($("#membership_package_active_checkbox"));

        // Toggle status function
        $("#membership_package_active_checkbox").on("change", function() {
            toggleStatus($(this));
        });

        function toggleStatus(checkbox) {
            if (checkbox.is(":checked")) {
                $("#statusText").text('Active');
                $('[name="membership_package_active"]').val(1);
            } else {
                $("#statusText").text('Inactive');
                $('[name="membership_package_active"]').val(0);
            }
        }

        if ($("#active_tab").val() == 1) {
            $("#basic-details-content").show();
            $("#included-wellnesses-content").hide();
            $("#included-benefits-content").hide();

            // Highlight the clicked tab button
            $("#basic-details-button").addClass("btn-primary");
            $("#included-wellnesses-button").removeClass("btn-primary");
            $("#included-benefits-button").removeClass("btn-primary");
        }
        if ($("#active_tab").val() == 2) {
            $("#basic-details-content").hide();
            $("#included-wellnesses-content").show();
            $("#included-benefits-content").hide();

            // Highlight the clicked tab button
            $("#basic-details-button").removeClass("btn-primary");
            $("#included-wellnesses-button").addClass("btn-primary");
            $("#included-benefits-button").removeClass("btn-primary");
        }
        if ($("#active_tab").val() == 3) {
            $("#basic-details-content").hide();
            $("#included-wellnesses-content").hide();
            $("#included-benefits-content").show();

            // Highlight the clicked tab button
            $("#basic-details-button").removeClass("btn-primary");
            $("#included-wellnesses-button").removeClass("btn-primary");
            $("#included-benefits-button").addClass("btn-primary");
        }

        // $("#basic-details-button").addClass("btn-primary");
        // Button click handlers to show/hide content and highlight the clicked tab
        $("#basic-details-button").click(function() {
            $("#basic-details-content").show();
            $("#included-wellnesses-content").hide();
            $("#included-benefits-content").hide();

            // Highlight the clicked tab button
            $("#basic-details-button").addClass("btn-primary");
            $("#included-wellnesses-button").removeClass("btn-primary");
            $("#included-benefits-button").removeClass("btn-primary");
        });

        $("#included-wellnesses-button").click(function() {
            $("#basic-details-content").hide();
            $("#included-wellnesses-content").show();
            $("#included-benefits-content").hide();

            // Highlight the clicked tab button
            $("#basic-details-button").removeClass("btn-primary");
            $("#included-wellnesses-button").addClass("btn-primary");
            $("#included-benefits-button").removeClass("btn-primary");
        });

        $("#included-benefits-button").click(function() {
            $("#basic-details-content").hide();
            $("#included-wellnesses-content").hide();
            $("#included-benefits-content").show();

            // Highlight the clicked tab button
            $("#basic-details-button").removeClass("btn-primary");
            $("#included-wellnesses-button").removeClass("btn-primary");
            $("#included-benefits-button").addClass("btn-primary");
        });
    });

    function toggleWellnessStatus(checkbox) {
        if (checkbox.checked) {
            $("#statusText").text('Active');
            $('[name="membership_wellness_active"]').val(1);
        } else {
            $("#statusText").text('Inactive');
            $('[name="membership_wellness_active"]').val(0);
        }
    }

    function toggleBenefitStatus(checkbox) {
        if (checkbox.checked) {
            $("#statusText").text('Active');
            $('[name="membership_benefit_active"]').val(1);
        } else {
            $("#statusText").text('Inactive');
            $('[name="membership_benefit_active"]').val(0);
        }
    }
    // deleteWellness 
    function deleteWellness(dataId) {
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
                        url: "{{ route('membership.destroy.wellness', '') }}/" + dataId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            // Handle the success response, e.g., remove the row from the table
                            if (response == '1') {
                                $("#dataRow_" + dataId).remove();
                                i = 0;
                                $("#exampleWellness tbody tr").each(function() {
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

    // deleteBenefit 
    function deleteBenefit(dataId) {
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
                        url: "{{ route('membership.destroy.benefit', '') }}/" + dataId,
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
                                $active_tab = 3;
                                $('#basic-details-button').removeClass('active');
                                $('#included-wellnesses-button').removeClass('active');
                                $('#included-benefits-button').addClass('active');

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