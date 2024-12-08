@extends('layouts.auth')  

@section('title', 'Admin - Activate Account')

@section('content')
    <h4>Hello, {{ session('user_name') }}!</h4>
    <p>Please change your password to activate your account and access the admin panel.</p>

    <!-- Include the message bag to display validation errors or success messages -->
    @include('partials.message-bag')

    <form class="pt-3" method="POST" action="{{ route('admin.process.activate.account') }}">
        @csrf

        <!-- Old Password Field -->
        <div class="form-group">
            <input type="password" name="old_password" class="form-control form-control-lg" id="oldPassword" placeholder="Old Password" required>
        </div>

        <!-- New Password Field -->
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" id="newPassword" placeholder="New Password" required>
        </div>

        <!-- Confirm New Password Field -->
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control form-control-lg" id="confirmPassword" placeholder="Confirm New Password" required>
        </div>

        <div class="mt-3 mb-2">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Change Password</button>
        </div>

        <div class="mb-2">
            <a class="btn btn-block btn-warning auth-form-btn" href="{{ route('password.request') }}">Forgot password?</a>
        </div>

        <div class="mb-2">
            <a class="btn btn-block btn-secondary auth-form-btn" href="{{ route('home') }}">Go to Main Website</a>
        </div>


    </form>
@endsection
