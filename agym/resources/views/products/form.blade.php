@extends('layouts.app')

@section('title', $product->exists ? 'Edit Product' : 'Add Product')

@section('content')

<div class="page-heading">
    <div>
        <h1>{{ $product->exists ? 'Edit Product' : 'Add Product' }}</h1>
        <p>Enter product information below.</p>
    </div>
</div>

<div class="panel form-panel">

    <form method="POST"
          action="{{ $product->exists ? route('products.update', $product) : route('products.store') }}">

        @csrf

        @if($product->exists)
            @method('PUT')
        @endif

        <div class="form-grid">

            <div class="form-group">
                <label>Product Name *</label>
                <input type="text" name="name"
                       value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label>SKU *</label>
                <input type="text" name="sku"
                       value="{{ old('sku', $product->sku) }}" required>
            </div>

            <div class="form-group">
                <label>Category *</label>
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id', $product->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Supplier</label>
                <select name="supplier_id">
                    <option value="">No Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            @selected(old('supplier_id', $product->supplier_id) == $supplier->id)>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Price (IDR) *</label>
                <input type="number" name="price" min="0" step="0.01"
                       value="{{ old('price', $product->price ?? 0) }}" required>
            </div>

            <div class="form-group">
                <label>Initial Stock *</label>

                @if($product->exists)
                    <input type="number"
                        value="{{ $product->stock }}"
                        disabled>
                    <small class="muted">
                        Use Stock Movement to change inventory.
                    </small>
                @else
                    <input type="number"
                        name="stock"
                        min="0"
                        value="{{ old('stock', 0) }}"
                        required>
                @endif
            </div>

            <div class="form-group">
                <label>Minimum Stock *</label>
                <input type="number" name="minimum_stock" min="0"
                       value="{{ old('minimum_stock', $product->minimum_stock ?? 5) }}" required>
            </div>

            <div class="form-group full-width">
                <label>Description</label>
                <textarea name="description" rows="4">{{ old('description', $product->description) }}</textarea>
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('products.index') }}" class="btn btn-dark">
                Cancel
            </a>

            <button type="submit" class="btn btn-primary">
                Save Product
            </button>
        </div>

    </form>

</div>

@endsection