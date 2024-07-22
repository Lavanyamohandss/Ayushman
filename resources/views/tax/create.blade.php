@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">Create Tax</h3>
            </div>
            <div class="card-body">
               @if ($message = Session::get('status'))
               <div class="alert alert-success">
                  <p></p>
               </div>
               @endif
            </div>
            <div class="col-lg-12" style="background-color:#fff">
               @if ($errors->any())
               <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               <form action="{{ route('tax.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Name*</label>
                           <input type="text" class="form-control" required name="tax_name" value="{{old('tax_name')}}" placeholder="Tax Name">
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Rate(%)*</label>
                           <input type="text" class="form-control" required name="tax_rate" value="{{ old('tax_rate') }}" placeholder="Tax Rate">
                        </div>
                     </div>


                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Type*</label>
                           <select class="form-control" name="tax_type" id="branch_id">
                              <option value="">Select Tax Type</option>
                              @foreach($taxes as $tax)
                              <option value="{{ $tax->id }}" {{ old('tax_type') == $tax->id ? 'selected' : '' }}>
                                 {{ $tax->tax_name }}
                              </option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-label">Status</div>
                           <label class="custom-switch">
                              <input type="hidden" name="is_active" value="0"> <!-- Hidden field for false value -->
                              <input type="checkbox" id="is_active" name="is_active" value="1" onchange="toggleStatus(this)" class="custom-switch-input" {{ isset($qualification->is_active) && $qualification->is_active == 0 ? '' : 'checked' }}>
                              <span id="statusLabel" class="custom-switch-indicator"></span>
                              <span id="statusText" class="custom-switch-description">
                                 {{ isset($qualification->is_active) && $qualification->is_active ? 'Active' : 'Inactive' }}
                              </span>
                           </label>
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <center>
                        <button type="submit" class="btn btn-raised btn-primary">
                           <i class="fa fa-check-square-o"></i> Add</button>
                        <button type="reset" class="btn btn-raised btn-success">
                           Reset</button>
                        <a class="btn btn-danger" href="{{route('tax.group.index')}}">Cancel</a>
                        <a class="btn btn-warning" href="{{route('tax.group.index')}}">Tax Groups</a>
                     </center>
                  </div>
            </div>
         </div>

         </form>
         <div class="card-body">
            <div class="table-responsive">
               <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                  <thead>
                     <tr>
                        <th class="wd-15p">SL.NO</th>
                        <th class="wd-15p"> Name</th>
                        <th class="wd-15p"> Rate(%)</th>
                        <th class="wd-15p"> Type</th>
                        <th class="wd-15p">Status</th>
                        <th class="wd-15p">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php
                     $i = 0;
                     @endphp
                     @foreach($all_taxes as $tax)
                     <tr id="dataRow_{{ $tax->id }}">
                        <td>{{ ++$i }}</td>
                        <td>{{ $tax->tax_name }}</td>
                        <td>{{ $tax->tax_rate }} %</td>
                        <td>{{ $tax->tax }}</td>
                        <td>
                           <button type="button" onclick="changeStatus({{ $tax->id }})" class="btn btn-sm @if($tax->is_active == 0) btn-danger @else btn-success @endif">
                              @if($tax->is_active == 0)
                              InActive
                              @else
                              Active
                              @endif
                           </button>
                        </td>

                        <td>
                           <!-- <a class="btn btn-secondary" href="{{ route('tax.edit', $tax->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a> -->
                           <button type="button" onclick="deleteData({{ $tax->id }})" class="btn btn-danger">
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

      </div>
   </div>
</div>

@endsection
@section('js')
<script>
   // toggle status 
   function toggleStatus(checkbox) {
      if (checkbox.checked) {
         $("#statusText").text('Active');
         $("input[name=is_active]").val(1); // Set the value to 1 when checked
      } else {
         $("#statusText").text('Inactive');
         $("input[name=is_active]").val(0); // Set the value to 0 when unchecked
      }
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
                  url: "{{ route('tax.changeStatus', '') }}/" + dataId,
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

   // Delete 
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
                  url: "{{ route('tax.destroy', '') }}/" + dataId,
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
</script>


@endsection