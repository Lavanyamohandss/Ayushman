@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">Edit Assigned Therapy Room</h3>
            </div>
            <div class="card-body">
               @if ($message = Session::get('status'))
               <div class="alert alert-success">
                  <p></p>
               </div>
               @endif
            </div>
            <div class="col-lg-12">
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
               <form action="{{route('therapyroomassigning.update',['id'=>$roomassigning->id])}}" method="POST" enctype="multipart/form-data">
                 @csrf
                @method('PUT')

                <div class="row">
               <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Therapy Room</label>
            <select class="form-control" name="therapy_room_id" id="therapy_room_id">
                <option value="">Select Therapy Room</option>
                @foreach($therapyroom as $id => $roomName)
                <option value="{{ $id }}"{{ $id == $roomassigning->therapy_room_id ? ' selected' : '' }}>{{ $roomName }}</option>
                @endforeach
            </select>
        </div>
    </div>

     <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Branch</label>
            <select class="form-control" name="branch_id" id="branch_id">
                <option value="">Select Branch</option>
                @foreach($branch as $id => $branchName)
                <option value="{{ $id }}"{{ $id == $roomassigning->branch_id ? ' selected' : '' }}>{{ $branchName }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Staff</label>
            <select class="form-control" name="staff_id" id="staff_id">
                <option value="">Select Staff</option>
                @foreach($staff as $id => $staffName)
                <option value="{{ $id }}"{{ $id == $roomassigning->staff_id ? ' selected' : '' }}>{{ $staffName }}</option>
                @endforeach
            </select>
        </div>
    </div>
   
</div>

                    
                      
<div class="col-md-6">
    <div class="form-group">
        <div class="form-label">Status</div>
        <label class="custom-switch">
            <input type="checkbox" id="is_active" name="is_active" onchange="toggleStatus(this)" class="custom-switch-input" @if($roomassigning->is_active) checked @endif>
            <span id="statusLabel" class="custom-switch-indicator"></span>
            <span id="statusText" class="custom-switch-description">
                @if($roomassigning->is_active)
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
                           
                           <a class="btn btn-danger" href="{{route('therapyroomassigning.index')}}">Cancel</a>
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
