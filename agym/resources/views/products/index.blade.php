@extends('layouts.app')

@section('title', 'Products')

@section('content')

<div class="page-heading">
    <div>
        <h1>Products</h1>
        <p>Manage gym equipment and inventory.</p>
    </div>

    @if(auth()->user()->role === 'admin')
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Add Product
        </a>
    @endif
</div>

<div class="panel">

    <form method="GET" class="search-form">
        <input type="text" name="search"
               value="{{ request('search') }}"
               placeholder="Search product name or SKU...">

        <button class="btn btn-dark">Search</button>
    </form>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    @if(auth()->user()->role === 'admin')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->sku }}</td>
                        <td>
                            <strong>{{ $product->name }}</strong>
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td>
                            @if($product->stock <= $product->minimum_stock)
                                <span class="badge danger">
                                    {{ $product->stock }}
                                </span>
                            @else
                                <span class="badge success">
                                    {{ $product->stock }}
                                </span>
                            @endif
                        </td>

                        @if(auth()->user()->role === 'admin')
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="btn btn-small btn-dark">
                                        Edit
                                    </a>

                                    <form action="{{ route('products.destroy', $product) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-small btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            No products found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>

</div>

@endsection