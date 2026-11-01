<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | A-Gym</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@if(auth()->check())
<div class="app-container">

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">A</div>
            <div>
                <h2>A-GYM</h2>
                <small>MANAGEMENT SYSTEM</small>
            </div>
        </div>

        <div class="sidebar-label">MENU</div>

        <nav class="navigation">
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span>▦</span> Dashboard
            </a>

            <a href="{{ route('products.index') }}"
               class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                <span>▤</span> Products
            </a>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('categories.index') }}"
                   class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <span>▧</span> Categories
                </a>

                <a href="{{ route('suppliers.index') }}"
                   class="{{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                    <span>▣</span> Suppliers
                </a>
            @endif

            <a href="{{ route('stock-movements.index') }}"
               class="{{ request()->routeIs('stock-movements.*') ? 'active' : '' }}">
                <span>⇄</span> Stock Movement
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="profile">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="profile-info">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>{{ ucfirst(auth()->user()->role) }}</small>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout-button" type="submit">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div>
                <div class="topbar-title">@yield('title', 'Dashboard')</div>
                <small>Gym Inventory Management System</small>
            </div>

            <div class="topbar-right">
                <span class="status-dot"></span>
                System Online
            </div>
        </header>

        <section class="page-content">

            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert danger">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert danger">
                    <strong>Please check the following errors:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </section>
    </main>

</div>
@else
    @yield('guest-content')
@endif

</body>
</html>