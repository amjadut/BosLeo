
<!DOCTYPE html>
<html dir="ltr" lang="en-US" class="no-js" ng-app="App">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="robots" content="index, follow">
        <title>BosLeo | Dashboard</title>

        <!-- Meta Description -->
        <meta name="description" content="jfghdfjgh">

        <!-- For Mobile Meta -->
        <meta name="HandheldFriendly" content="true">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
       
        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/public/images/favicon/favicon-32x32.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/public/images/favicon/apple-icon-180x180.png')}}">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <link href="{{asset('/public/css/admin.css')}}" rel="stylesheet">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

        <link href="{{ asset('public/css/toast/jquery.toast.min.css')}}" rel="stylesheet">
        <script src="{{ asset('public/js/toast/jquery.toast.min.js')}}"></script>
        <style type="text/css">
            .no-data-added {
                color: red;
                padding: 1% 0% 0% 40%;
            }
        </style>
    </head>
    
    <body data-is-fixed="false">

        <div class="site-wrapper">
            @if(session()->has('message'))
            <script type="text/javascript">
                $.toast({
                    heading: 'success',
                    text: "{{{session()->get('message')}}}",
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 5000,
                    stack: 6
                });
            </script>
            @elseif($errors->all(':message'))
            <script type="text/javascript">
                var errorMessages = "{{{implode('', $errors->all(':message'))}}}";
                $.toast({
                    heading: 'Warning',
                    text: errorMessages,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 5000,
                    stack: 6
                });
            </script>
            @endif
            <form id="logoutFormSubmit" action="{{{Request::root()}}}/logout" method="POST" style="display: none;">
                <input type="hidden" name="_token" value="{{{csrf_token()}}}">
            </form>
            <div class="dashboard-content">
                <!-- User Header -->
                <!-- Dashboard Header -->
                <nav class="col navbar navbar-expand-lg bg-white shadow header">
                    <div class="collapse navbar-collapse [ d-flex justify-content-between ]" id="navbarNavDropdown">
                        <div class="col-sm-3 [ pl-0 ]">
                            <img class="company-logo" src="{{{Request::root()}}}/public/images/company_placeholder.png" alt="">
                        </div>
                        
                        <ul class="user-dropdown navbar-nav col-sm-4 col-lg-3 col-xl-4 [ pr-0 align-items-center  justify-content-end ]">
                            <li class="nav-item">
                                <span>
                                    <strong class="text-primary font-weight-semibold font-normal [ d-block text-capitalize text-right ]">{{{Auth::user()->first_name." ".Auth::user()->last_name}}}</strong>
                                        <!-- <small class="d-block text-muted text-capitalize">ADMIN &middot; VETERINARIAN</small> -->
                                </span>
                            </li>
                            <li class="nav-item dropdown [ ml-2 ]" >
                                <div class="nav-link dropdown-toggle [ pr-0 ] no-arrow" id="single-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="row no-gutters [ align-items-center ]">
                                        <div class="user-img col-auto">
                                            <img class="rounded-circle" src="{{{Request::root()}}}/public/images/ic_placeholder.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-menu user-option" aria-labelledby="single-button">
                                    <a class="dropdown-item logout-user" value="Logout" onclick="LogoutFunction()">
                                        <i class="dropdown-item--icon"></i>
                                        <span class="pl-3 align-middle text-red">
                                            Logout                            
                                        </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav><!-- Dashboard Header Ends -->

                <div>
                    <!-- Module Heading Bar -->
                    <div class="page-heading shadow [ d-flex flex-sm-wrap align-items-center  justify-content-start fix-width-heading ]">
                    	<h5 class="primary-text-dark col-sm-3 font-large [ mb-0 text-capitalize pl-0 ]  ">
                            Edit Profile 
                        </h5>
                    </div>    

                    <div>
                        <!-- Admin setting sidebar menu -->
                        <aside class="acuro-sidebar acuro-sidebar--large">
                            <div class="box">
                                <form class="login__form" method="POST" enctype="multipart/form-data" action="{{{Request::root()}}}/update-doctor-details">
                                    <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                                    <input type="hidden" name="doctor_id" value="{{{Auth::user()->id}}}">
                                    <div class="d-flex justify-content-center mb-5">
                                        <div class="user-profile-dp">
                                            <img alt="DP" id="profile_img" @if(Auth::user()->image) src="{{{Request::root()}}}/public/images/doctor_images/{{{Auth::user()->image}}}" @else src="{{{Request::root()}}}/public/images/ic_placeholder.png" @endif>
                                            <span role="button" class="user-profile-dp__edit">
                                                <img src="{{{Request::root()}}}/public/images/ic_edit.png" alt="Upload DP">
                                                <input type="file" id="profile_img_file_select" name="image" accept="image/jpg, image/jpeg, image/png" onchange="previewFile()">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <div class="input-section">
                                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="{{{Auth::user()->first_name}}}" required>
                                               <!--  <div class="form-error">
                                                    <span>First name is required.</span>
                                                </div>  --> 
                                                <label>First Name*</label>
                                            </div>                      
                                        </div>       
                                    </div>   
                                    <div class="row">
                                        <div class="form-group col">
                                            <div class="input-section">
                                                <input type="text" class="form-control" id="last_name" placeholder="Last name" name="last_name" value="{{{Auth::user()->last_name}}}" required>
                                                <!-- <div class="form-error" >
                                                    <span ng-message="required">Last name is required.</span>
                                                </div> -->   
                                                <label>Last Name*</label>
                                            </div>                      
                                        </div>       
                                    </div>   
                                    <div class="row">
                                        <div class="form-group col">
                                            <div class="input-section">
                                                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="{{{Auth::user()->email}}}" required>
                                                <!-- <div class="form-error" >
                                                    <span ng-message="required">Email is required.</span>
                                                </div> -->
                                                <label for="email">Email*</label>                                
                                            </div>                      
                                        </div>       
                                    </div>   
                                    <div class="row">
                                        <div class="form-group col">
                                            <div class="input-section">
                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone" name="phone" value="{{{Auth::user()->phone}}}" required>
                                                <!-- <div class="form-error" >
                                                    <span ng-message="required">Phone is required.</span>
                                                </div> -->
                                                <label for="phone">Phone*</label>            
                                            </div>                      
                                        </div>         
                                    </div>   
                                    <div class="row">
                                        <div class="form-group col">
                                            <div class="input-section">
                                                <input type="text" class="form-control" id="license_number" placeholder="Enter license number" name="license_number" value="{{{Auth::user()->license_number}}}" required>
                                                <label for="license_number">License Number*</label>
                                               <!--  <div class="form-error" >
                                                    <span>Licence number is already exist.</span>
                                                </div> -->
                                            </div>                      
                                        </div>         
                                    </div>
                                    <button class="btn btn-primary login-in__button">Update</button>
                                </form>
                            </div>
                        </aside>
                        <!-- Admin setting sidebar menu Ends-->
                        <!-- Main area -->
                        <div class="main-content">
                            <div class="box-wrapper">

                                <div class="box">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="box__heading [ mb-0 ]">Clinics and Timings</h4>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addClinicModal">Add Clinic</button>
                                    </div>
                                    @if(count($clinics)>0)
                                    <div id="accordion-parent">
                                    <?php $clinicCount = 0;?>
                                    @foreach($clinics as $clinic)
                                        <div id="accordion{{{$clinicCount}}}" role="tablist" data-accordion-theme="white" data-toggle-icon="arrow" data-accordion-style="border" class="card p-0 border mb-2">
                                            <div class="" role="tab" id="heading{{{$clinicCount}}}">
                                              <h5 class="mb-0">
                                                <a data-toggle="collapse" href="#" role="button"  aria-controls="collapse{{{$clinicCount}}}" data-toggle="collapse" data-target="#collapse{{{$clinicCount}}}">
                                                  <div class="accordion__heading height-auto">
                                                    <div class="py-2">
                                                        <h6 class="primary-text mb-2">{{{$clinic->clinic_name}}}</h6>
                                                        <span class="font-normal font-weight-normal text-muted d-inline-block position-relative pl-4 mr-4">
                                                            <i class="ic-phone"></i>  
                                                            {{{$clinic->clinic_phone}}}
                                                        </span>
                                                        <span class="font-normal font-weight-normal text-muted d-inline-block position-relative pl-4">
                                                            <i class="ic-email"></i>  
                                                            {{{$clinic->clinic_email}}}
                                                        </span>
                                                    </div>
                                                   <i class="toggle-icon">
                                                   </i>
                                                </div>
                                                </a>
                                              </h5>
                                            </div><!-- end accordion heading -->

                                            <div id="collapse{{{$clinicCount}}}" class="collapse divider-top" role="tabpanel" aria-labelledby="heading{{{$clinicCount}}}" data-parent="#accordion-parent">
                                              <div class="card-body p-0">
                                               <div>
                                                    <div class="box [ mb-0 pt-4 pb-0 ] position-relative z-index-0" >
                                                        <form class="login__form" method="POST" action="{{{Request::root()}}}/add-clinic-timing">
                                                        <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                                                        <input type="hidden" name="clinic_id" value="{{{$clinic->id}}}">
                                                        <div class="row [ mb-4 ]">
                                                            <div class="col-auto [ d-flex align-items-center ]">
                                                                <div class="btn-group checkbox-group" data-toggle="buttons">
                                                                    <label class="btn" >
                                                                        <input type="checkbox" autocomplete="off" name="timing_day_id[]" value="1"> Mon
                                                                    </label>
                                                                    <label class="btn">
                                                                        <input type="checkbox" autocomplete="off" name="timing_day_id[]" value="2"> Tue
                                                                    </label>
                                                                    <label class="btn" >
                                                                        <input type="checkbox"  autocomplete="off" name="timing_day_id[]" value="3"> Wed
                                                                    </label>
                                                                    <label class="btn" >
                                                                        <input type="checkbox" autocomplete="off" name="timing_day_id[]" value="4"> Thu
                                                                    </label>
                                                                    <label class="btn" >
                                                                        <input type="checkbox"  autocomplete="off" name="timing_day_id[]" value="5"> Fri
                                                                    </label>
                                                                    <label class="btn" >
                                                                        <input type="checkbox" autocomplete="off" name="timing_day_id[]" value="6"> Sat
                                                                    </label>
                                                                    <label class="btn">
                                                                        <input type="checkbox" autocomplete="off" name="timing_day_id[]" value="7"> Sun
                                                                    </label>
                                                                    <div class="form-error" >
                                                                        <span></span>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            <div class="col-auto [ pl-lg-0 pr-lg-0 pl-xl-3 pr-xl-3 ]">
                                                                <div class="time-group">
                                                                    <div class="time-group__item">
                                                                        <select class="custom-select w-100" id="from_time_{{{$clinicCount}}}" name="from_time" placeholder="Start" onfocus="clearEndTimings('to_time_{{{$clinicCount}}}')" required>
                                                                            <option value="" selected></option>
                                                                            @for($i=0; $i < 24; $i++)
                                                                                <option value="{{{$i}}}">{{{date('h:i A',strtotime($i.':00:00'))}}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <label for="from_time_{{{$clinicCount}}}">Start</label>
                                                                    </div>
                                                                    <span class="mx-3">
                                                                        To
                                                                    </span>
                                                                    <div class="time-group__item">
                                                                        <select class="custom-select w-100" id="to_time_{{{$clinicCount}}}" name="to_time" placeholder="End" onfocus="fetchEndTimings('from_time_{{{$clinicCount}}}','to_time_{{{$clinicCount}}}')" required>
                                                                            <option value="" selected></option>
                                                                        </select>
                                                                        <label for="to_time_{{{$clinicCount}}}">End</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-error form-error--full">
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto [ pr-0 d-flex align-items-center ]">
                                                                <button type="btn" class="btn btn-add"></button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                        <div class="appointment-list divider-top">
                                                            @if($availableDays)
                                                            @foreach($availableDays as $days)
                                                            <div class="appointment-list__item">
                                                                <div class="appointment-list__day">
                                                                    {{{$days->day_name}}}
                                                                </div>
                                                                <?php $dayName = $days->day_name;?>
                                                                @if($clinic->$dayName)
                                                                <?php $splitDetails = explode(',', $clinic->$dayName); ?>
                                                                @if(count($splitDetails)>0)
                                                                @foreach($splitDetails as $splitDetail)
                                                                <?php $timingData = explode(' - ', $splitDetail); ?>
                                                                @if(count($timingData)>0)
                                                                <div class="appointment-list__time">
                                                                    <div class="badge badge-pill bg-light d-flex align-items-center secondary-text-dark ng-scope" >
                                                                        <span class="font-small font-weight-bold ng-binding">
                                                                            {{{date('h:i A',strtotime($timingData[1]))}}}
                                                                        </span>
                                                                        <span class="font-small px-2 text-muted">
                                                                            To
                                                                        </span>
                                                                        <span class="font-small font-weight-bold ng-binding">
                                                                            {{{date('h:i A',strtotime($timingData[2]))}}}
                                                                        </span>
                                                                        <a href="{{{Request::root()}}}/delete-clinic-timings/{{{$timingData[0]}}}" class="ic-close ml-2">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                                @endif
                                                                @endif
                                                            </div> <!-- /.appointment-list__item   -->
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>  
                                                </div>
                                              </div>
                                            </div><!-- end accordion body-->
                                        </div><!-- end accordion -->
                                        <?php $clinicCount++;?>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>            

                                <div class="box">
                                    <div class="row">
                                        <h5 class="box__heading col-xl-12">About User</h5>
                                        <div class="col-sm-12">
                                            <form class="login__form" method="POST" action="{{{Request::root()}}}/update-doctor-bio">
                                                <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                                                <input type="hidden" name="doctor_id" value="{{{Auth::user()->id}}}">
                                                <div class="input-section">
                                                    <textarea class="form-control" id="doctor_bio" placeholder="Enter text here" name="doctor_bio" required>@if(Auth::user()->doctor_bio){{{Auth::user()->doctor_bio}}}@endif</textarea>
                                                </div>
                                                <div class="col-sm-4 [ mt-4 ]" style="float: right;">
                                                    <button class="btn btn-primary" style="float: right;">@if(Auth::user()->doctor_bio){{{'Update'}}}@else{{{'Add'}}}@endif Bio</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 

                                <div class="box p-0">
                                    <div class="box mb-0 box-bottom--shadow" >
                                        <form class="" method="POST" action="{{{Request::root()}}}/add-doctor-experience">
                                            <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                                            <div class="row">
                                                <h5 class="box__heading col-xl-12">User Experience</h5>
                                                <div class="form-group col-sm-4">
                                                    <div class="input-section">
                                                        <select class="custom-select w-100" id="role_id" name="role_id" required>
                                                            @if($availableRoles)
                                                            <option value="" selected>Select</option>
                                                            @foreach($availableRoles as $roles)
                                                            <option value="{{{$roles->id}}}">{{{$roles->user_roles}}}</option>
                                                            @endforeach
                                                            @else
                                                            <option value="">None</option>
                                                            @endif
                                                        </select>
                                                        <label for="role_id">Role</label>
                                                    </div>
                                                </div>
                                                <div class="form-group w-100p col-auto divider-date">
                                                    <div class="input-section">
                                                        <select class="custom-select w-100" id="start_year" name="start_year" onchange="clearToYear()" required>
                                                            <option value="" selected>YYYY</option>
                                                            @for($year=date('Y',strtotime('-75 years')); $year <= date('Y'); $year++)
                                                            <option value="{{{$year}}}">{{{$year}}}</option>
                                                            @endfor
                                                        </select>
                                                        <label for="start_year">From</label>
                                                    </div>
                                                </div>
                                                <div class="form-group w-100p col-auto">
                                                    <div class="input-section">
                                                        <select class="custom-select w-100" id="end_year" name="end_year" onfocus="fetchToYear()" required>
                                                            <option value="" selected>YYYY</option>
                                                        </select>
                                                        <label for="end_year">To</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col">
                                                    <div class="input-section">
                                                        <input type="text" id="clinic-hospital-companyname" name="organisation_name" placeholder="Type to add" class="form-control" required>
                                                        <label for="clinic-hospital-companyname">Clinic/Hospital/Company Name*</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-auto">
                                                    <button class="btn btn-add"></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="table-container radius-none bg-transparent" >
                                        <div class="box [ py-0 mb-0 ]">
                                            @if(count($experiences)>0)
                                            <table class="table data-table box-table [ mb-0 ]">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <a href="#" class="sorting">Role
                                                            </a>
                                                        </th>
                                                        <th>
                                                            <a href="#" class="sorting">
                                                                Duration
                                                            </a>
                                                        </th>
                                                        <th>
                                                            <a href="#" class="sorting">Clinic/Hospital/Company Name  
                                                            </a>
                                                        </th>
                                                        <th>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($experiences as $experience)
                                                    <tr>
                                                        <td>
                                                            {{{$experience->user_roles}}}
                                                        </td>
                                                        <td>
                                                            {{{$experience->duration}}}
                                                        </td>
                                                        <td>
                                                            {{{$experience->organisation_name}}}
                                                        </td>
                                                        <td class="text-center p-0">
                                                            <a href="{{{Request::root()}}}/delete-doctor-experience/{{{$experience->id}}}" class="ic-close btn-close  [ d-inline-block align-middle ml-1 ]">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                            <p class="no-data-added">No experience added.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div> 

                                <div class="row [ mt-4 ]">
                                    <div class="col-xl-12 [ text-right ]">
                                        <button type="button" class="btn btn-primary">
                                            Save                            
                                        </button>
                                    </div>
                                </div>   

                            </div> <!-- /.box-wrapper -->
                        </div><!-- Main area Ends -->
                    </div>
                </div>
            </div>
        </div>  
        <!-- Main Wrapper Ends -->



<!-- Modal -->
<div class="modal fade" id="addClinicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-large" role="document">
    <div class="modal-content">
     <!--  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <input type="hidden" id="clinic-add-token" name="_token" value="{{{csrf_token()}}}">
        <div class="box">
          <div class="row">
            <h5 class="box__heading col-xl-12">Clinic Details</h5>
            <div class="form-group col-sm-6 col-lg-6 col-xl-4">
              <div class="input-section">
                <input type="text" name="clinic_name" class="form-control" id="clinic_name" placeholder="Enter clinic name" value="" required>
                <label for="clinic_name">Clinic Name*</label>

                <!-- <div class="form-error">
                   <span>Company name is required.</span>
                </div>  -->
              </div>                      
            </div>
            <div class="form-group col-sm-6 col-lg-6 col-xl-4">
              <div class="input-section">
                <input type="text" name="clinic_email" class="form-control" id="clinic_email" placeholder="Enter clinic email" required>
                <label for="clinic_email">Clinic Email*</label>

                <!-- <div class="form-error">
                   <span>Company email is required.</span>
                </div>  -->
              </div>                       
            </div>
            <div class="form-group col-sm-6 col-lg-6 col-xl-4">
              <div class="input-section">
                <input type="text" name="clinic_phone" class="form-control" id="clinic_phone"  placeholder="Enter clinic phone" value="" required>
                <label for="clinic_phone">Clinic Phone*</label>
                <!-- <div class="form-error">
                   <span>Company phone is required.</span>
                </div>  -->
              </div>                      
            </div>
          </div>    
          <div class="row">
            <div class="form-group col">
              <div class="input-section">
                <textarea id="clinic_bio" class="form-control" placeholder="Enter about clinic" required></textarea>
                <label for="clinic_bio">About Clinic*</label> 
              </div>    
            </div>
          </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="SubmitClinicDetails()">Save</button>
      </div>
    </div>
  </div>
</div>


        <script type="text/javascript">
            $('document').ready(function () {
                var distance = $('.page-heading').offset().top,
                        $window = $(window);

                $window.scroll(function () {

                    if ($window.scrollTop() >= distance) {

                        $('body').attr("data-is-fixed", "true");

                    } else {

                        $('body').attr("data-is-fixed", "false");

                    }

                    $('.acuro-sidebar').css('top', 114 - $(this).scrollTop());

                });


                $('#js-notification-trigger').on("click", function () {
                    $('.user-notification-sidebar').toggleClass('active');
                });

            });

            function LogoutFunction() {
                $("#logoutFormSubmit").submit();
            }

            function previewFile() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#profile_img").attr('src', e.target.result);
                };
                var file = document.getElementById('profile_img_file_select').files[0];
                if (file) {
                    reader.readAsDataURL(file);
                }
                else {
                    $("#profile_img").attr('src','{{{Request::root()}}}/public/images/ic_placeholder.png');
                }
            }

            function clearToYear() {
                $("#end_year").empty();
            }

            function fetchToYear() {
                if (!$("#start_year").val()) {
                    $.toast({
                        heading: 'Warning',
                        text: 'Select Starting Year',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });
                }
                else {
                    $("#end_year").empty();
                    $("#end_year").append("<option value='' selected>YYYY</option>");
                    for (var i = $("#start_year").val(); i <= "{{{date('Y')}}}"; i++) {
                        $("#end_year").append("<option value='"+i+"'>"+i+"</option>");
                    }
                }
            }

            function clearEndTimings(div_id) {
                $("#"+div_id).empty();
            }

            function fetchEndTimings(start_div,end_div) {
                if (!$("#"+start_div).val()) {
                    $.toast({
                        heading: 'Warning',
                        text: 'Select Start Time',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });
                }
                else {
                    $("#"+end_div).empty();
                    $("#"+end_div).append("<option value='' selected></option>");
                    var startTime = parseInt($("#"+start_div).val());
                    var tempTime;
                    for (var i = (startTime+1); i <= 23; i++) {
                        tempTime = i;
                        if (tempTime>=12) {
                            if (tempTime>12) {
                                tempTime = tempTime-12;
                            }
                            tempTime = tempTime+':00 PM';
                        }
                        else {
                            tempTime = tempTime+':00 AM';
                        }
                        $("#"+end_div).append("<option value='"+i+"'>"+tempTime+"</option>");
                    }
                }
            }

            function SubmitClinicDetails() {
                var params = {clinic_name: $("#clinic_name").val(), clinic_email: $("#clinic_email").val(),clinic_phone: $("#clinic_phone").val(),clinic_bio: $("#clinic_bio").val(),_token: $("#clinic-add-token").val()};
                $.ajax({
                    type: 'POST',
                    url: "{{{url('add-clinic')}}}",
                    async: true,
                    data: params,
                    success: function (data) {
                        if (data.status == 1) {
                            $.toast({
                                heading: 'success',
                                text: data.message,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 5000,
                                stack: 6
                            });
                            location.reload();
                        } else {
                            $.toast({
                                heading: 'Warning',
                                text: data.message,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 5000,
                                stack: 6
                            });
                        }
                    },
                    error: function (data) {
                        $.toast({
                            heading: 'Warning',
                            text: 'Some error occurred. Please try again later',
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            stack: 6
                        });
                    }
                });
            }
            // $('.dropdown-toggle.dropdown());
        </script>

    </body>
   
</html>