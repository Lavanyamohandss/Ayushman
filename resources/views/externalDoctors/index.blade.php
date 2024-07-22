@extends('layouts.app')
@section('content')
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
      <h3 class="card-title">List External Doctors</h3>
   </div>
   <div class="card-body">
      <a href="{{ route('externaldoctors.create') }}" class="btn btn-block btn-info">
      <i class="fa fa-plus"></i>
      Create External Doctor
      </a>
      <div class="table-responsive">
         <table id="example" class="table table-striped table-bordered text-nowrap w-100">
            <thead>
               <tr>
                  <th class="wd-15p">SL.NO</th>
                  <th class="wd-15p">Doctor Name</th>
                  <th class="wd-20p">Contact No</th>
                  <th class="wd-15p">Email</th>
                  <th class="wd-15p">Status</th>
                  <th class="wd-15p">Action</th>
               </tr>
            </thead>
            <tbody>
               @php
               $i = 0;
               @endphp
               @foreach($externaldoctor as $doctor)
               <tr id="dataRow_{{ $doctor->id }}">
                  <td>{{ ++$i }}</td>
                  <td>{{ $doctor->doctor_name }}</td>
                  <td>{{ $doctor->contact_no }}</td>
                  <td>{{ $doctor->contact_email }}</td>
                  <td>
                     <button type="button" onclick="changeStatus({{$doctor->id }})" class="btn btn-sm @if($doctor->is_active == 0) btn-danger @else btn-success @endif">
                        @if($doctor->is_active == 0)
                        InActive
                        @else
                        Active
                        @endif
                    </button>
                  </td>
                  <td>
                     <a class="btn btn-primary btn-sm edit-custom"
                        href="{{ route('externaldoctors.edit', $doctor->id) }}"><i
                        class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                     <a class="btn btn-secondary btn-sm" href="{{ route('externaldoctors.show', $doctor->id) }}">
                     <i class="fa fa-eye" aria-hidden="true"></i> View</a>
                     <form style="display: inline-block"
                        action="{{ route('externaldoctors.destroy', $doctor->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="button" onclick="deleteData({{ $doctor->id}})"class="btn-danger btn-sm">
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
                       url: "{{ route('externaldoctors.destroy', '') }}/" + dataId,
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
                           alert('An error occurred while deleting the external doctor.');
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
                        url: "{{ route('externaldoctors.changeStatus', '') }}/" + dataId,
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
                            alert('An error occurred while changing the branch status.');
                        },
                    });
                }
            });
    }
   </script>