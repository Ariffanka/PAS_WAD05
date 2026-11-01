@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')

<div class="page-heading">
    <div>
        <h1>Suppliers</h1>
        <p>Manage gym equipment suppliers.</p>
    </div>

    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
        + Add Supplier
    </a>
</div>

<div class="panel">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Products</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($suppliers as $supplier)
                    <tr>
                        <td><strong>{{ $supplier->name }}</strong></td>
                        <td>{{ $supplier->email ?: '-' }}</td>
                        <td>{{ $supplier->phone ?: '-' }}</td>
                        <td>{{ $supplier->products_count }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('suppliers.edit', $supplier) }}"
                                   class="btn btn-small btn-dark">Edit</a>

                                <form method="POST"
                                      action="{{ route('suppliers.destroy', $supplier) }}"
                                      onsubmit="return confirm('Delete this supplier?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-small btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">No suppliers found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">{{ $suppliers->links() }}</div>
</div>

@endsection