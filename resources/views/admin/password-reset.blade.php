@extends('layouts.auth')

@section('title', 'Admin - Reset Password')

@section('content')
    <h4>Reset Your Password</h4>
    <h6 class="font-weight-light">Enter your new password.</h6>

    @include('partials.message-bag')

    <form class="pt-3" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="text" name="token" value="{{ $token }}">
        <div class="form-group">
            <input type="email" name="email" value="{{ $email }}" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" id="Password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control form-control-lg" id="PasswordConfirmation" placeholder="Confirm Password" required>
        </div>
        <div class="mt-3 mb-2">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Reset Password</button>
        </div>
    </form>
@endsection
