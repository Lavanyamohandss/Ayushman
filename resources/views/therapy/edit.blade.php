@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">Edit Therapy</h3>
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
               <form action="{{route('therapy.update',['id'=>$therapy->id])}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Therapy Name*</label>
                           <input type="text" class="form-control" required name="therapy_name" maxlength="100" value="{{$therapy->therapy_name}}" placeholder="Therapy Name">
                        </div>
                     </div>


                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Therapy Cost</label>
                           <input type="text" class="form-control" required name="therapy_cost" maxlength="14" value="{{$therapy->therapy_cost}}" placeholder="Therapy Cost"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"d>
                        </div>
                     </div>


                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Remarks</label>
                           <textarea class="form-control" required name="remarks"  placeholder="Remarks">{{$therapy->remarks}}</textarea>
                        </div>
                     </div>
                     <!-- ... -->

                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-label">Status</div>
                           <label class="custom-switch">
                              <input type="checkbox" id="is_active" name="is_active" onchange="toggleStatus(this)" class="custom-switch-input" @if($therapy->is_active) checked @endif>
                              <span id="statusLabel" class="custom-switch-indicator"></span>
                              <span id="statusText" class="custom-switch-description">
                                 @if($therapy->is_active)
                                 Active
                                 @else
                                 Inactive
                                 @endif
                              </span>
                           </label>
                        </div>
                     </div>

                     <!-- ... -->



                     <div class="col-md-12">
                        <div class="form-group">
                           <center>
                              <button type="submit" class="btn btn-raised btn-primary">
                                 <i class="fa fa-check-square-o"></i> Update</button>
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