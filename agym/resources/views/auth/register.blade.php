@extends('layouts.app')

@section('title', 'Register')

@section('guest-content')
<div class="auth-page">

    <div class="auth-card">
        <div class="auth-brand">
            <div class="brand-icon">A</div>
            <h1>A-GYM</h1>
            <p>CREATE YOUR ACCOUNT</p>
        </div>

        <h2>Create Account</h2>
        <p class="muted">Register as an A-Gym staff member.</p>

        @if($errors->any())
            <div class="alert danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name"
                       value="{{ old('name') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button class="btn btn-primary btn-full">
                Create Account
            </button>
        </form>

        <p class="auth-footer">
            Already have an account?
            <a href="{{ route('login') }}">Login</a>
        </p>
    </div>

</div>
@endsection