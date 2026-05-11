@extends('layouts.app')

@section('title', 'Category Details')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Category Details</h1>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200">ID</th>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $category->description }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($category->status == 1)
                            <span class="badge bg-success">Visible</span>
                        @else
                            <span class="badge bg-danger">Hidden</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $category->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $category->updated_at->format('d M Y, h:i A') }}</td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Are you sure you want to delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

@endsection
