@extends('layouts.app')
@section('content')
<div class="row">
   <div class="col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Search Supplier</h3>
         </div>
         <form action="{{ route('supplier.index') }}" method="GET">
            <div class="card-body">
               <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Supplier Type</label>
                        <select class="form-control"  name="supplier_type_id" id="supplier_type_id">
                            <option value="">Select Supplier Type</option>
                            <option value="1">Individual</option>
                            <option value="2">Business</option>
                        </select>
                    </div>
                </div>
                  <div class="col-md-3">
                     <label for="supplier-code" class="form-label">Supplier Code:</label>
                     <input type="text" id="supplier-code" name="supplier_code" class="form-control" value="{{ request('supplier_code') }}">
                  </div>
                  <div class="col-md-3">
                     <label for="supplier-name" class="form-label">Supplier Name:</label>
                     <input type="text" id="supplier-name" name="supplier_name" class="form-control" value="{{ request('supplier_name') }}">
                  </div>
                  <div class="col-md-3">
                    <label for="supplier-number" class="form-label">Supplier Number:</label>
                    <input type="text" id="supplier-number" name="phone_1" class="form-control" value="{{ request('phone_1') }}">
                 </div>
               </div>
               <div class="col-md-3 d-flex align-items-end">
                  <div>
                     <button type="submit" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>&nbsp;
                     <a class="btn btn-primary" href="{{ route('supplier.index') }}"><i class="fa fa-times" aria-hidden="true"></i> Reset</a>
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
                <h3 class="card-title">List Suppliers</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('supplier.create') }}" class="btn btn-block btn-info">
                    <i class="fa fa-plus"></i>
                    Create Supplier
                </a>
                
               
                
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="wd-15p">SL.NO</th>
                                    <th class="wd-15p">supplier Code</th>
                                    <th class="wd-15p">supplier Name</th>
                                    <th class="wd-15p">supplier City</th>
                                    <th class="wd-15p">supplier State</th>
                                    <th class="wd-15p">supplier Country</th>
                                    <th class="wd-15p">Phone</th>
                                    <th class="wd-15p">Email</th>
                                    <th class="wd-15p">GSTNO</th>
                                    <th class="wd-15p">Opening Balance Type</th>
                                    <th class="wd-15p">Status</th>
                                    <th class="wd-15p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach($suppliers as $supplier)
                                <tr id="dataRow_{{$supplier->supplier_id}}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $supplier->supplier_code }}</td>
                                    <td>{{ $supplier->supplier_name }}</td>
                                    <td>{{ $supplier->supplier_city }}</td>
                                    <td>{{ $supplier->state }}</td>
                                    <td>{{ $supplier->country }}</td>
                                    <td>{{ $supplier->phone_1 }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->GSTNO }}</td>
                                    <td>{{ $supplier->opening_balance_type === 1 ? 'Debit' : 'Credit'}}</td>
                                    <td>
                                       <form action="{{ route('supplier.changeStatus', $supplier->supplier_id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                            <button type="submit"
                                                onclick="return confirm('Do you want to Change status?');"
                                                class="btn btn-sm @if($supplier->is_active == 0) btn-danger @else btn-success @endif">
                                                @if($supplier->is_active == 0)
                                                InActive
                                                @else
                                                Active
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                       
                                    <td>
                                        <a class="btn btn-primary btn-sm edit-custom"
                                            href="{{ route('supplier.edit', $supplier->supplier_id) }}"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                                                <a class="btn btn-secondary btn-sm" href="{{ route('supplier.show', $supplier->supplier_id) }}" style="    font-size: 0.65rem;
                                                    margin-right: 0;">
                                                   <i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                        <form style="display: inline-block"
                                            action="{{ route('supplier.destroy', $supplier->supplier_id ) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"onclick="return confirm('Do you want to delete it?');" class="btn-danger btn-sm"><i class="fa fa-trash"
                                                    aria-hidden="true"></i>Delete</button>
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
                        url: "{{ route('supplier.destroy', '') }}/" + dataId,
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
                            alert('An error occurred while deleting the staff.');
                        },
                    });
                } else {
                    return;
                }
            });
    }
    </script>



