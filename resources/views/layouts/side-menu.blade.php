<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="side-header">
    <a class="header-brand1" href="#">
      <img src="{{asset('assets/images/ayushman-logo.jpeg')}}" class="header-brand-img desktop-logo" alt="logo">
      <img src="{{asset('assets/images/ayushman-logo.jpeg')}}" class="header-brand-img toggle-logo" alt="logo">
      <img src="{{asset('assets/images/ayushman-logo.jpeg')}}" class="header-brand-img light-logo" alt="logo">
      <img src="{{ asset('assets/images/logo.png') }}" class="header-brand-img light-logo1" alt="logo"> </a><!-- LOGO -->
    <a aria-label="Hide Sidebar" class="app-sidebar__toggle ml-auto" data-toggle="sidebar" href="#"></a><!-- sidebar-toggle-->
  </div>
  <div class="app-sidebar__user">
    <div class="dropdown user-pro-body text-center">
      <div class="user-pic">
        <img src="{{ asset('assets/images/avatar.png') }}" alt="user-img" class="avatar-xl rounded-circle">
      </div>
      <div class="user-info">
        <span class="text-muted app-sidebar__user-name text-sm">Administrator</span>
      </div>
    </div>
  </div>
  

  <ul class="side-menu">
    <li class="slide">
      <a class="side-menu__item {{ Request::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="side-menu__icon ti-home"></i>
        <span class="side-menu__label">Dashboard</span>
      </a>
    </li>
    <!-- Other menu items -->
  </ul>

  <div class="container">
    <li class="slide">
      <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-panel"></i><span class="side-menu__label">{{ __('Masters') }}</span><i class="angle fa fa-angle-right"></i></a>
      <ul class="slide-menu">
        <!-- <li><a class="slide-item" href="{{ url('/masters') }}">{{ __('Master Values') }}</a></li> -->
        {{-- <li><a class="slide-item" href="{{ url('/qualifications') }}">{{ __('Qualifications') }}</a></li> --}}
        <li><a class="slide-item" href="{{ route('medicine.dosage.index') }}">{{ __('Medicine Dosage') }}</a></li>
        <!-- <li><a class="slide-item" href="{{ route('leave.type.index') }}">{{ __('Leave Types') }}</a></li> -->
        <li><a class="slide-item" href="{{ route('manufacturer.index') }}">{{ __('Manufacturers') }}</a></li>
        <li><a class="slide-item" href="{{ url('/branches') }}">{{ __('Branches') }}</a></li>
        <!-- <li><a class="slide-item" href="{{ url('/staffs/index')}}">{{ __('Staffs') }}</a></li> -->
        <li><a class="slide-item" href="{{ url('/therapyrooms/index') }}">{{ __('Therapy Rooms') }}</a></li>
        <!--<li><a class="slide-item" href="{{ url('/therapyroom-assigning/index')}}">{{ __('Therapy Room Assigning') }}</a></li>-->
        <li><a class="slide-item" href="{{ url('/externaldoctors/index')}}">{{ __('External Doctors') }}</a></li>
        <li><a class="slide-item" href="{{ url('/patients/index')}}">{{ __('Patients') }}</a></li>
        <li><a class="slide-item" href="{{ url('/timeslot')}}">{{ __('Timeslots') }}</a></li>
        <li><a class="slide-item" href="{{ url('/medicine/index') }}">{{ __('Medicines') }}</a></li>
        <li><a class="slide-item" href="{{ url('/therapies/index')}}">{{ __('Therapy') }}</a></li>
        <li><a class="slide-item" href="{{ url('membership/index')}}">{{ __('Memberships') }}</a></li>
        <li><a class="slide-item" href="{{ route('supplier.index')}}">{{ __('Suppliers') }}</a></li>
        <li><a class="slide-item" href="{{ url('wellness/index')}}">{{ __('Wellness') }}</a></li>
        <li><a class="slide-item" href="{{ url('/unit/index')}}">{{ __('Units') }}</a></li>
        <li><a class="slide-item" href="{{ url('/user/index')}}">{{ __('Users') }}</a></li>
    </li>
    </ul>

    <!-- HRMS  -->

    <li class="slide">
      <a class="side-menu__item" data-toggle="slide" href="#">
        <i class="side-menu__icon ti-wallet"></i>
        <span class="side-menu__label"> {{ __('HRMS') }}</span><i class="angle fa fa-angle-right"></i>
      </a>
      <ul class="slide-menu">
      <!-- <a class="side-menu__item " href="{{route('branchTransfer.index')}}"><i class="side-menu__icon fa fa-users"></i></i><span class="side-menu__label">Employee Branch Transfer</span></a> -->
        <li><a class="slide-item" href="{{ url('/staffs/index')}}">{{ __('Staffs') }}</a></li>
        <li><a class="slide-item" href="{{ route('leave.type.index') }}">{{ __('Leave Types') }}</a></li>
        <li><a class="slide-item" href="{{route('branchTransfer.index')}}">{{__('Employee Branch Transfer')}}</a></li>
    </li>
    </ul>
