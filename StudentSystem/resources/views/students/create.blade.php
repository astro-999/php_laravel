@extends('layouts.app')
@section('title', 'Add Student — Admin')

@section('content')
<div style="max-width:700px; margin:0 auto;">
    <h1 style="font-size:24px; font-weight:700; margin-bottom:24px;">Add New Student</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.students.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter full name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="student@example.com">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="form-label">Phone *</label>
                        <input type="text" name="phone" class="form-input @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="98XXXXXXXX">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Course *</label>
                        <select name="course" class="form-input @error('course') is-invalid @enderror">
                            <option value="">Select Course</option>
                            @foreach(['BSc CSIT', 'Architecture', 'Civil', 'Computer'] as $c)
                                <option value="{{ $c }}" {{ old('course') == $c ? 'selected' : '' }}>{{ $c }}</option>
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
                                <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>{{ $i }}{{ $i==1?'st':($i==2?'nd':($i==3?'rd':'th')) }}</option>
                            @endfor
                        </select>
                        @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Batch *</label>
                        <input type="text" name="batch" class="form-input @error('batch') is-invalid @enderror" value="{{ old('batch') }}" placeholder="e.g. 2024">
                        @error('batch') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Year *</label>
                        <select name="year" class="form-input @error('year') is-invalid @enderror">
                            <option value="">Select</option>
                            @foreach(['1st','2nd','3rd','4th'] as $y)
                                <option value="{{ $y }}" {{ old('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                        @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Address *</label>
                    <textarea name="address" class="form-input @error('address') is-invalid @enderror" rows="3" placeholder="Enter address">{{ old('address') }}</textarea>
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-3" style="margin-top:8px;">
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">← Back</a>
                    <button type="submit" class="btn btn-primary">Save Student</button>
                </div>

                <p style="font-size:12px; color:#9ca3af; margin-top:16px;">A login account will be auto-created with password: <strong>student123</strong></p>
            </form>
        </div>
    </div>
</div>
@endsection
