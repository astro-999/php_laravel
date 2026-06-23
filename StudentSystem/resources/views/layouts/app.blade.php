<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student System')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f8f9fa; color: #1a1a2e; min-height: 100vh; display: flex; flex-direction: column; }
        a { color: #4f46e5; text-decoration: none; }
        a:hover { color: #3730a3; }

        /* Navbar */
        .navbar { background: #fff; border-bottom: 1px solid #e5e7eb; padding: 0 24px; position: sticky; top: 0; z-index: 100; }
        .nav-inner { max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; height: 60px; }
        .nav-brand { font-weight: 700; font-size: 17px; color: #1a1a2e; display: flex; align-items: center; gap: 10px; }
        .nav-brand span { font-size: 22px; }
        .nav-links { display: flex; align-items: center; gap: 6px; }
        .nav-link { color: #6b7280; font-size: 14px; font-weight: 500; padding: 8px 14px; border-radius: 8px; transition: all 0.2s; }
        .nav-link:hover { color: #1a1a2e; background: #f3f4f6; }
        .nav-link.active { color: #4f46e5; background: #eef2ff; }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .nav-user { font-size: 13px; color: #6b7280; }
        .nav-user strong { color: #1a1a2e; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 500; font-family: 'Inter', sans-serif; border: 1px solid transparent; cursor: pointer; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background: #4f46e5; color: #fff; border-color: #4f46e5; }
        .btn-primary:hover { background: #4338ca; color: #fff; }
        .btn-secondary { background: #fff; color: #374151; border-color: #d1d5db; }
        .btn-secondary:hover { background: #f9fafb; border-color: #9ca3af; color: #374151; }
        .btn-danger { background: #fff; color: #dc2626; border-color: #fca5a5; }
        .btn-danger:hover { background: #fef2f2; }
        .btn-warning { background: #fff; color: #d97706; border-color: #fcd34d; }
        .btn-warning:hover { background: #fffbeb; }
        .btn-info { background: #fff; color: #0891b2; border-color: #a5f3fc; }
        .btn-info:hover { background: #ecfeff; }
        .btn-sm { padding: 6px 10px; font-size: 12px; }
        .btn-logout { background: none; color: #6b7280; border: 1px solid #e5e7eb; padding: 6px 12px; border-radius: 8px; font-size: 13px; cursor: pointer; font-family: 'Inter', sans-serif; }
        .btn-logout:hover { color: #dc2626; border-color: #fca5a5; background: #fef2f2; }

        /* Content */
        .main-content { max-width: 1100px; margin: 0 auto; padding: 32px 24px; flex: 1; width: 100%; }

        /* Cards */
        .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; }
        .card-header { padding: 20px 24px; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: space-between; }
        .card-header h4 { font-size: 16px; font-weight: 600; margin: 0; }
        .card-body { padding: 24px; }

        /* Tables */
        .table { width: 100%; border-collapse: collapse; }
        .table th { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; padding: 12px 14px; text-align: left; border-bottom: 1px solid #e5e7eb; background: #f9fafb; }
        .table td { padding: 12px 14px; font-size: 14px; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        .table tr:hover td { background: #f9fafb; }

        /* Forms */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px; }
        .form-input { width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; font-family: 'Inter', sans-serif; color: #1a1a2e; transition: border-color 0.2s; outline: none; background: #fff; }
        .form-input:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.1); }
        .form-input.is-invalid { border-color: #dc2626; }
        .invalid-feedback { color: #dc2626; font-size: 12px; margin-top: 4px; }
        select.form-input { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 32px; }

        /* Alerts */
        .alert { padding: 12px 16px; border-radius: 8px; font-size: 14px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }

        /* Badge */
        .badge { padding: 3px 10px; border-radius: 6px; font-size: 12px; font-weight: 500; }
        .badge-indigo { background: #eef2ff; color: #4f46e5; }
        .badge-amber { background: #fffbeb; color: #d97706; }

        /* Pagination */
        .pagination { display: flex; gap: 4px; list-style: none; justify-content: center; margin-top: 20px; }
        .page-link { padding: 8px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 13px; color: #6b7280; background: #fff; text-decoration: none; }
        .page-link:hover { background: #f3f4f6; color: #1a1a2e; }
        .page-item.active .page-link { background: #4f46e5; color: #fff; border-color: #4f46e5; }
        .page-item.disabled .page-link { opacity: 0.4; pointer-events: none; }

        /* Footer */
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #9ca3af; border-top: 1px solid #f3f4f6; margin-top: auto; }

        /* Utility */
        .text-muted { color: #9ca3af; }
        .d-flex { display: flex; }
        .gap-2 { gap: 8px; }
        .gap-3 { gap: 12px; }
        .mb-3 { margin-bottom: 12px; }
        .mb-4 { margin-bottom: 16px; }
        .mt-4 { margin-top: 16px; }
        .justify-between { justify-content: space-between; }
        .items-center { align-items: center; }
        .flex-wrap { flex-wrap: wrap; }
        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; }
        .col-full { grid-column: 1 / -1; }
        @media (max-width: 768px) {
            .row, .row-3 { grid-template-columns: 1fr; }
            .nav-links { display: none; }
            .table { font-size: 12px; }
            .table th, .table td { padding: 8px; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-brand">
                <span>🎓</span> Student System
            </a>

            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">Students</a>
                        <a href="{{ route('admin.fees.index') }}" class="nav-link {{ request()->routeIs('admin.fees.*') ? 'active' : '' }}">Fees</a>
                    @else
                        <a href="{{ route('student.info') }}" class="nav-link {{ request()->routeIs('student.info') ? 'active' : '' }}">Academic Info</a>
                        <a href="{{ route('student.fees') }}" class="nav-link {{ request()->routeIs('student.fees') ? 'active' : '' }}">My Fees</a>
                    @endif
                @endauth
            </div>

            <div class="nav-right">
                @auth
                    <span class="nav-user">
                        Hello, 
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.profile.edit') }}" style="font-weight:600; color:#4f46e5; text-decoration:none;">{{ Auth::user()->name }} (Admin)</a>
                        @else
                            <a href="{{ route('student.profile') }}" style="font-weight:600; color:#4f46e5; text-decoration:none;">{{ Auth::user()->name }}</a>
                        @endif
                    </span>
                    <form action="{{ route('logout') }}" method="POST" style="margin:0">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="footer">&copy; {{ date('Y') }} Student System</footer>
</body>
</html>
