@extends('layouts.app')

@section('title', 'Home - My App')

@section('content')

    <div class="hero-section text-center">
        <h1 class="hero-title">Welcome to My App</h1>
        <p class="hero-subtitle">Manage your categories with ease. A simple and powerful CRUD application built with Laravel.</p>
        <a href="{{ route('category.index') }}" class="btn btn-primary btn-lg mt-3">
            Browse Categories
        </a>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card feature-card">
                <div class="card-body text-center">
                    <div class="feature-icon">📂</div>
                    <h5 class="card-title mt-3">Categories</h5>
                    <p class="card-text text-muted">Create, view, edit and delete categories effortlessly.</p>
                    <a href="{{ route('category.index') }}" class="btn btn-primary btn-sm">View All</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card">
                <div class="card-body text-center">
                    <div class="feature-icon">📝</div>
                    <h5 class="card-title mt-3">Easy Management</h5>
                    <p class="card-text text-muted">Intuitive forms with validation for quick data entry.</p>
                    <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">Add New</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card">
                <div class="card-body text-center">
                    <div class="feature-icon">⚡</div>
                    <h5 class="card-title mt-3">Fast & Simple</h5>
                    <p class="card-text text-muted">Built with Laravel for speed, security and reliability.</p>
                    <a href="/about" class="btn btn-primary btn-sm">Learn More</a>
                </div>
            </div>
        </div>
    </div>

@endsection