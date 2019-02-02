
<!DOCTYPE html>
<html dir="ltr" lang="en-US" class="no-js" ng-app="App">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="robots" content="index, follow">
        <title>BosLeo | Login</title>

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
                        <!-- Content Part -->
            <div class="login-wrapper">
                <div class="container">
                    <div class="row login-row">

                        <div class="col-md-4 [ m-auto d-flex align-items-center sign-in radius ]">
                            <div class="login-section m-auto">
                                <h5 class="primary-text-dark font-large [ text-capitalize mb-4 ]">Sign In</h5>
                                <form class="login__form" method="POST" action="{{{Request::root()}}}/login">
                                    <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                                    <div class="form-group">
                                        <div class="input-section">
                                            <input type="text" class="form-control" placeholder="Enter email" name="email" id="email" value="{{{old('email')}}}" required>
                                            <label for="email">Email*</label>

                                            <!-- <div class="form-error">
                                                <span ng-message="required">Email is required.</span>
                                                <span ng-message="pattern">Email is invalid.</span>
                                            </div> --> <!-- /.form-error -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-section">
                                            <input type="password" class="form-control login-input" placeholder="Enter password"  id="password" name="password" required>
                                            <label for="password">Password*</label>

                                            <!-- <div class="form-error" >
                                                <span>Password is required.</span>
                                            </div> --> <!-- /.form-error -->

                                            <!-- <a href="" class="forgot-link text-primary text-uppercase font-weight-bold font-small">Forgot</a> -->
                                        </div> 
                                    </div>   
                                    <button class="btn btn-primary login-in__button">Log in</button>
                                </form> <!-- /.login__form -->

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="form-separator"></div>
                                    </div>
                                </div>

                                <div class="row login-footer">
                                    <div class="col-sm-12">
                                        <a href="{{{Request::root()}}}/register" class="btn btn-outline-primary btn-block login-in__button" id="tiral-button">Sign Up</a>
                                    </div>
                                    
                                </div> <!-- /.login-footer -->

                            </div> <!-- /.login-section -->
                        </div>
                    </div> <!-- /.login-row -->
                </div>
            </div> <!-- /.login-wrapper -->
            <!-- Content Part End -->
        </div>
        <!-- Main Wrapper Ends -->

    </body>
   
</html>