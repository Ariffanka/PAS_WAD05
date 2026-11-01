@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="welcome-section">
    <div>
        <h1>Welcome, {{ auth()->user()->name }}</h1>
        <p>Here's what's happening with your gym inventory today.</p>
    </div>

    @if(auth()->user()->role === 'admin')
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Add Product
        </a>
    @endif
</div>

<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-icon red">▤</div>
        <span>Total Products</span>
        <h2>{{ number_format($totalProducts) }}</h2>
        <small>Registered products</small>
    </div>

    <div class="stat-card">
        <div class="stat-icon gray">▧</div>
        <span>Total Categories</span>
        <h2>{{ number_format($totalCategories) }}</h2>
        <small>Product categories</small>
    </div>

    <div class="stat-card">
        <div class="stat-icon gray">▣</div>
        <span>Total Suppliers</span>
        <h2>{{ number_format($totalSuppliers) }}</h2>
        <small>Registered suppliers</small>
    </div>

    <div class="stat-card">
        <div class="stat-icon red">⇄</div>
        <span>Total Stock</span>
        <h2>{{ number_format($totalStock) }}</h2>
        <small>Units available</small>
    </div>

</div>

<div class="content-grid">

    <div class="panel">
        <div class="panel-header">
            <h3>Low Stock Products</h3>
            <a href="{{ route('products.index') }}">View All</a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Stock</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($lowStockProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <span class="badge danger">
                                    {{ $product->stock }} Units
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty">
                                No low stock products.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h3>Recent Activities</h3>
            <a href="{{ route('stock-movements.index') }}">View All</a>
        </div>

        @forelse($recentMovements as $movement)
            <div class="activity-item">
                <div class="activity-icon">
                    {{ $movement->type === 'in' ? '↓' : '↑' }}
                </div>

                <div class="activity-info">
                    <strong>{{ $movement->product->name }}</strong>
                    <small>
                        {{ $movement->user->name }} ·
                        {{ $movement->created_at->format('d M Y H:i') }}
                    </small>
                </div>

                <span class="{{ $movement->type === 'in' ? 'text-success' : 'text-danger' }}">
                    {{ $movement->type === 'in' ? '+' : '-' }}{{ $movement->quantity }}
                </span>
            </div>
        @empty
            <p class="empty">No activities recorded.</p>
        @endforelse
    </div>

</div>

@endsection