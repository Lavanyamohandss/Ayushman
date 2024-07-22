@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">Create Tax</h3>
            </div>
            <div class="card-body">
               @if ($message = Session::get('status'))
               <div class="alert alert-success">
                  <p></p>
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
               <form action="{{ route('tax.group.update',['id'=>$tax->id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Name*</label>
                           <input type="text" class="form-control" required name="tax_group_name" value="{{$tax->tax_group_name}}" placeholder="Tax Group Name">
                        </div>
                     </div>
                  </div>
                  <p><span>Total Tax Rate:</span> <span id="totalTaxRate" style="color: green;">0%</span></p>

                  <h6><b>Include taxes*</b></h6>
                  <div class="row">
                     @foreach($taxes as $tax)
                     <div class="col-md-3">
                        <div class="form-check">
                           @php
                           $isChecked = in_array($tax->id, $included_tax_ids);
                           @endphp
                           <input type="checkbox" {{ $isChecked ? 'checked' : '' }} class="form-check-input" name="included_tax[]" id="included_tax{{ $tax->id }}" value="{{ $tax->id }}" data-tax-rate="{{ $tax->tax_rate }}">
                           <label class="form-check-label" for="included tax{{ $tax->id }}">{{ $tax->tax_name }} - {{ $tax->tax_rate }}%</label>
                        </div>
                     </div>
                     @endforeach


                  </div>



                  <div class="form-group">
                     <center>
                        <button type="submit" class="btn btn-raised btn-primary">
                           <i class="fa fa-check-square-o"></i> Update
                        </button>
                        <a class="btn btn-danger" href="{{ route('tax.group.index') }}">Cancel</a>
                     </center>
                  </div>
               </form>


            </div>
         </div>
      </div>

      @endsection
      @section('js')
      <script>
         $(document).ready(function() {
            // Function to calculate and update the total tax rate
            function updateTotalTaxRate() {
               let totalTaxRate = 0;

               // Iterate through checked checkboxes and add their tax rates
               $('input[name="included_tax[]"]:checked').each(function() {
                  // Extract the tax rate from the data attribute (e.g., data-tax-rate="5.00")
                  const taxRate = parseFloat($(this).data('tax-rate'));

                  // Add the tax rate to the total
                  totalTaxRate += taxRate;
               });

               // Update the total tax rate in the <span> element
               $('#totalTaxRate').text(totalTaxRate.toFixed(2) + '%');
            }

            // Initialize the total tax rate when the page loads
            updateTotalTaxRate();

            // Add an event listener to the checkboxes
            $('input[name="included_tax[]"]').on('change', function() {
               // Update the total tax rate when checkboxes change
               updateTotalTaxRate();
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