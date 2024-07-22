@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="min-height: 70vh;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 card-title">Edit Therapy Room</h3>
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
                    <form action="{{ route('therapyrooms.update',['id'=>$therapyroom->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Room Name</label>
                                    <input type="text" class="form-control" required name="room_name" maxlength="50" value="{{ $therapyroom->room_name }}" placeholder="Room Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Branch</label>
                                    <select class="form-control" name="branch_id" id="branch_id">
                                        <option value="">Choose Branch</option>
                                        @foreach($branch as $id => $branchName)
                                        <option value="{{ $id }}"{{ $id == $therapyroom->branch_id ? ' selected' : '' }}>
                                            {{ $branchName }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                          <!-- <div class="col-md-6">
                            <div class="form-group">
                               <label class="form-label">Room Capacity</label>
                                  <select class="form-control" name="room_capacity" required>
                                   <option value="" disabled>Select Room Capacity</option>
                               @for($i = 1; $i <= 10; $i++)
                                   <option value="{{ $i }}"{{ $i == $therapyroom->room_capacity ? ' selected' : '' }}>
                                    {{ $i }}
                                   </option>
                               @endfor
                            </select>
                            </div>
                            </div> -->

                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Room Type</label>
                                    <select class="form-control" name="room_type" id="room_type">
                                        <option value="">Select Room Type</option>
                                        @foreach($roomtype as $masterId => $masterValue)
                                        <option value="{{ $masterId }}"{{ $masterId == $therapyroom->room_type ? ' selected' : '' }}>
                                            {{ $masterValue }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label">Status</div>
                                    <label class="custom-switch">
                                        <input type="checkbox" id="is_active" name="is_active" onchange="toggleStatus(this)" class="custom-switch-input" @if($therapyroom->is_active) checked @endif>
                                        <span id="statusLabel" class="custom-switch-indicator"></span>
                                        <span id="statusText" class="custom-switch-description">
                                            @if($therapyroom->is_active)
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <center>
                                        <button type="submit" class="btn btn-raised btn-primary">
                                            <i class="fa fa-check-square-o"></i> Update
                                        </button>
                                       
                                        <a class="btn btn-danger" href="{{ route('therapyrooms.index') }}">Cancel</a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
