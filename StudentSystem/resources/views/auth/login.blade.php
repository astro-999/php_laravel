@extends('layouts.app')
@section('title', 'Login — Student System')

@section('content')
<div style="max-width:400px; margin:40px auto;">
    <div style="text-align:center; margin-bottom:32px;">
        <div style="font-size:40px; margin-bottom:12px;">🎓</div>
        <h1 style="font-size:22px; font-weight:700; margin-bottom:4px;">Welcome back</h1>
        <p style="font-size:14px; color:#6b7280;">Sign in to your account</p>
    </div>

    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:10px 14px; margin-bottom:20px; font-size:13px; color:#dc2626;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Enter your password" required>
                </div>

                <div style="display:flex; align-items:center; gap:8px; margin-bottom:20px;">
                    <input type="checkbox" name="remember" id="remember" style="accent-color:#4f46e5;">
                    <label for="remember" style="font-size:13px; color:#6b7280; cursor:pointer;">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px;">Sign In</button>
            </form>
        </div>
    </div>

    <p style="text-align:center; margin-top:16px; font-size:12px; color:#9ca3af;">
        Admin: admin@student.system / password
    </p>
</div>
@endsection
