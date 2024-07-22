@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">{{$pageTitle}}</h3>
            </div>
            <div class="card-body">
               @if ($message = Session::get('status'))
               <div class="alert alert-success">
                  <p>{{$message}}</p>
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
               
               <form action="{{ route('unit.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="form-label">Unit Name*</label>
                           <input type="text" class="form-control" required name="unit_name" value="{{old('unit_name')}}" placeholder="Unit Name">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="form-label">Unit Short Name</label>
                           <input maxlength="5" pattern=".{1,5}" title="Maximum 5 characters allowed" type="text" class="form-control" name="unit_short_name" value="{{old('unit_short_name ')}}" placeholder="Unit Short Name">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <div class="form-label">Status</div>
                           <label class="custom-switch">
                              <input type="hidden" name="is_active" value="0"> <!-- Hidden field for false value -->
                              <input type="checkbox" id="is_active" name="is_active" onchange="toggleStatus(this)" class="custom-switch-input" checked>
                              <span id="statusLabel" class="custom-switch-indicator"></span>
                              <span id="statusText" class="custom-switch-description">Active</span>
                           </label>
                        </div>
                     </div>
                  </div>

                  <!-- ... -->




                  <div class="form-group">
                     <center>
                        <button type="submit" class="btn btn-raised btn-primary">
                           <i class="fa fa-check-square-o"></i> Add</button>
                        <button type="reset" class="btn btn-raised btn-success">
                           Reset</button>
                        <a class="btn btn-danger" href="{{route('unit.index')}}">Cancel</a>
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