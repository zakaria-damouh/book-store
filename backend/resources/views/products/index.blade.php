@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Products</h2>

    <div class="mb-3">
        <form method="GET" action="{{ route('products.index') }}">
            <label>Filter by Category:</label>
            <select name="category" class="form-select d-inline w-auto">
                <option value="">All</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ ($categoryId == $cat->id) ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
        </form>
    </div>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ref</th>
                <th>Name</th>
                <th>Categories</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->ref }}</td>
                <td>{{ $product->name }}</td>
                <td>
                    @foreach($product->categories as $cat)
                        <span class="badge bg-info text-dark">{{ $cat->name }}</span>
                    @endforeach
                </td>
                <td>{{ $product->quantity }}</td>
                <td>${{ $product->price }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="60">
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-info">Edit</a>
                    <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
