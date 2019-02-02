
<!DOCTYPE html>
<html dir="ltr" lang="en-US" class="no-js" ng-app="App">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="robots" content="index, follow">
        <title>BosLeo | Sign Up</title>

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
    </head>
    
    <body>

        <div class="site-wrapper">
        <div class="sign-in-wrapper mt-5">
            <form class="sign-in__form" name="" method="POST" action="{{{Request::root()}}}/register">
                <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                <div class="sign-in radius">
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
                            hideAfter: 10000,
                            stack: 6
                        });
                    </script>
                    @endif
                    <div class="row [ d-flex mb-5 ]">
                        <h1 class="sign-in__heading col-md-6 [ mb-0 ]">Sign Up</h1>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input-section">
                                <input type="text" class="form-control" placeholder="Enter first name"
                                       name="first_name" id="first_name" value="{{{old('first_name')}}}" 
                                       required>
                                <label for="first_name">First Name*</label>

                               <!--  <div class="form-error">
                                    <span>First name is required.</span>
                                </div> --> <!-- /.form-error -->
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-section">
                                <input type="text" class="form-control" placeholder="Enter last name"
                                       name="last_name" id="last_name" value="{{{old('last_name')}}}"
                                       required>
                                <label for="last_name">Last Name*</label>
                                <!-- <div class="form-error"">
                                    <span>Last name is required.</span>
                                </div> --> <!-- /.form-error -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input-section">
                                <input type="text" class="form-control" placeholder="Enter email"
                                       name="email" id="email" value="{{{old('email')}}}"
                                       required>
                                <label for="email">Email*</label>
                                <!-- <div class="form-error">
                                    <span>Email is required.</span>
                                    <span>Email is invalid.</span>
                                </div> --> <!-- /.form-error -->
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-section">
                                <input type="text" class="form-control" placeholder="Enter phone number"
                                       name="phone" id="phone" value="{{{old('phone')}}}" required>
                                <label for="phone">Phone*</label>
                                <!-- <div class="form-error">
                                    <span>Phone number is required.</span>
                                    <span>Phone number is invalid.</span>
                                </div> --> <!-- /.form-error -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input-section">
                                <input type="text" class="form-control" placeholder="Enter license number"
                                       name="license_number" id="license_number" value="{{{old('license_number')}}}"
                                       required>
                                <label for="license_number">License Number*</label>
                                <!-- <div class="form-error"">
                                    <span>Last name is required.</span>
                                </div> --> <!-- /.form-error -->
                            </div>
                        </div>

                        <div class="form-group col-md-6 [ mb-0 ]">
                            <div class="input-section">
                                <input type="password" class="form-control" placeholder="Enter password"
                                       name="password" id="password"
                                       required>
                                <label for="password">Password*</label>
                                <!-- <div class="form-error">
                                    <span>Password is required.</span>
                                </div> --> <!-- /.form-error -->
                            </div>
                        </div>

                        <div class="form-group col-md-6 [ mb-0 ]">
                            <div class="input-section">
                                <input type="password" class="form-control" placeholder="Confirm Password"
                                       name="password_confirmation" id="password_confirmation"
                                       required>
                                <label for="password_confirmation">Confirm Password*</label>
                                <!-- <div class="form-error">
                                    <span>Password is required.</span>
                                </div> --> <!-- /.form-error -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 [ mb-0 ]">
                            <label id="term-condition-label" class="custom-control custom-checkbox [ font-weight-bold ]"
                                   for="term-condition">
                                <input type="checkbox" class="custom-control-input" id="term-condition" name="terms" required>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description agreement-text [ pl-2 ]">I agree</span>
                            </label>
                            <!-- <div class="form-error [ pl-3 ]" >
                                <span>Accept terms and conditions.</span>
                            </div> --> <!-- /.form-error -->
                        </div>
                    </div>
                </div> <!-- /.sign-in -->
                <button class="btn btn-primary btn-large sign-in__btn [ mx-auto ]" id="sign-in__btn"> Sign Up </button>
            </form> <!-- /.sign-in__form -->
        </div> <!-- /.sign-in-wrapper -->

        </div>
        <!-- Main Wrapper Ends -->

    </body>
   
</html>