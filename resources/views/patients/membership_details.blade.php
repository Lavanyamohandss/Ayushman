@extends('layouts.app')
@section('content')
<style>
   .package-details {
   background-color: #f5f5f5;
   padding: 20px;
   border-radius: 10px;
   }
   .package-title {
   font-size: 18px;
   color: #333;
   margin-bottom: 10px;
   }
   .package-description {
   font-size: 14px;
   color: #666;
   margin-bottom: 15px;
   }
   .package-info {
   list-style-type: none;
   padding: 0;
   margin: 0;
   }
   .package-info li {
   font-size: 14px;
   color: #444;
   margin-bottom: 8px;
   }
   .bullet-list {
   list-style-type: disc;
   }
</style>
<!-- ROW-1 OPEN -->
<form action="{{ route('patientsMembership.store',['id' => $id ]) }}" method="POST" enctype="multipart/form-data">
   @csrf
   <div class="row" id="user-profile">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="wideget-user">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="wideget-user-desc d-sm-flex">
                           <!-- Heading -->
                           <div class="wideget-user-img">
                              <h5 class="mb-0">Basic Details</h5>
                           </div>
                           <!-- Back Button -->
                           <div class="wideget-user-img ml-auto mb-4">
                              <a href="{{ URL::previous() }}" class="btn btn-secondary">Back</a>
                           </div>
                        </div>
                        
                     <div class="card-body">
                        <div class="row" style="align-items: flex-end;">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="branch_id" class="form-label">Membership</label>
                                 <select id="membership"  class="form-control" name="membership" >
                                    <option value="">Choose Membership</option>
                                    @foreach($memberships as $membershipId => $packageTitle)
                                    <option value="{{ $membershipId }}">
                                       {{ $packageTitle }}
                                    </option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <button type="button" class="btn btn-primary" style="margin-bottom: 1rem;" id="viewDetails" onclick="loadWellness()">View Details</button>
                              {{-- <div id="wellness-details" class="row"></div>
                              <div id="packageDetails"></div> --}}
                           </div>
                           <div id="wellness-details" class="row col-md-12"></div>
                           <div id="packageDetails" class="mb-5" style="padding: 0 15px;"></div>
                        </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control" required name="start_date" placeholder="Start Date">
                                 </div>
                              </div>
                             
                           </div>
                           <div id="packageDetails1">
                              {{-- 
                              <h2 class="package-title"></h2>
                              <ul class="package-info">
                                 <li><strong>Duration:</strong> days</li>
                                 <li><strong>Price:</strong> </li>
                                 <li><strong>Status:</strong>
                                    {{-- @if(isset($package_details->is_active) && $package_details->is_active == 1)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif --}}
                                 </li>
                              </ul>
                              <p class="package-description"></p>
                           </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="payment-type" class="form-label">Payment Type</label>
                              <select class="form-control" required name="payment_type" placeholder="Payment Type">
                                 <option value="">Choose Payment Type</option>
                                 @foreach($paymentType as $id => $value)
                                 <option value="{{ $id }}">{{ $value }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row col-md-12">
               <div class="col-md-3">
                  <button type="submit" class="btn btn-raised btn-primary" style="margin: 0 24px;">
                  <i class="fa fa-check-square-o" ></i> Add Membership
                  </button>
               </div>
               
               </div>
               </div>
            </div>
            <div class="border-top">
               <div class="wideget-user-tab">
                  <div class="tab-menu-heading">
                     <div class="tabs-menu1">
                        <ul class="nav">
                           <li class=""><a href="#tab-51" class="active show" data-toggle="tab">Membership History</a></li>
                           {{-- <li><a href="#tab-61" data-toggle="tab" class="">Included benefits</a></li> --}}
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
                <div class="border-0">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-51">
                            <div id="profile-log-switch">
                              
                                <div class="container">
                                    <div id="patient-membership-history" class="row">
                                        @foreach($patientMemberships as $membership)
                                            <div class="col-lg-6 mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Patient Membership History</h4>
                                                        <p class="card-text">
                                                            <strong>Membership Package: </strong>{{ $membership->membershipPackage->package_title }}<br>
                                                            <strong>Start Date: </strong> {{ $membership->start_date }}<br>
                                                            <strong>Payment Type: </strong> {{ $membership->payment_type == 1 ? 'Cash' : 'Liquid'}}<br>
                                                            <strong>Payment Amount: </strong> {{ $membership->payment_amount }}<br>
                                                            <strong>Expiry Date: </strong> {{ $membership->membership_expiry_date }}<br>
                                                            <strong>Status: </strong>
                                                            {{ $membership->is_active == 0 ? 'Inactive' : 'Active' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
                     <div class="tab-pane" id="tab-61">
                        <div id="profile-log-switch">
                           <div class="media-heading">
                              <div class="container">
                                 <div class="row">
                                    <div class="col-lg-6 mb-3" id="benefitDiv">
                                       
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" id="tab-71">
                        {{-- <div class="row">
                           <div class="col-lg-3 col-md-6">
                              <img class="img-fluid rounded mb-5" src="./assets/images/media/8.jpg " alt="banner image">
                           </div>
                           <!-- Other tab content goes here -->
                        </div> --}}
                     </div>
                     <!-- Add more tab content as needed -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- COL-END -->
   </div>
</form>
<!-- ROW-1 CLOSED -->
@endsection
<script>
   // Function to load wellness details based on the selected package
   function loadWellness() {
   	// alert("tets");
   	var membershipId = document.getElementById("membership").value;
   	//alert(x);
       // var membershipId = $("#membership").val();
   	
       if (membershipId) {
           // Now you have the selected membership ID in the 'membershipId' variable
           console.log("Selected Membership ID:", membershipId);
           $.ajax({
               type: 'GET',
               url: '/get-wellness-details/' + membershipId,
               success: function(response) {
                   // Update the wellness details container with the received data
   				console.log(response)
                  // $("#wellness-details").html(response);
   			   const wellnessData=  $("#wellness-details");
   			  const benefits =  $("#benefitDiv");
   			  const packageDetails =  $("#packageDetails");
   			   wellnessData.empty();
   			   benefits.empty();
   			   packageDetails.empty();
   			   response.wellnessDetails.forEach(element => {
   				//alert(element.wellness_name);
   				const divEl = `
   				<div class="col-lg-3 mb-3">
                                                   <div class="card mb-0">
                                                       <div class="card-body">
                                                           <h4 class="card-title">${ element.wellness_name }</h4>
                                                           <p class="card-text">
                                                               <strong>Duration:</strong> ${ element.wellness_duration} <br>
                                                               <strong>Maximum Usage Limit:</strong> ${ element.maximum_usage_limit }<br>
                                                               <strong>Wellness Inclusions:</strong> ${ element.wellness_inclusions }<br>
   															${element.is_active == 0 ? '<strong>Inactive</strong>' : '<strong>Active</strong>'}
                                                              
                                                           </p>
                                                       </div>
                                                   </div>
                                               </div>
   				`
   				
   				wellnessData.append(divEl);
   			   });
   			   
   				const benefitEl = `
   				<span>${response.benefits.title}</span>
   				`
   				
   				benefits.append(benefitEl);
   				 console.log(response.package_details.package_duration);
   				const packageEl = `
   				<h2 class="package-title"><b>${response.package_details.package_title}</b> </h2>
   								<ul class="package-info">
   									<li><strong>Duration:</strong>${response.package_details.package_duration} days</li>
   									<li><strong>Price:</strong> ${response.package_details.package_price} </li>
   									<li><strong>Status:</strong>
   										${response.package_details.is_active == 0 ? 'Inactive' : 'Active'}
   									</li>
   								</ul>
   								<p class="package-description">${response.package_details.package_description} </p>
   				
   				`
   				
   				packageDetails.append( packageEl );
   			
   
               },
               error: function(error) {
                   console.error(error);
               }
           });
       } else {
           // Handle the case when no package is selected
           $("#wellness-details").html('');
       }
   }
   
   // Attach an event listener to the #membership dropdown
   // $("#viewDetails").click(function() {
   //     // Call the loadWellness function when the dropdown value changes
   //     alert("tes");
   //     loadWellness();
   // });
   
   // Trigger the loadWellness function on page load (if needed)
   $(document).ready(function() {
       loadWellness();
   });
</script> 
