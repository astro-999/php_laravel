@extends('layouts.app')
@section('title', 'About — Student System')

@section('content')
<div style="max-width:700px; margin:0 auto;">
    <h1 style="font-size:28px; font-weight:700; margin-bottom:8px;">About</h1>
    <p style="color:#6b7280; margin-bottom:32px;">Learn more about this student management system.</p>

    <div class="card" style="margin-bottom:20px;">
        <div class="card-body">
            <h3 style="font-size:16px; font-weight:600; margin-bottom:12px;">What is Student System?</h3>
            <p style="font-size:14px; color:#374151; line-height:1.7;">
                Student System is a web-based application built with Laravel to help educational institutions manage student records efficiently.
                It provides a clean interface for administrators to add, view, edit and delete student information, while allowing students to log in and view their own academic details.
            </p>
        </div>
    </div>

    <div class="card" style="margin-bottom:20px;">
        <div class="card-body">
            <h3 style="font-size:16px; font-weight:600; margin-bottom:12px;">Features</h3>
            <ul style="font-size:14px; color:#374151; line-height:2; padding-left:20px;">
                <li>Admin dashboard to manage all student records</li>
                <li>Student portal for self-service profile viewing</li>
                <li>Track semester, batch, course and year details</li>
                <li>Courses: BSc CSIT, Architecture, Civil, Computer</li>
                <li>Role-based authentication (Admin / Student)</li>
                <li>Clean and responsive user interface</li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3 style="font-size:16px; font-weight:600; margin-bottom:12px;">Technology</h3>
            <p style="font-size:14px; color:#374151; line-height:1.7;">
                Built with <strong>Laravel 12</strong>, <strong>PHP 8.2+</strong>, and <strong>MySQL</strong>. Styled with a custom minimalist CSS design.
            </p>
        </div>
    </div>
</div>
@endsection
