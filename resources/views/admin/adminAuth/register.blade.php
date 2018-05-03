@extends('admin.adminAuth.layouts.master')

@section('content')
<a href="{{ route('admin.login') }}" title="Login" style="position: absolute; z-index: 100; right: 5%; top: 50px;" class="btn btn-success btn-circle btn-xl fa fa-backward"></a>
</div>
<div class="container" >
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text">
            <h1 style="color: white"><strong>Welcome to Tash Restaurant</strong></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form-box">
            <div class="form-top">
                <h3 >Sign up</h3>

                <div class="form-bottom">
                    <form role="form" action="{{ route('admin.signin') }}" method="post" class="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="name" >{{ __('Name') }}</label>

                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">

                            @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="form-username">Email</label>
                            <input type="text" name="email"  class="form-username form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="form-username email" required autofocus placeholder="Email">

                            @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="form-password">Password</label>
                            <input type="password" class="form-password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required id="form-password password" placeholder="Password">

                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif

                        </div>
                        <div class="form-group ">
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>


                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                            
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn">Sign up!</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
    @endsection