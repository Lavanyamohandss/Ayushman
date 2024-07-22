@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">Create Therapy</h3>
            </div>
           
            <div class="col-lg-12" style="background-color: #fff;">
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
               <form action="{{ route('therapy.store') }}" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Therapy Name*</label>
                           <input type="text" class="form-control" required name="therapy_name" maxlength="100" value="{{old('therapy_name')}}" placeholder="Therapy Name">
                        </div>
                     </div>
                   

                   <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Therapy Cost*</label>
                           <input type="text" class="form-control" required name="therapy_cost" maxlength="14"  placeholder="Therapy Cost"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                     </div>


                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Remarks</label>
                           <textarea class="form-control" name="remarks" placeholder="Remarks"></textarea>
                        </div>
                     </div>
  <!-- ... -->
                      
<div class="col-md-6">
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
                           <a class="btn btn-danger" href="{{route('therapy.index')}}">Cancel</a>
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
