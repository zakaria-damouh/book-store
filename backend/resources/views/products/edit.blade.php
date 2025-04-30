@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Reference</label>
            <input type="text" name="ref" class="form-control" value="{{ $product->ref }}" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" min="0" required>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" step="0.01" required>
        </div>
        <div class="mb-3">
            <label>Image</label>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="80"><br>
            @endif
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label>Categories</label>
            <select name="categories[]" class="form-control" multiple required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" 
                        {{ in_array($cat->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
