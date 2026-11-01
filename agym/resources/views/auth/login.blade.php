@extends('layouts.app')

@section('title', 'Login')

@section('guest-content')
<div class="auth-page">

    <div class="auth-card">
        <div class="auth-brand">
            <div class="brand-icon">A</div>
            <h1>A-GYM</h1>
            <p>GYM INVENTORY MANAGEMENT</p>
        </div>

        <h2>Welcome Back</h2>
        <p class="muted">Sign in to manage your gym inventory.</p>

        @if($errors->any())
            <div class="alert danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                       placeholder="Enter your password" required>
            </div>

            <label class="remember">
                <input type="checkbox" name="remember" value="1">
                Remember me
            </label>

            <button class="btn btn-primary btn-full">
                Sign In
            </button>
        </form>

        <p class="auth-footer">
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
        </p>
    </div>

</div>
@endsection