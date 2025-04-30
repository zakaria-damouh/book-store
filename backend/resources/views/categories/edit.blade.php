@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Category</h2>

    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Reference</label>
            <input type="text" name="ref" class="form-control" value="{{ $category->ref }}" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="desc" class="form-control" value="{{ $category->desc }}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
