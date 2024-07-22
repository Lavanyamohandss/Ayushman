@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Edit Slot</strong></h3>
            </div>
            <form action="{{ route('mastervalues.update', $timeslot->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="slot_name"><b>Slot Name</b></label>
                            <input type="text" id="slot_name" required name="master_value" value="{{ $timeslot->master_value }}" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div>
                           
                                   <button type="submit" class="btn btn-raised btn-primary">
                                   <i class="fa fa-check-square-o"></i>Update
                                   </button>
        
                            <a class="btn btn-primary" href="{{ route('timeslot.index') }}">
                                <i class="fa fa-times" aria-hidden="true"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
