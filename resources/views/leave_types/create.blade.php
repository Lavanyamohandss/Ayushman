@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            @if ($messages = Session::get('error'))
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
            <div class="card-header">
               <h3 class="mb-0 card-title">{{$pageTitle}}</h3>
            </div>
            <!-- Success message -->
            <div class="col-lg-12" style="background-color:#fff">
               <form action="{{ route('leave.type.store') }}" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="hidden_id" value="{{ isset($leave_types->leave_type_id) ? $leave_types->leave_type_id : '' }}">
                  @csrf
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="form-label">Leave type*</label>
                           <input required type="text" class="form-control" name="leave_types" value="{{ isset($leave_types->name) ? $leave_types->name : old('leave_types') }}" placeholder="Leave type">
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group">
                           <div class="form-label">Status</div>
                           <label class="custom-switch">
                              <input type="hidden" name="is_active" value="0"> <!-- Hidden field for false value -->
                              <input type="checkbox" id="is_active" name="is_active" value="1" onchange="toggleStatus(this)" class="custom-switch-input" {{ isset($leave_types->is_active) && $leave_types->is_active == 1 ? 'checked' : '' }}>
                              <span id="statusLabel" class="custom-switch-indicator"></span>
                              <span id="statusText" class="custom-switch-description">
                                 {{ isset($leave_types->is_active) && $leave_types->is_active ? 'Active' : 'Inactive' }}
                              </span>
                           </label>
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group">
                           <div class="form-label">Is Deductible</div>
                           <label class="custom-switch">
                              <input type="hidden" name="is_dedactable" value="0"> <!-- Hidden field for false value -->
                              <input type="checkbox" id="is_dedactable" name="is_dedactable" value="1" onchange="toggleDeductible(this)" class="custom-switch-input" {{ isset($leave_types->is_dedactable) && $leave_types->is_dedactable == 1 ? 'checked' : '' }}>
                              <span id="dedactableLabel" class="custom-switch-indicator"></span>
                              <span id="dedactableText" class="custom-switch-description">
                                 {{ isset($leave_types->is_dedactable) && $leave_types->is_dedactable ? 'Deductible' : 'Non-Deductible' }}
                              </span>
                           </label>
                        </div>
                     </div>

                  </div>
                  <div class="form-group">
                     <center>
                        <button type="submit" class="btn btn-raised btn-primary">
                           <i class="fa fa-check-square-o"></i> {{ isset($leave_types->leave_type_id) ? 'Update' : 'Add' }}</button>
                        @if (!isset($leave_types->leave_type_id))
                        <button type="reset" class="btn btn-raised btn-success">Reset</button>
                        @endif
                        <a class="btn btn-danger" href="{{route('leave.type.index')}}">Cancel</a>
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
   function toggleDeductible(checkbox) {
      if (checkbox.checked) {
         $("#dedactableText").text('Deductible');
         $("input[name=is_dedactable]").val(1); // Set the value to 1 when checked
      } else {
         $("#dedactableText").text('Non-Deductible');
         $("input[name=is_dedactable").val(0); // Set the value to 0 when unchecked
      }
   }
</script>


@endsection