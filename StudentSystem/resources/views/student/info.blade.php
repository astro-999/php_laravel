@extends('layouts.app')
@section('title', 'Academic Info — Student System')

@section('content')
<div style="max-width:700px; margin:0 auto;">
    <h1 style="font-size:24px; font-weight:700; margin-bottom:24px;">Academic Info</h1>

    @if($student)
        <div class="card" style="margin-bottom:20px;">
            <div class="card-body" style="text-align:center; padding:32px;">
                <div style="width:64px;height:64px;background:#eef2ff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:700;color:#4f46e5;margin:0 auto 12px;">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>
                <h2 style="font-size:20px; font-weight:700; margin-bottom:4px;">{{ $student->name }}</h2>
                <span class="badge badge-indigo">{{ $student->course ?? 'N/A' }}</span>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h4>Academic Details</h4></div>
            <div class="card-body" style="padding:0;">
                <table class="table" style="margin:0;">
                    <tr><td style="font-weight:500; width:140px; color:#6b7280;">Email</td><td>{{ $student->email }}</td></tr>
                    <tr><td style="font-weight:500; color:#6b7280;">Phone</td><td>{{ $student->phone }}</td></tr>
                    <tr><td style="font-weight:500; color:#6b7280;">Address</td><td>{{ $student->address }}</td></tr>
                    <tr><td style="font-weight:500; color:#6b7280;">Course</td><td>{{ $student->course ?? 'N/A' }}</td></tr>
                    <tr><td style="font-weight:500; color:#6b7280;">Semester</td><td>{{ $student->semester ? $student->semester . ' Semester' : 'N/A' }}</td></tr>
                    <tr><td style="font-weight:500; color:#6b7280;">Batch</td><td>{{ $student->batch ?? 'N/A' }}</td></tr>
                    <tr><td style="font-weight:500; color:#6b7280;">Year</td><td>{{ $student->year ? $student->year . ' Year' : 'N/A' }}</td></tr>
                </table>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body" style="text-align:center; padding:48px;">
                <div style="font-size:40px; margin-bottom:12px; opacity:0.4;">📋</div>
                <p style="color:#6b7280;">No academic record found linked to your account. Please contact the administrator.</p>
            </div>
        </div>
    @endif
</div>
@endsection
