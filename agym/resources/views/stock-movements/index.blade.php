@extends('layouts.app')

@section('title', 'Stock Movement')

@section('content')

<div class="page-heading">
    <div>
        <h1>Stock Movement</h1>
        <p>Monitor inventory incoming and outgoing transactions.</p>
    </div>

    <a href="{{ route('stock-movements.create') }}" class="btn btn-primary">
        + Record Movement
    </a>
</div>

<div class="panel">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>User</th>
                    <th>Notes</th>
                </tr>
            </thead>

            <tbody>
                @forelse($movements as $movement)
                    <tr>
                        <td>{{ $movement->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $movement->product->name }}</td>
                        <td>
                            <span class="badge {{ $movement->type === 'in' ? 'success' : 'danger' }}">
                                {{ strtoupper($movement->type) }}
                            </span>
                        </td>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $movement->user->name }}</td>
                        <td>{{ $movement->notes ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">No stock movements recorded.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">{{ $movements->links() }}</div>
</div>

@endsection