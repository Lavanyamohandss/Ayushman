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
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('account.ledger.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Account Group*</label>
                                    <select class="form-control" name="account_group_id" id="account_group_id">
                                        <option value="">Choose Account Group</option>
                                        @foreach($account_groups as $account_group)
                                        <option value="{{ $account_group->id }}" {{ old('branch') == $account_group->id ? 'selected' : '' }}>{{ $account_group->account_group_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Account Sub Group*</label>
                                    <select class="form-control" name="account_sub_group_id" id="account_sub_group_id">
                                        <option value="">Choose Account Sub Group</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Ledger Name*</label>
                                    <input type="text" class="form-control" required name="ledger_name" value="{{old('ledger_name')}}" placeholder="Ledger Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Notes</label>
                                    <textarea type="text" class="form-control" name="ledger_notes" value="{{old('ledger_notes')}}" placeholder="Notes.."></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label">Status</div>
                                    <label class="custom-switch">
                                        <!-- Hidden field for false value -->
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" id="is_active" name="is_active" onchange="toggleStatus(this)" class="custom-switch-input" checked value="1">
                                        <span id="statusLabel" class="custom-switch-indicator"></span>
                                        <span id="statusText" class="custom-switch-description">Active</span>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <center>
                                        <button type="submit" class="btn btn-raised btn-primary">
                                            <i class="fa fa-check-square-o"></i> Add</button>
                                        <button type="reset" class="btn btn-raised btn-success">
                                            Reset</button>
                                        <a class="btn btn-danger" href="{{ route('account.ledger.index') }}">Cancel</a>
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
    $(document).ready(function() {
        $('#account_group_id').on('change', function() {
            var selectedAccountGroup = $(this).val();

            $.ajax({
                url: "{{ route('get.account.sub.groups', '') }}/" + selectedAccountGroup,
                method: "patch",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    $('#account_sub_group_id').empty().append('<option value="">Choose Account Sub Group</option>'); 
                    $.each(data, function(key, value) {
                        
                        $('#account_sub_group_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function() {
                    console.log('Error fetching account sub groups.');
                }
            });

        });
    });

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