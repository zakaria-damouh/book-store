@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Categories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ref</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->ref }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->desc }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-info">Edit</a>
                    <form method="POST" action="{{ route('categories.destroy', $category) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
