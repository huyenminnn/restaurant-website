<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{ asset('admins/login_assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/login_assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/login_assets/css/form-elements.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/login_assets/css/style.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{ asset('admins/login_assets/ico/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('admins/login_assets/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('admins/login_assets/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('admins/login_assets/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('admins/login_assets/ico/apple-touch-icon-57-precomposed.png') }}">
    <style>
    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 20px 16px;
        border-radius: 35px;
        font-size: 24px;
        line-height: 1.33;
        /*color: green;*/
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        padding: 6px 0px;
        border-radius: 15px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;
    }
    .btn-circle:hover{
        color: yellow;
        border: 1px solid yellow;
    }
</style>
</head>

<body style="background-image: url({{ url('admins/login_assets/img/backgrounds/1.jpg') }})" style="position: relative; " >
    
    @yield('content')
    
    <!-- Javascript -->
    <script src="{{ asset('admins/login_assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('admins/login_assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admins/login_assets/js/jquery.backstretch.min.js') }}"></script>
    <script src="{{ asset('admins/login_assets/js/scripts.js') }}"></script>

    <!--[if lt IE 10]>
        <script src="assets/js/placeholder.js"></script>
    <![endif]-->


</body>

</html>