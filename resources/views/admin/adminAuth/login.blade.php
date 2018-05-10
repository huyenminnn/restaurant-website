@extends('admin.adminAuth.layouts.master')

@section('content')
<a href="{{ route('admin.register') }}" title="Resgister" style="position: absolute; z-index: 100; right: 5%; top: 50px;" class="btn btn-success btn-circle btn-xl fa fa-link"></a>
<div class="container" >
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text" style="height: 80px">
            {{-- <h1 style="color: white"><strong>Welcome to Tash</strong></h1> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form-box">
            <div class="form-top">
                <h2 style=" color: black" class="text-center">Welcome to TASH</h2>
                {{-- <h1 style="color: blue"><strong>Welcome to Tash</strong></h1> --}}
                <div class="form-bottom">
                    <form role="form" action="{{ route('admin.login.process') }}" method="post" class="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="form-username">Username</label>
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
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn">Sign in!</button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <span class="col-sm-4 col-sm-offset-4 social-login">
                <h3>...or login with:
                    <span class="social-login-buttons">
                        <a class="btn btn-link-1 btn-link-1-facebook btn-lg fa fa-facebook" href="" >
                        </a>
                        <a class="btn btn-link-1 btn-link-1-twitter btn-lg fa fa-twitter" href="">
                        </a>
                        <a class="btn btn-link-1 btn-link-1-google-plus btn-lg fa fa-google-plus" href="{{ route('admin.login.google') }}" >
                        </a>
                    </span>
                </h3>
            </span>
        </div>
    </div>
</div>
@endsection