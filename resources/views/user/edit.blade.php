@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row" style="min-height: 70vh;">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">Edit User</h3>
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
               <form action="{{route('user.update',['id'=>$user->user_id])}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Username*</label>
                           <input type="text" class="form-control" required name="username" value="{{ $user->username }}" placeholder="Username">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Password</label>
                           <div class="input-group">
                              <input type="password" class="form-control"  name="password" id="password" placeholder="Password">
                              <div class="input-group-append">
                                 <span class="input-group-text">
                                 <i class="fa fa-eye-slash password-eye-slash" id="eye"
                                    onclick="togglePassword()"
                                    style="position: absolute; top: 18px; right:15px; color:#000"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Confirm Password</label>
                           <div class="input-group">
                              <input type="password" class="form-control"  name="confirm_password"  placeholder="Confirm Password" id="confirmPassword" onkeyup="validatePassword()">
                              <div class="input-group-append">
                                 <span class="input-group-text">
                                 <i class="fa fa-eye-slash password-eye-slash" id="confirmEye"
                                    onclick="toggleConfirmPassword()"
                                    style="position: absolute; top: 18px; right:15px; color:#000"></i>
                                 </span>
                              </div>
                           </div>
                           <small id="password_error" class="text-secondary"  style="color: green; display: none;">Passwords do not match.</small>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">User Email*</label>
                           <input type="text" class="form-control" required name="user_email" value="{{ $user->user_email }}" placeholder="User Email">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">User Type*</label>
                           <select class="form-control" name="user_type_id" id="user_type_id">
                              <option value="">Choose User Type</option>
                              @foreach($userTypes as $id => $userType)
                              <option value="{{ $id }}"{{$id == $user->user_type_id ?' selected' : ''}}>{{ $userType }}</option>
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
                              <option value="{{ $id }}"{{$id == $user->staff_id ?' selected' : ''}}>{{ $staffName }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-label">Status</div>
                           <label class="custom-switch">
                              <input type="hidden" name="is_active" value="0"> <!-- Hidden field for false value -->
                              <input type="checkbox" id="is_active" name="is_active" onchange="toggleStatus(this)" class="custom-switch-input" checked>
                              <span id="statusLabel" class="custom-switch-indicator"></span>
                              <span id="statusText" class="custom-switch-description">Active</span>
                           </label>
                        </div>
                     </div>
                  </div>
                  <!-- ... -->
                  <div class="form-group">
                     <center>
                        <button type="submit" class="btn btn-raised btn-primary">
                        <i class="fa fa-check-square-o"></i> Update</button>
                        <a class="btn btn-danger" href="{{route('user.index')}}">Cancel</a>
                     </center>
                  </div>
            </div>
         </div>
         </form>
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
   
   function togglePasswordVisibility(inputFieldId) {
       var inputField = document.getElementById(inputFieldId);
       if (inputField.type === "password") {
           inputField.type = "text";
       } else {
           inputField.type = "password";
       }
   }
   
   function togglePassword() {
            const passwordInput = document.querySelector("#password");
   
            if (passwordInput.getAttribute("type") == "text") {
                $("#eye").removeClass("fa-eye");
                $("#eye").addClass("fa-eye-slash");
   
            } else {
                $("#eye").removeClass("fa-eye-slash");
                $("#eye").addClass("fa-eye");
   
            }
   
            const type = passwordInput.getAttribute("type") === "text" ? "password" : "text"
            passwordInput.setAttribute("type", type)
        }
   
   //function for confirmPassword eye icon:
    function toggleConfirmPassword() {
    const confirmPasswordInput = document.querySelector("#confirmPassword");
   
    if (confirmPasswordInput.getAttribute("type") == "text") {
        $("#confirmEye").removeClass("fa-eye");
        $("#confirmEye").addClass("fa-eye-slash");
    } else {
        $("#confirmEye").removeClass("fa-eye-slash");
        $("#confirmEye").addClass("fa-eye");
    }
   
    const type = confirmPasswordInput.getAttribute("type") === "text" ? "password" : "text";
    confirmPasswordInput.setAttribute("type", type);
   }
   //function to validate password: 
   function validatePassword() {
        var passwordInput = document.getElementById("password");
        var confirmInput = document.getElementById("confirmPassword");
        var passwordError = document.getElementById("password_error");
        
        if (passwordInput.value !== confirmInput.value) {
            passwordError.style.display = "block";
        } else {
            passwordError.style.display = "none";
        }
    }
   
</script>
@endsection