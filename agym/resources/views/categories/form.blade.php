@extends('layouts.app')

@section('title', $category->exists ? 'Edit Category' : 'Add Category')

@section('content')

<div class="page-heading">
    <div>
        <h1>{{ $category->exists ? 'Edit Category' : 'Add Category' }}</h1>
        <p>Manage category information.</p>
    </div>
</div>

<div class="panel form-panel">
    <form method="POST"
          action="{{ $category->exists ? route('categories.update', $category) : route('categories.store') }}">

        @csrf

        @if($category->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label>Category Name *</label>
            <input type="text" name="name"
                   value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="form-actions">
            <a href="{{ route('categories.index') }}" class="btn btn-dark">Cancel</a>
            <button class="btn btn-primary">Save Category</button>
        </div>
    </form>
</div>

@endsection