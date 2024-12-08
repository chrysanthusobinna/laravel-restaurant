@extends('layouts.auth')

@section('title', 'Admin - Forgot Password')

@section('content')
    <h4>Forgot Your Password?</h4>
    <h6 class="font-weight-light">Enter your email to request a password reset link.</h6>

    @include('partials.message-bag')

    <form class="pt-3" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control form-control-lg" id="Email" placeholder="Email" required>
        </div>
        <div class="mt-3 mb-2">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Send Password Reset Link</button>
        </div>
        <div class="mb-2">
            <a class="btn btn-block btn-secondary auth-form-btn" href="{{ route('home') }}">Go to Main Website</a>
        </div>
    </form>
@endsection
