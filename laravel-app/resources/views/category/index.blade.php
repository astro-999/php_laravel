@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Categories</h1>
        <a href="{{ route('category.create') }}" class="btn btn-primary">+ Add Category</a>
    </div>

    @if($categories->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            @if($category->status == 1)
                                <span class="badge bg-success">Visible</span>
                            @else
                                <span class="badge bg-danger">Hidden</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('category.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">No categories found. Create one!</div>
    @endif

@endsection
