@extends('backend.app')
@section('body-class', 'hold-transition login-page')
@section('login')



<div class="login-box">
    <div class="login-logo">
      <a href="{{route('login')}}"><b>Dot</b>Blogs</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{route('login.save')}}" method="post">
            @csrf
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" @if(Cookie::has('adminuser'))
                      value="{{Cookie::get('adminuser')}}" @endif >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name='password' @if(Cookie::has('adminuser'))
                    value="{{Cookie::get('adminpwd')}}" @endif>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name='remember' @if((Cookie::has('adminuser')) && (Cookie::has('adminpwd'))) {{'Checked'}} @endif>
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="{{route('redirectgoogle')}}" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="{{route('register')}}" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
</div>

@endsection
