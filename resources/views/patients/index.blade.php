@extends('layouts.app')
@section('content')
<div class="row">
   <div class="col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Search Patient</h3>
         </div>
         <form action="{{ route('patients.index') }}" method="GET">
            <div class="card-body">
               <div class="row mb-3">
                  <div class="col-md-4">
                     <label for="patient-code" class="form-label">Patient Code:</label>
                     <input type="text" id="patient-code" name="patient_code" class="form-control" value="{{ request('patient_code') }}">
                  </div>
                  <div class="col-md-4">
                     <label for="patient-name" class="form-label">Patient Name:</label>
                     <input type="text" id="patient-name" name="patient_name" class="form-control" value="{{ request('patient_name') }}">
                  </div>
                  <div class="col-md-4">
                     <label for="patient-mobile" class="form-label">Patient Mobile:</label>
                     <input type="text" id="patient-mobile" name="patient_mobile" class="form-control" value="{{ request('patient_mobile') }}">
                  </div>
               </div>
               <div class="col-md-3 d-flex align-items-end">
                  <div>
                     <button type="submit" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>&nbsp;
                     <a class="btn btn-primary" href="{{ route('patients.index') }}"><i class="fa fa-times" aria-hidden="true"></i> Reset</a>
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
         <h3 class="card-title">List Patients</h3>
      </div>
      <div class="card-body">
         <a href="{{ route('patients.create') }}" class="btn btn-block btn-info">
            <i class="fa fa-plus"></i>
            Create Patient
         </a>
         <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered text-nowrap w-100">
               <thead>
                  <tr>
                     <th class="wd-15p">SL.NO</th>
                     <th class="wd-15p">Patient Code</th>
                     <th class="wd-20p">Name</th>
                     <th class="wd-15p">Mobile</th>
                     <th class="wd-15p">Emergency Contact Person</th>
                     <th class="wd-15p">Emergency Contact Number</th>
                     <th class="wd-10p">Membership</th>
                     <th class="wd-10p">OTP Verified</th>
                     <th class="wd-15p">Status</th>
                     <th class="wd-15p">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @php
                  $i = 0;
                  @endphp
                  @foreach($patients as $patient)
                  <tr id="dataRow_{{$patient->id }}">
                     <td>{{ ++$i }}</td>
                     <td>{{ $patient->patient_code }}</td>
                     <td>{{ $patient->patient_name }}</td>
                     <td>{{ $patient->patient_mobile}}</td>
                     <td>{{ $patient->emergency_contact_person}}</td>
                     <td>{{ $patient->emergency_contact}}</td>
                       <td>
                                        <a class="btn btn-sm  btn-outline-success "
                                            href="{{ route('patients.membership', $patient->id) }}"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i>Membership</a>
                                                </td>
                                    
                     <td>
                        <button type="button" onclick="changeVerification({{ $patient->id}})" class="btn btn-sm @if($patient->is_otp_verified == 0) btn-danger @else btn-success @endif">
                           @if($patient->is_otp_verified == 0)
                           NotVerified
                           @else
                           Verified
                           @endif
                       </button>
                     </td>
                     <td>
                        <button type="button" onclick="changeStatus({{ $patient->id}})" class="btn btn-sm @if($patient->is_active == 0) btn-danger @else btn-success @endif">
                           @if($patient->is_active == 0)
                           InActive
                           @else
                           Active
                           @endif
                       </button>
                     </td>
                     <td>
                        

                        <a class="btn btn-primary btn-sm edit-custom"
                           href="{{ route('patients.edit', $patient->id) }}"><i
                           class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                        <a class="btn btn-secondary btn-sm" href="{{ route('patients.show', $patient->id) }}">
                        <i class="fa fa-eye" aria-hidden="true"></i> View  </a>
                        <form style="display: inline-block"
                           action="{{ route('patients.destroy', $patient->id) }}" method="post">
                           @csrf
                           @method('delete')
                           <button type="button" onclick="deleteData({{ $patient->id }})"class="btn-danger btn-sm">
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
                       url: "{{ route('patients.destroy', '') }}/" + dataId,
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
                           alert('An error occurred while deleting the patient.');
                       },
                   });
               } else {
                   return;
               }
           });
   }
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
                        url: "{{ route('patients.changeStatus', '') }}/" + dataId,
                        type: "patch",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response == '1') {
                                var cell = $('#dataRow_' + dataId).find('td:eq(8)');

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
                            alert('An error occurred while changing the patient status.');
                        },
                    });
                }
            });
    }



    function changeVerification(dataId) {
        swal({
                title: "Change Verification?",
                text: "Are you sure you want to change otp verification status?",
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
                        url: "{{ route('patients.toggleOTPVerification', '') }}/" + dataId,
                        type: "patch",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response == '1') {
                                var cell = $('#dataRow_' + dataId).find('td:eq(7)');

                                if (cell.find('.btn-success').length) {
                                    cell.html('<button type="button" onclick="changeVerification(' + dataId + ')" class="btn btn-sm btn-danger">NotVerified</button>');
                                } else {
                                    cell.html('<button type="button" onclick="changeVerification(' + dataId + ')" class="btn btn-sm btn-success">Verified</button>');
                                }

                                flashMessage('s', 'Otp verification changed successfully');
                            } else {
                                flashMessage('e', 'An error occurred! Please try again later.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while changing the patient status.');
                        },
                    });
                }
            });
    }
   </script>
