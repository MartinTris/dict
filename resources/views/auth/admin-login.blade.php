@extends('layouts.portal')
@section('content')
  <!-- Header -->
  <div class="header d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
    <img src="/images/dict.png" alt="DICT Logo">
    <h2 class="m-0">DICT Cavite Monitoring System - Admin Portal</h2>
    </div>
    <a class="m-0 text-white" href="{{ route('employee.login') }}">Employee Login</a>
  </div>

  <!-- Main Login Container -->
  <div class="login-container">
    <div class="card o-hidden shadow-lg w-100" style="max-width: 1000px;">
    <div class="card-body p-0">
      <div class="row">
      <div class="col-lg-5 d-none d-lg-block bg-image"></div>
      <div class="col-lg-7">
        <div class="p-5">
        <div class="text-center">
          <h1 class="h3 text-primary mb-4 font-weight-bold">Access Your Account</h1>
        </div>
        <form action="{{ route('login.action') }}" method="POST" class="user">
          @csrf
          @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
      @endif
          <div class="form-group">
          <input name="email" type="email"
            class="form-control form-control-user @error('email') is-invalid @enderror"
            placeholder="Enter Email Address...">
          @error('email')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
          </div>
          <div class="form-group password-container">
          <input name="password" type="password" id="password-field"
            class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password">
          <button type="button" class="password-toggle" onclick="togglePassword('password-field')">
            <i class="fas fa-eye" id="password-field-icon"></i>
          </button>
          @error('password')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
          </div>
          <div class="form-group">
          <div class="custom-control custom-checkbox small">
            <input name="remember" type="checkbox" class="custom-control-input" id="customCheck">
            <label class="custom-control-label" for="customCheck">Remember Me</label>
          </div>
          </div>
          <button type="submit" class="btn btn-primary btn-user btn-block">Click to Login</button>
        </form>
        <hr>
        <div class="text-center">
          <a class="small" href="{{ route('register') }}">Create an Account!</a>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
@endsection