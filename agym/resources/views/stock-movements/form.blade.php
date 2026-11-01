@extends('layouts.app')

@section('title', 'Record Stock Movement')

@section('content')

<div class="page-heading">
    <div>
        <h1>Record Stock Movement</h1>
        <p>Record incoming or outgoing inventory.</p>
    </div>
</div>

<div class="panel form-panel">

    <form method="POST" action="{{ route('stock-movements.store') }}">
        @csrf

        <div class="form-group">
            <label>Product *</label>

            <select name="product_id" required>
                <option value="">Select Product</option>

                @foreach($products as $product)
                    <option value="{{ $product->id }}"
                        @selected(old('product_id') == $product->id)>
                        {{ $product->name }} (Stock: {{ $product->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Movement Type *</label>

            <select name="type" required>
                <option value="">Select Type</option>
                <option value="in" @selected(old('type') === 'in')>
                    Stock In
                </option>
                <option value="out" @selected(old('type') === 'out')>
                    Stock Out
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Quantity *</label>
            <input type="number" name="quantity"
                   min="1" value="{{ old('quantity') }}" required>
        </div>

        <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" rows="4">{{ old('notes') }}</textarea>
        </div>

        <div class="form-actions">
            <a href="{{ route('stock-movements.index') }}" class="btn btn-dark">
                Cancel
            </a>

            <button class="btn btn-primary">
                Save Movement
            </button>
        </div>

    </form>
</div>

@endsection