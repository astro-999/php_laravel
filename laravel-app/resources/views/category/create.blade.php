@extends('layouts.app')

@section('title', 'Create Category')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Create Category</h1>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="Enter category name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Enter category description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="status" id="status" class="form-check-input" value="1"
                               {{ old('status') ? 'checked' : 'checked' }}>
                        <label for="status" class="form-check-label">Visible</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create Category</button>
            </form>
        </div>
    </div>

@endsection
