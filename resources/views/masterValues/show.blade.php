@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Master Values</h1>
    
    <div class="show-container">
    
            <p><strong>Master Type:</strong> {{$show->masterValue->master_name}}</p>
            @if ($show->groupType)
                <p><strong>Group Type:</strong> {{ $show->groupType->master_name }}</p>
            @endif
            <p><strong>Master Value:</strong> {{ $show->master_value }}</p>

             <a class="btn btn-secondary ml-2" href="{{ route('mastervalues.index') }}"><i class="fa fa-times" aria-hidden="true"></i>Back</a>
       
</div>

@endsection
