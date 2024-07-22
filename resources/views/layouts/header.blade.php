<div class="page-header">
    <a aria-label="Hide Sidebar" class="app-sidebar__toggle close-toggle" data-toggle="sidebar" href="#"></a><!-- sidebar-toggle-->
    
    <div>
        <h1 class="page-title"></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ isset($pageTitle) ? $pageTitle : 'Default Text' }}</li>
        </ol>
    </div>
    <div class="d-flex  ml-auto header-right-icons header-search-icon">
        <!-- <div class="dropdown d-sm-flex">
            <a href="#" class="nav-link icon" data-toggle="dropdown">
                <i class="fe fe-search"></i>
            </a>
            <div class="dropdown-menu header-search dropdown-menu-left">
                <div class="input-group w-100 p-2">
                    <input type="text" class="form-control " placeholder="Search....">
                    <div class="input-group-append ">
                        <button type="button" class="btn btn-primary ">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- SEARCH -->
        <div class="dropdown d-md-flex">
            <a class="nav-link icon full-screen-link nav-link-bg">
                <i class="fe fe-maximize fullscreen-button"></i>
            </a>
        </div>

        <!-- FULL-SCREEN -->
        <div class="dropdown profile-1">
            <a href="#" data-toggle="dropdown" class="nav-link pr-2 leading-none d-flex">
                <span>
                   
                    <img src="{{asset('assets/images/avatar.png')}}" alt="profile-user" class="avatar  profile-user brround cover-image">
            
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <div class="drop-heading">
                    <div class="text-center">
                        <h5 class="text-dark mb-0">admin_name</h5>
                        <small class="text-muted">email</small>
                    </div>
                </div>
                <div class="dropdown-divider m-0"></div>
                {{--<a class="dropdown-item" href="#">
                    <i class="dropdown-icon mdi mdi-account-outline"></i> Profile
                </a>--}}
                <a class="dropdown-item"  onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();" >
                    <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign Out
                </a>
                 <a class="dropdown-item"  onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();" >
                    <i class="dropdown-icon mdi  mdi-logout-variant"></i> Change Password
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
            </div>
        </div>
       
    </div>
</div>