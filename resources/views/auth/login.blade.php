@extends('auth.master.app')
@section('title', 'Login | Pemila')

@section('content')
<form class="form-login" autocomplete="off" action="{{ route('auth.checkLogin') }}" method="POST">
    @csrf

    <img src="{{ asset('img/auth/logo.png') }}" class="mb-3" />

    <h3 class="mb-3">Login Page</h3>
    @if(Session::get('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('fail') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="span-close">&times;</span>
            </button>
        </div>
    @endif
    <div class="form-group">
      <input type="text" class="form-control @error('email_username_login') {{ 'is-invalid' }} @enderror" name="email_username_login" placeholder="Email or username..." value="{{ old('email_username_login') }}"/>
      <div class="invalid-feedback text-left" role="alert">
        @error('email_username_login') {{ $message }}@enderror
      </div>
    </div>

    <div class="form-group my-3">
      <input type="password" name="password_login" class="form-control @error('password_login') {{ 'is-invalid' }} @enderror" placeholder="Password..." value="{{ old('password_login') }}"/>
      <div class="invalid-feedback text-left" role="alert">
        @error('password_login') {{ $message }} @enderror
      </div>
    </div>

    <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">
      Login
    </button>
  </form>
@endsection