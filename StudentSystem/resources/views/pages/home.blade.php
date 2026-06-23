@extends('layouts.app')
@section('title', 'Home — Student System')

@section('content')
<div style="text-align:center; padding: 60px 0 40px;">
    <div style="font-size:56px; margin-bottom:16px;">🎓</div>
    <h1 style="font-size:32px; font-weight:700; margin-bottom:12px;">Student Management System</h1>
    <p style="font-size:16px; color:#6b7280; max-width:500px; margin:0 auto 32px; line-height:1.6;">
        A simple platform to manage student records including courses, semesters, batches and academic details.
    </p>
    @guest
        <a href="{{ route('login') }}" class="btn btn-primary" style="padding:12px 32px; font-size:15px;">Login to Continue →</a>
    @else
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.students.index') }}" class="btn btn-primary" style="padding:12px 32px; font-size:15px;">Go to Admin Panel →</a>
        @else
            <a href="{{ route('student.profile') }}" class="btn btn-primary" style="padding:12px 32px; font-size:15px;">View My Profile →</a>
        @endif
    @endguest
</div>

<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:20px; margin-top:20px;">
    <div class="card">
        <div class="card-body" style="text-align:center; padding:32px;">
            <div style="font-size:32px; margin-bottom:12px;">📋</div>
            <h3 style="font-size:16px; font-weight:600; margin-bottom:8px;">Student Records</h3>
            <p style="font-size:13px; color:#6b7280; line-height:1.5;">Manage complete student information including personal and academic details.</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body" style="text-align:center; padding:32px;">
            <div style="font-size:32px; margin-bottom:12px;">📚</div>
            <h3 style="font-size:16px; font-weight:600; margin-bottom:8px;">Course Management</h3>
            <p style="font-size:13px; color:#6b7280; line-height:1.5;">Track courses like BSc CSIT, Architecture, Civil and Computer Engineering.</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body" style="text-align:center; padding:32px;">
            <div style="font-size:32px; margin-bottom:12px;">🔐</div>
            <h3 style="font-size:16px; font-weight:600; margin-bottom:8px;">Secure Access</h3>
            <p style="font-size:13px; color:#6b7280; line-height:1.5;">Role-based login for admins and students with separate dashboards.</p>
        </div>
    </div>
</div>
@endsection
