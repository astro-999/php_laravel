@extends('layouts.app')
@section('title', 'Edit Profile — Admin')

@section('content')
<div style="max-width:600px; margin:0 auto;">
    <h1 style="font-size:24px; font-weight:700; margin-bottom:24px;">Edit Profile</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <hr style="border: 0; border-top: 1px solid #f3f4f6; margin: 24px 0;">

                <h3 style="font-size:14px; font-weight:600; margin-bottom:14px; color:#374151;">Update Password (Leave blank to keep current)</h3>

                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-input @error('password') is-invalid @enderror" placeholder="At least 6 characters">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Repeat new password">
                </div>

                <div class="d-flex gap-3" style="margin-top:8px;">
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">← Back to Dashboard</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
