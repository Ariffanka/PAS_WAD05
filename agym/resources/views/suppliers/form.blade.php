@extends('layouts.app')

@section('title', $supplier->exists ? 'Edit Supplier' : 'Add Supplier')

@section('content')

<div class="page-heading">
    <div>
        <h1>{{ $supplier->exists ? 'Edit Supplier' : 'Add Supplier' }}</h1>
        <p>Manage supplier information.</p>
    </div>
</div>

<div class="panel form-panel">
    <form method="POST"
          action="{{ $supplier->exists ? route('suppliers.update', $supplier) : route('suppliers.store') }}">

        @csrf

        @if($supplier->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label>Supplier Name *</label>
            <input type="text" name="name"
                   value="{{ old('name', $supplier->name) }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $supplier->email) }}">
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone"
                   value="{{ old('phone', $supplier->phone) }}">
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" rows="4">{{ old('address', $supplier->address) }}</textarea>
        </div>

        <div class="form-actions">
            <a href="{{ route('suppliers.index') }}" class="btn btn-dark">Cancel</a>
            <button class="btn btn-primary">Save Supplier</button>
        </div>
    </form>
</div>

@endsection