@extends('layouts.app')
@section('content')
<!-- ROW-1 OPEN -->

<div class="row" id="user-profile">
<div class="col-lg-12">
   <div class="card">
      <div class="card-body">
         <div class="wideget-user">
            <div class="row">
               <div class="col-lg-6 col-md-12">
                  <div class="wideget-user-desc d-sm-flex">
                     <div class="wideget-user-img">
                        <img class="user-pic" src="{{ asset('assets/images/avatar.png') }}" alt="img">
                     </div>
                     <div class="user-wrap">
                        <h4><strong>{{ $show->staff_name}}</strong></h4>
                        <h6 class="text-muted mb-3">Member Since: {{$show->last_login_time}}</h6>
                        @if($show->is_active == 0)
                        <span class="badge badge-danger">Inactive</span>
                        @else
                        <span class="badge badge-success">Active</span>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-12">
                  <div class="wideget-user-info">
                     <div class="wideget-user-icons">
                        <a href="#" class="bg-facebook text-white mt-0"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="bg-info text-white"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="bg-google text-white"><i class="fa fa-google"></i></a>
                        <a href="#" class="bg-dribbble text-white"><i class="fa fa-dribbble"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="border-top">
         <div class="wideget-user-tab">
            <div class="tab-menu-heading">
               <div class="tabs-menu1">
                  <ul class="nav">
                     <li class=""><a href="#tab-51" class="active show" data-toggle="tab">Basic Details</a></li>
                     <li><a href="#tab-61" data-toggle="tab" class="">Qualification</a></li>
                     <li><a href="#tab-71" data-toggle="tab" class="">Salary Details</a></li>
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
                     <div class="media-heading">
                        <h5><strong>Staff Information</strong></h5>
                     </div>
                     <div class="table-responsive ">
                        <table class="table row table-borderless">
                           <tbody class="col-lg-12 col-xl-6 p-0">
                              <tr>
                                 <td><strong>Staff Code :</strong>{{$show->staff_code ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Staff Type:</strong>{{ $show->staffType->master_value ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Employment Type :</strong> {{ $show->employmemntType->master_value ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Staff Username :</strong> {{ $show->staff_username ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Staff Name :</strong> {{ $show->staff_name ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Gender :</strong> {{ $show->Gender->master_value ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Branch :</strong> {{ $show->branch->branch_name ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Date Of Birth :</strong> {{\Carbon\Carbon::parse($show->date_of_birth)->format('d/m/Y') ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Staff Email :</strong> {{ $show->staff_email ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Staff Contact Number :</strong> {{ $show->staff_contact_number ??''}}</td>
                              </tr>
                           </tbody>
                           <tbody class="col-lg-12 col-xl-6 p-0">
                              <tr>
                                 <td><strong>Staff Address:</strong>{{ $show->staff_address ??''}}</td>
                              </tr>
                          
                              <tr>
                                 <td><strong>Staff Salary Type:</strong> {{ $show->salaryType->salary_type ?? '' }}</td>
                             </tr>
                             
                              <tr>
                                 <td><strong>Salary Amount:</strong>{{ $show->salary_amount ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Qualification :</strong>  {{ $show->staff_qualification ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Specialization :</strong>  {{ $show->staff_specialization ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Work Experience :</strong>  {{ $show->staff_work_experience ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Commission Type :</strong>  {{ $show->staff_commission_type ??''}}</td>
                              </tr>
                              <tr>
                                 <td><strong>Staff Commission :</strong>{{ $show->staff_commission ??''}}</td>
                              </tr>
                              <!-- Check if staff_booking_fee has a value before displaying the field -->
                              @if (!empty($show->max_discount_value))
                              <tr>
                                 <td><strong>Max Discount Value :</strong> {{ $show->max_discount_value }}%</td>
                              </tr>
                              @endif
                              @if (!empty($show->staff_booking_fee))
                              <tr>
                                 <td><strong>Booking Fee :</strong> {{ $show->staff_booking_fee }}</td>
                              </tr>
                              @endif
                              <tr>
                                 <td><strong>Last Login Time :</strong>{{ $show->last_login_time}}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <a class="btn btn-secondary ml-2" href="{{ route('staffs.index') }}"><i class="" aria-hidden="true"></i>Back</a>
                  </div>
               </div>
               <div class="tab-pane" id="tab-61">
                  <div class="media-heading">
                     <h5><strong>Staff Qualification</strong></h5>
                  </div>
                  <ul class="widget-users row">
                     <li class="col-lg-4  col-md-6 col-sm-12 col-12">
                        <div class="card">
                           <div class="card-body text-center">
                              <h4 class="h4 mb-0 mt-3">{{ $show->staff_name??''}}</h4>
                              <p class="card-text">{{ $show->staff_qualification??''}}</p>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
               <div class="tab-pane" id="tab-71">
                  <div class="media-heading">
                     <h5><strong>Staff Salary Information</strong></h5>
                  </div>
                  <ul class="widget-users row">
                  <li class="col-lg-4  col-md-6 col-sm-12 col-12">
                     <div class="card">
                        <div class="card-body text-center">
                           <h4 class="h5 mb-0 mt-3">{{ $show->salaryType->salary_type ?? ''}}</h4>
                           <p class="card-text">₹{{ $show->salary_amount ?? ''}}</p>
                        </div>
                     </div>
                  </li>
                  {{-- 
                  <div class="tab-pane" id="tab-81">
                     <div class="row">
                        <div class=" col-lg-6 col-md-12">
                           <div class="card borderover-flow-hidden">
                              <div class="media card-body media-xs overflow-visible ">
                                 <img class="avatar brround avatar-md mr-3" src="./assets/images/users/18.jpg" alt="avatar-img">
                                 <div class="media-body valign-middle mt-2">
                                    <a href="" class=" font-weight-semibold text-dark">John Paige</a>
                                    <p class="text-muted ">johan@gmail.com</p>
                                 </div>
                                 <div class="media-body valign-middle text-right overflow-visible mt-2">
                                    <button class="btn btn-primary" type="button">Follow</button> </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class=" col-lg-6 col-md-12">
                           <div class="card borderover-flow-hidden">
                              <div class="media card-body media-xs overflow-visible ">
                                 <span class="avatar cover-image avatar-md brround bg-pink mr-3">LQ</span>
                                 <div class="media-body valign-middle mt-2">
                                    <a href="" class="font-weight-semibold text-dark">Lillian Quinn</a>
                                    <p class="text-muted">lilliangore</p>
                                 </div>
                                 <div class="media-body valign-middle text-right overflow-visible mt-2">
                                    <button class="btn btn-secondary" type="button">Follow</button> </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class=" col-lg-6 col-md-12">
                           <div class="card borderover-flow-hidden mb-lg-0">
                              <div class="media card-body media-xs overflow-visible ">
                                 <span class="avatar cover-image avatar-md brround mr-3">IH</span>
                                 <div class="media-body valign-middle mt-2">
                                    <a href="" class="font-weight-semibold text-dark">Irene Harris</a>
                                    <p class="text-muted">ireneharris@gmail.com</p>
                                 </div>
                                 <div class="media-body valign-middle text-right overflow-visible mt-2">
                                    <button class="btn btn-success" type="button">Follow</button> </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class=" col-lg-6 col-md-12">
                           <div class="card borderover-flow-hidden mb-lg-0">
                              <div class="media card-body media-xs overflow-visible ">
                                 <img class="avatar brround avatar-md mr-3" src="./assets/images/users/2.jpg" alt="avatar-img">
                                 <div class="media-body valign-middle mt-2">
                                    <a href="" class="text-dark font-weight-semibold">Harry Fisher</a>
                                    <p class="text-muted mb-0">harryuqt</p>
                                 </div>
                                 <div class="media-body valign-middle text-right overflow-visible mt-2">
                                    <button class="btn btn-danger" type="button">Follow</button> </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     --}}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- COL-END -->
</div>

<!-- ROW-1 CLOSED -->
@endsection