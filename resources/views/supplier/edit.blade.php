@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="min-height: 70vh;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 card-title">Edit Supplier</h3>
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
                    <form action="{{route('supplier.update',['id'=>$supplier->supplier_id])}}" method="POST" enctype="multipart/form-data">
                     @csrf
                    @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Supplier Name</label>
                                    <input type="text" class="form-control" required name="supplier_name"
                                        value="{{$supplier->supplier_name}}" placeholder="Supplier Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Supplier Type</label>
                                    <select class="form-control" required name="supplier_type_id" id="supplier_type_id">
                                        <option value="">Select Supplier Type</option>           
                                        <option value="1" {{ $supplier->supplier_type_id === 1 ? 'selected' : ''}}>Individual</option>
                                        <option value="2" {{ $supplier->supplier_type_id === 2 ? 'selected' : ''}}>Business</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Supplier Address</label>
                                    <textarea class="form-control" required name="supplier_address" 
                                        placeholder="Supplier Address">{{$supplier->supplier_address}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" required name="supplier_city"
                                    value="{{$supplier->supplier_city}}" placeholder="Supplier City">
                                </div>
                            </div>
                        </div>

                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" required name="state"
                                    value="{{$supplier->state}}" placeholder="State">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" required name="country"
                                    value="{{$supplier->country}}" placeholder="Country">
                                </div>
                            </div>
                        </div>

                     
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Pincode</label>
                                    <input type="text" class="form-control" required name="pincode"
                                    value="{{$supplier->pincode}}" placeholder="Pincode">
                                </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label">Business Name</label>
                                  <input type="text" class="form-control" required name="business_name"
                                  value="{{$supplier->business_name}}" placeholder="Business Name">
                              </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" required name="phone_1"
                                    value="{{$supplier->phone_1}}" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Alternative Number</label>
                                    <input type="text" class="form-control" required name="phone_2"
                                    value="{{$supplier->phone_2}}" placeholder="Alternative Number">
                                </div>
                            </div>
                        </div>

                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" required name="email"
                                    value="{{$supplier->email}}" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Website</label>
                                    <input type="text" class="form-control" required name="website"
                                    value="{{$supplier->website}}" placeholder="Website">
                                </div>
                            </div>
                        </div>

                       
                     

                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Credit Period</label>
                                    <input type="text" class="form-control" required name="credit_period"
                                    value="{{$supplier->credit_period}}" placeholder="Credit Period">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Credit Limit</label>
                                    <input type="text" class="form-control" required name="credit_limit"
                                    value="{{$supplier->credit_limit}}" placeholder="Credit Limit">
                                </div>
                            </div>
                        </div>

                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Opening Balance</label>
                                    <input type="text" class="form-control" required name="opening_balance"
                                    value="{{$supplier->opening_balance}}" placeholder="Opening Balance">
                                </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label">Opening Balance Type</label>
                                  <select class="form-control" required name="opening_balance_type" id="opening_balance_type">
                                      <option value="">Select Balance Type</option>
                                      <option value="1" {{ $supplier->opening_balance_type === 1 ? 'selected' : '' }}>Debit</option>
                                      <option value="2" {{ $supplier->opening_balance_type === 2 ? 'selected' : '' }}>Credit</option>
                                  </select>
                              </div>
                          </div>
                          
                        </div>

                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Account Ledger</label>
                                    <input type="text" class="form-control" required name="account_ledger_id"
                                    value="{{$supplier->account_ledger_id}}" placeholder="Account Ledger">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Terms And Condition</label>
                                    <textarea class="form-control" required name="terms_and_conditions"  
                                        placeholder="Terms And Condition">{{$supplier->terms_and_conditions}}</textarea>
                                </div>
                            </div>
                        </div>

                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Opening Balance Date</label>
                                    <input type="date" class="form-control" required name="opening_balance_date"
                                    value="{{$supplier->opening_balance_date}}" placeholder="Opening Balance Date">
                                </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label">GSTNO</label>
                                  <input type="text" class="form-control" required name="GSTNO"
                                  value="{{$supplier->GSTNO}}" placeholder="GSTNO">
                              </div>
                          </div>
                           
<div class="row">
   <div class="col-md-6">
      <div class="form-group">
          <div class="form-label">Status</div>
          <label class="custom-switch">
              <input type="hidden" name="is_active" value="0">
              <input type="checkbox" id="is_active" name="is_active"
                  onchange="toggleStatus(this)" class="custom-switch-input" checked>
              <span id="statusLabel" class="custom-switch-indicator"></span>
              <span id="statusText" class="custom-switch-description">Active</span>
          </label>
      </div>
  </div>
</div>
</div>
                     
                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-raised btn-primary">
                                    <i class="fa fa-check-square-o"></i> Update</button>
                                <button type="reset" class="btn btn-raised btn-success">
                                    Reset</button>
                                <a class="btn btn-danger" href="{{ route('supplier.index') }}">Cancel</a>
                            </center>
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