<!-- Accounts  -->
    <li class="slide">
      <a class="side-menu__item" data-toggle="slide" href="#">
        <i class="side-menu__icon ti-wallet"></i>
        <span class="side-menu__label"> {{ __('Accounts') }}</span><i class="angle fa fa-angle-right"></i>
      </a>
      <ul class="slide-menu">
        <li><a class="slide-item" href="{{ url('/account-sub-group/index') }}">{{__('Account Subhead')}}</a></li>
        <li><a class="slide-item" href="{{ url('/account-ledger/index') }}">{{__('Account ledger ')}}</a></li>
        <!-- <li><a class="slide-item" href="{{ url('/tax/index')}}">{{ __('Taxes_') }}</a></li> -->
        <li><a class="slide-item" href="{{ url('/tax-group/index')}}">{{ __('Tax Groups') }}</a></li>
        <!-- <li><a class="slide-item" href="#">{{__('Journel Entry')}}</a></li> -->
        <!-- <li><a class="slide-item" href="#">{{__('Attendence View-Biometric')}}</a></li> -->
        <!-- <li><a class="slide-item" href="#">{{__('Income/Expense')}}</a></li> -->
    </li>
    </ul>
    <!-- <li class="slide">
      <a class="side-menu__item " href="{{route('branchTransfer.index')}}"><i class="side-menu__icon fa fa-users"></i></i><span class="side-menu__label">Employee Branch Transfer</span></a>
    </li> -->
    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon ti-receipt"></i>
          <span class="side-menu__label"> {{ __('Billings') }}</span><i class="angle fa fa-angle-right"></i>
    </a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="{{ url('/consultation-billing/index')}}">{{__('Consultation Billing')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Wellness Billing')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Therapy Billing')}}</a></li>
      </li>
    </ul> --}}

    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon ti-check-box"></i>
          <span class="side-menu__label"> {{ __('Settlements') }}</span><i class="angle fa fa-angle-right"></i>
    </a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="#">{{__('Invoice Settlement')}}</a></li>
      </li>
    </ul> --}}


    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon ti-crown"></i>
          <span class="side-menu__label"> {{ __('Membership') }}</span><i class="angle fa fa-angle-right"></i>
    </a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="#">{{__('Manage Patient Memberships')}}</a></li>
      </li>
    </ul> --}}


    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon ti-comment"></i>
          <span class="side-menu__label"> {{ __('Message Center') }}</span>
    </a>
    </li>
    --}}
    {{-- <li class="slide">
             <a class="side-menu__item " href="{{route('booking_type.index')}}"><i class="side-menu__icon fa fa-users"></i></i><span class="side-menu__label">Consultation</span></a>
    </li>


    <li class="slide">
      <a class="side-menu__item " href="{{route('booking_type.wellnessIndex')}}"><i class="side-menu__icon ti-heart"></i></i><span class="side-menu__label">Wellness</span></a>
    </li> --}}

    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon fa fa-heart"></i>
          <span class="side-menu__label"> {{ __('Therapy') }}</span><i class="angle fa fa-angle-right"></i>
    </a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="{{route('booking_type.therapyIndex')}}">{{__('Manage Therapy')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Therapy Refund')}}</a></li>
      </li>
    </ul> --}}

    {{-- <li class="slide">
             <a class="side-menu__item " href="{{route('patient_search.index')}}"><i class="side-menu__icon fa fa-users"></i></i><span class="side-menu__label">Patients</span></a>
    </li> --}}

    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon ti-id-badge"></i>
          <span class="side-menu__label"> {{ __('Staffs') }}</span><i class="angle fa fa-angle-right"></i>
    </a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="#">{{__('Staff Attendence View')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Staff Leaves')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Staff Leave Marking')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Advance Salary')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Salary Processing')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Staff Cash Deposit')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Employee Branch Transfer')}}</a></li>
      </li>
    </ul> --}}

    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon ti-package"></i>
          <span class="side-menu__label"> {{ __('Suppliers') }}</span><i class="angle fa fa-angle-right"></i>
    </a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="{{route('supplier.index')}}">{{__('Manage Suppliers')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Stock Transfer to Other Branches')}}</a></li>
      </li>
    </ul> --}}

    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon ti-credit-card"></i>
          <span class="side-menu__label"> {{ __('Purchase') }}</span><i class="angle fa fa-angle-right"></i>
    </a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="#">{{__('Medicine Purchase')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Purchase Return')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Medicine Stock Updation')}}</a></li>
      </li>
    </ul> --}}


    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon ti-bar-chart"></i>
          <span class="side-menu__label"> {{ __('Sales') }}</span><i class="angle fa fa-angle-right"></i>
    </a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="#">{{__('Medicine Sales')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Sales Return')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Medicine Stock Transfer To Therapy')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Prescription Printing')}}</a></li>
      </li>
    </ul> --}}

    <!-- Purchase Details  -->
    <li class="slide">
      <a class="side-menu__item" data-toggle="slide" href="#">
        <i class="side-menu__icon ti-wallet"></i>
        <span class="side-menu__label"> {{ __('Inventory') }}</span><i class="angle fa fa-angle-right"></i>
      </a>
      <ul class="slide-menu">
        <li><a class="slide-item" href="{{ url('/medicine-purchase/index') }}">{{__('Medicine Purchase')}}</a></li>
        <!-- <li><a class="slide-item" href="{{ url('/account-ledger/index') }}">{{__('Account ledger ')}}</a></li> -->

        <!-- <li><a class="slide-item" href="#">{{__('Journel Entry')}}</a></li> -->
        <!-- <li><a class="slide-item" href="#">{{__('Attendence View-Biometric')}}</a></li> -->
        <!-- <li><a class="slide-item" href="#">{{__('Income/Expense')}}</a></li> -->
    </li>
    </ul>

    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon ti-settings"></i>
          <span class="side-menu__label"> {{ __('Settings') }}</span><i class="angle fa fa-angle-right"></i>
    </a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="#">{{__('Manage Admin Settings')}}</a></li>
      </li>
    </ul> --}}


    {{-- <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
          <i class="side-menu__icon ti ti-file"></i>
          <span class="side-menu__label"> {{ __('Reports') }}</span><i class="angle fa fa-angle-right"></i>
    </a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="#">{{__('Sales Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Purchase Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Stock Transfer Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Current Stock Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Payment Received Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Payment Made Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Receivable Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Payable Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Ledger Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Profit and Loss Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Trail Balance Report')}}</a></li>
      <li><a class="slide-item" href="#">{{__('Balance Sheet Report')}}</a></li>

      </li>
    </ul> --}}

    {{-- <li class="slide">
        <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">{{ __('Profile') }}</span><i class="angle fa fa-angle-right"></i></a>
    <ul class="slide-menu">
      <li><a class="slide-item" href="#">{{ __('Update Profile') }}</a></li>
      <li><a class="slide-item" href="#">{{ __('Change Password') }}</a></li>
      <li><a class="slide-item" href="{{route('logout')}}">{{ __('Logout') }}</a></li>

      </li>
    </ul> --}}
  </div>
</aside>