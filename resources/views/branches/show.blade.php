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
															<img class="user-pic" src="{{ asset('assets/images/ayushman.jpg') }}" alt="img">
														</div>
														<div class="user-wrap">
															<h4><strong>{{ $show->branch_name}}</strong></h4>
															 @if($show->is_active == 0)
                                                            <span class="badge badge-danger">Inactive</span>
                                                            @else
                                                            <span class="badge badge-success">Active</span>
                                                         @endif
														</div>
													</div>
												</div>
												
											</div>
										</div>
									</div>
									<!--<div class="border-top">-->
									<!--	<div class="wideget-user-tab">-->
									<!--		<div class="tab-menu-heading">-->
									<!--			<div class="tabs-menu1">-->
									<!--				<ul class="nav">-->
									<!--					<li class=""><a href=""  data-toggle="tab">Profile</a></li>-->
									<!--				</ul>-->
									<!--			</div>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--</div>-->
								</div>
								<div class="card">
									<div class="card-body">
										<div class="border-0">
											<div class="tab-content">
												<div class="tab-pane active show" id="tab-51">
													<div id="profile-log-switch">
														<div class="media-heading">
															<h5><strong>Branch Information</strong></h5>
														</div>
														<div class="table-responsive ">
															<table class="table row table-borderless">
																<tbody class="col-lg-12 col-xl-6 p-0">
																	<tr>
																		<td><strong>Branch Code :</strong>{{$show->branch_code}}</td>
																	</tr>
																	<tr>
																		<td><strong>Branch Name:</strong>{{ $show->branch_name}}</td>
																	</tr>
																	<tr>
																		<td><strong>Branch Address :</strong>{{ $show->branch_address}}</td>
																	</tr>
                                                                    <tr>
																		<td><strong>Branch Contact Number:</strong>{{ $show->branch_contact_number}}</td>
																	</tr>
																	<tr>
																		<td><strong>Branch Email :</strong>{{ $show->branch_email }}</td>
																	</tr>
																</tbody>
																<tbody class="col-lg-12 col-xl-6 p-0">
																	
																	<tr>
																		<td><strong>Branch Admin Name:</strong>{{ $show->branch_admin_name}}</td>
																	</tr>
																	<tr>
																		<td><strong>Branch Admin Contact Number :</strong> {{ $show->branch_admin_contact_number}}</td>
																	</tr>
																	<tr>
																		<td><strong>Latitude :</strong>{{ $show->latitude }}</td>
																	</tr>
																	<tr>
																		<td><strong>Longitude :</strong>{{ $show->longitude }}</td>
																	</tr>
                                                                    
																</tbody>
															</table>
														</div>
														  <a class="btn btn-secondary ml-2" href="{{ route('branches') }}"><i class="" aria-hidden="true"></i>Back</a>
													</div>
												</div>
                                                <div class="tab-pane" id="tab-61">
													<ul class="widget-users row">
														<li class="col-lg-4  col-md-6 col-sm-12 col-12">
															<div class="card">
																<div class="card-body text-center">
																	<span class="avatar avatar-xxl brround cover-image" data-image-src="./assets/images/users/15.jpg"></span>
																	<h4 class="h4 mb-0 mt-3">James Thomas</h4>
																	<p class="card-text">Web designer</p>
																</div>
																<div class="card-footer text-center">
																	<div class="row user-social-detail">
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</li>
														<li class="col-lg-4 col-md-6 col-sm-12 col-12">
															<div class="card">
																<div class="card-body text-center">
																	<span class="avatar avatar-xxl brround cover-image" data-image-src="./assets/images/users/9.jpg"></span>
																	<h4 class="h4 mb-0 mt-3">George Clooney</h4>
																	<p class="card-text">Web designer</p>
																</div>
																<div class="card-footer text-center">
																	<div class="row user-social-detail">
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</li>
														<li class="col-lg-4 col-md-6 col-sm-12 col-12">
															<div class="card">
																<div class="card-body text-center">
																	<span class="avatar avatar-xxl brround cover-image" data-image-src="./assets/images/users/20.jpg"></span>
																	<h4 class="h4 mb-0 mt-3">Robert Downey Jr.</h4>
																	<p class="card-text">Web designer</p>
																</div>
																<div class="card-footer text-center">
																	<div class="row user-social-detail">
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</li>
														<li class="col-lg-4 col-md-6 col-sm-12 col-12">
															<div class="card mb-lg-0">
																<div class="card-body text-center">
																	<span class="avatar avatar-xxl brround cover-image" data-image-src="./assets/images/users/12.jpg"></span>
																	<h4 class="h4 mb-0 mt-3">Emma Watson</h4>
																	<p class="card-text">Web designer</p>
																</div>
																<div class="card-footer text-center">
																	<div class="row user-social-detail">
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</li>
														<li class="col-lg-4 col-md-6 col-sm-12 col-12">
															<div class="card mb-lg-0">
																<div class="card-body text-center">
																	<span class="avatar avatar-xxl brround cover-image" data-image-src="./assets/images/users/4.jpg"></span>
																	<h4 class="h4 mb-0 mt-3">Mila Kunis</h4>
																	<p class="card-text">Web designer</p>
																</div>
																<div class="card-footer text-center">
																	<div class="row user-social-detail">
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</li>
														<li class="col-lg-4 col-md-6 col-sm-12 col-12">
															<div class="card mb-0">
																<div class="card-body text-center">
																	<span class="avatar avatar-xxl brround cover-image" data-image-src="./assets/images/users/6.jpg"></span>
																	<h4 class="h4 mb-0 mt-3">Ryan Gossling</h4>
																	<p class="card-text">Web designer</p>
																</div>
																<div class="card-footer text-center">
																	<div class="row user-social-detail">
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
																		</div>
																		<div class="col-lg-4 col-sm-4 col-4">
																			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</li>
													</ul>
												</div>
												<div class="tab-pane" id="tab-71">
													<div class="row">
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-5" src="./assets/images/media/8.jpg " alt="banner image">
														</div>
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-5" src="./assets/images/media/10.jpg" alt="banner image ">
														</div>
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-5" src="./assets/images/media/11.jpg" alt="banner image ">
														</div>
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-5 " src="./assets/images/media/12.jpg" alt="banner image ">
														</div>
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-5" src="./assets/images/media/13.jpg " alt="banner image">
														</div>
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-5" src="./assets/images/media/14.jpg " alt="banner image">
														</div>
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-5" src="./assets/images/media/15.jpg " alt="banner image">
														</div>
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-0" src="./assets/images/media/16.jpg " alt="banner image">
														</div>
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-0" src="./assets/images/media/17.jpg " alt="banner image">
														</div><div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-0" src="./assets/images/media/18.jpg " alt="banner image">
														</div>
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded mb-0" src="./assets/images/media/19.jpg " alt="banner image">
														</div>
														<div class="col-lg-3 col-md-6">
															<img class="img-fluid rounded" src="./assets/images/media/20.jpg " alt="banner image">
														</div>
													</div>
												</div>
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
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- COL-END -->
						</div>
						<!-- ROW-1 CLOSED -->
			

@endsection