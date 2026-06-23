@extends('layouts.app')
@section('title', 'My Profile — Student System')

@section('content')
<div style="max-width:700px; margin:0 auto;">
    <h1 style="font-size:24px; font-weight:700; margin-bottom:24px;">My Profile</h1>

    {{-- Edit Profile Details --}}
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header"><h4>Personal Details</h4></div>
        <div class="card-body">
            <form action="{{ route('student.profile.update') }}" method="POST">
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
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>

    {{-- Change Password Form --}}
    <div class="card">
        <div class="card-header"><h4>Change Password</h4></div>
        <div class="card-body">
            @if($errors->any())
                <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:10px 14px; margin-bottom:20px; font-size:13px; color:#dc2626;">
                    {{ $errors->first() }}
                </div>
            @endif
            <form action="{{ route('student.password.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-input" placeholder="Enter current password" required>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-input" placeholder="Minimum 6 characters" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Repeat new password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 8px;">Update Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
