@extends('layouts.app')
@section('title', 'Edit Student — Admin')

@section('content')
<div style="max-width:700px; margin:0 auto;">
    <h1 style="font-size:24px; font-weight:700; margin-bottom:24px;">Edit Student</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name', $student->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="form-label">Phone *</label>
                        <input type="text" name="phone" class="form-input @error('phone') is-invalid @enderror" value="{{ old('phone', $student->phone) }}">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Course *</label>
                        <select name="course" class="form-input @error('course') is-invalid @enderror">
                            <option value="">Select Course</option>
                            @foreach(['BSc CSIT', 'Architecture', 'Civil', 'Computer'] as $c)
                                <option value="{{ $c }}" {{ old('course', $student->course) == $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                        @error('course') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row-3">
                    <div class="form-group">
                        <label class="form-label">Semester *</label>
                        <select name="semester" class="form-input @error('semester') is-invalid @enderror">
                            <option value="">Select</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('semester', $student->semester) == $i ? 'selected' : '' }}>{{ $i }}{{ $i==1?'st':($i==2?'nd':($i==3?'rd':'th')) }}</option>
                            @endfor
                        </select>
                        @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Batch *</label>
                        <input type="text" name="batch" class="form-input @error('batch') is-invalid @enderror" value="{{ old('batch', $student->batch) }}">
                        @error('batch') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Year *</label>
                        <select name="year" class="form-input @error('year') is-invalid @enderror">
                            <option value="">Select</option>
                            @foreach(['1st','2nd','3rd','4th'] as $y)
                                <option value="{{ $y }}" {{ old('year', $student->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                        @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Address *</label>
                    <textarea name="address" class="form-input @error('address') is-invalid @enderror" rows="3">{{ old('address', $student->address) }}</textarea>
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-3" style="margin-top:8px;">
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">← Back</a>
                    <button type="submit" class="btn btn-warning">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
