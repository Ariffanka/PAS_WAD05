@extends('layouts.app')

@section('title', 'Categories')

@section('content')

<div class="page-heading">
    <div>
        <h1>Categories</h1>
        <p>Manage product categories.</p>
    </div>

    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        + Add Category
    </a>
</div>

<div class="panel">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Total Products</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>{{ $category->description ?: '-' }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="btn btn-small btn-dark">Edit</a>

                                <form method="POST"
                                      action="{{ route('categories.destroy', $category) }}"
                                      onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-small btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="empty">No categories found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">{{ $categories->links() }}</div>
</div>

@endsection