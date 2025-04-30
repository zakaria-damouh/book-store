@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Category</h2>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="mb-3">
            <label>Reference</label>
            <input type="text" name="ref" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="desc" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
