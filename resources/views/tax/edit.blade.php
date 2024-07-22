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
                           <input type="text" class="form-control" required name="tax_name" value="{{$tax->tax_name}}" placeholder="Tax Name">
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Rate(%)*</label>
                           <input type="number" class="form-control" required name="tax_rate" value="{{$tax->tax_rate}}" placeholder="Tax Rate">
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Type*</label>
                           <select class="form-control" name="tax_type" id="tax_type">
                              <option value="">Select Tax Type</option>
                              @foreach($taxes as $taxDropDown)
                              <option value="{{ $taxDropDown->id }}" {{ $taxDropDown->id == $tax->tax_type ? 'selected' : '' }}>
                                 {{ $taxDropDown->tax_name }}
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
                              <input type="checkbox" id="is_active" name="is_active" value="1" onchange="toggleStatus(this)" class="custom-switch-input" {{ isset($tax->is_active) && $tax->is_active == 0 ? '' : 'checked' }}>
                              <span id="statusLabel" class="custom-switch-indicator"></span>
                              <span id="statusText" class="custom-switch-description">
                                 {{ isset($tax_type->is_active) && $tax_type->is_active ? 'Active' : 'Inactive' }}
                              </span>
                           </label>
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <center>
                        <button type="submit" class="btn btn-raised btn-primary">
                           <i class="fa fa-check-square-o"></i> Update</button>
                        <a class="btn btn-danger" href="{{route('tax.group.index')}}">Cancel</a>
                     </center>
                  </div>
            </div>
         </div>

         </form>

      </div>
   </div>
</div>

@endsection
@section('js')
<script>
   function toggleStatus(checkbox) {
      if (checkbox.checked) {
         $("#statusText").text('Active');
         $("input[name=is_active]").val(1); // Set the value to 1 when checked
      } else {
         $("#statusText").text('Inactive');
         $("input[name=is_active]").val(0); // Set the value to 0 when unchecked
      }
   }
</script>


@endsection