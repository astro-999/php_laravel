<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student System')</title>
    <meta name="description" content="Student Management System — Manage students, courses, batches and semesters">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0f0f23;
            --bg-card: rgba(255,255,255,0.04);
            --bg-card-hover: rgba(255,255,255,0.07);
            --border: rgba(255,255,255,0.08);
            --text-primary: #f1f5f9;
            --text-secondary: rgba(255,255,255,0.5);
            --accent: #6366f1;
            --accent-light: #818cf8;
            --accent-glow: rgba(99,102,241,0.3);
            --gradient: linear-gradient(135deg, #6366f1, #8b5cf6);
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            margin: 0;
            background-image:
                radial-gradient(ellipse at 20% 0%, rgba(99,102,241,0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 100%, rgba(139,92,246,0.06) 0%, transparent 50%);
        }

        /* === NAVBAR === */
        .main-nav {
            background: rgba(15,15,35,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 24px;
            position: sticky; top: 0; z-index: 1000;
        }
        .nav-inner {
            max-width: 1280px; margin: 0 auto;
            display: flex; align-items: center; justify-content: space-between;
            height: 68px;
        }
        .nav-brand {
            display: flex; align-items: center; gap: 12px;
            text-decoration: none; color: var(--text-primary);
            font-weight: 700; font-size: 18px;
        }
        .nav-brand-icon {
            width: 40px; height: 40px;
            background: var(--gradient);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 16px var(--accent-glow);
        }
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 14px; font-weight: 500;
            transition: all 0.25s ease;
            display: flex; align-items: center; gap: 8px;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--text-primary);
            background: rgba(99,102,241,0.1);
        }
        .nav-link.active { color: var(--accent-light); }
        .nav-user {
            display: flex; align-items: center; gap: 12px;
        }
        .nav-avatar {
            width: 36px; height: 36px;
            background: var(--gradient);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; color: #fff;
        }
        .nav-user-info { text-align: right; }
        .nav-user-name { font-size: 13px; font-weight: 600; color: var(--text-primary); }
        .nav-user-role { font-size: 11px; color: var(--text-secondary); }
        .btn-logout {
            background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2);
            color: #fca5a5; padding: 8px 14px; border-radius: 10px;
            font-size: 13px; font-weight: 500; cursor: pointer;
            transition: all 0.25s ease; font-family: 'Inter', sans-serif;
            display: flex; align-items: center; gap: 6px;
        }
        .btn-logout:hover {
            background: rgba(239,68,68,0.2);
            color: #f87171; transform: translateY(-1px);
        }

        /* === CONTENT === */
        .main-content {
            max-width: 1280px; margin: 0 auto;
            padding: 32px 24px 48px;
        }

        /* === ALERTS === */
        .alert-modern {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.2);
            border-radius: 14px; padding: 14px 20px;
            color: #86efac; font-size: 14px;
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 24px;
            animation: slideDown 0.4s ease-out;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* === CARDS === */
        .card-glass {
            background: var(--bg-card);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .card-glass:hover {
            border-color: rgba(99,102,241,0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        .card-header-glass {
            padding: 24px 28px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header-glass h4 {
            font-size: 18px; font-weight: 700; margin: 0;
            display: flex; align-items: center; gap: 10px;
        }
        .card-body-glass { padding: 28px; }

        /* === TABLES === */
        .table-modern { width: 100%; border-collapse: separate; border-spacing: 0; }
        .table-modern thead th {
            background: rgba(99,102,241,0.08);
            color: var(--accent-light);
            font-size: 12px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.8px;
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
        }
        .table-modern tbody td {
            padding: 14px 16px; font-size: 14px;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            color: var(--text-secondary);
            vertical-align: middle;
        }
        .table-modern tbody tr { transition: background 0.2s ease; }
        .table-modern tbody tr:hover { background: rgba(99,102,241,0.04); }
        .table-modern tbody tr:hover td { color: var(--text-primary); }

        /* === BUTTONS === */
        .btn-modern {
            padding: 8px 16px; border-radius: 10px;
            font-size: 13px; font-weight: 500; font-family: 'Inter', sans-serif;
            border: none; cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex; align-items: center; gap: 6px;
            text-decoration: none;
        }
        .btn-primary-g {
            background: var(--gradient); color: #fff;
            box-shadow: 0 4px 16px var(--accent-glow);
        }
        .btn-primary-g:hover { transform: translateY(-2px); box-shadow: 0 8px 24px var(--accent-glow); color:#fff; }
        .btn-view { background: rgba(6,182,212,0.1); color: #67e8f9; border: 1px solid rgba(6,182,212,0.2); }
        .btn-view:hover { background: rgba(6,182,212,0.2); color: #67e8f9; }
        .btn-edit { background: rgba(245,158,11,0.1); color: #fbbf24; border: 1px solid rgba(245,158,11,0.2); }
        .btn-edit:hover { background: rgba(245,158,11,0.2); color: #fbbf24; }
        .btn-delete { background: rgba(239,68,68,0.1); color: #fca5a5; border: 1px solid rgba(239,68,68,0.2); }
        .btn-delete:hover { background: rgba(239,68,68,0.2); color: #fca5a5; }
        .btn-secondary-g { background: var(--bg-card); color: var(--text-secondary); border: 1px solid var(--border); }
        .btn-secondary-g:hover { background: var(--bg-card-hover); color: var(--text-primary); }

        /* === FORMS === */
        .form-label-modern {
            font-size: 13px; font-weight: 500;
            color: rgba(255,255,255,0.6);
            margin-bottom: 8px; display: block;
        }
        .form-input-modern {
            width: 100%; padding: 12px 16px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 12px; color: #fff;
            font-family: 'Inter', sans-serif; font-size: 14px;
            transition: all 0.3s ease; outline: none;
        }
        .form-input-modern:focus {
            border-color: rgba(99,102,241,0.5);
            background: rgba(99,102,241,0.06);
            box-shadow: 0 0 0 4px rgba(99,102,241,0.1);
        }
        .form-input-modern.is-invalid { border-color: rgba(239,68,68,0.5); }
        .invalid-feedback { color: #f87171; font-size: 12px; margin-top: 6px; }
        select.form-input-modern { appearance: none; cursor: pointer; }
        select.form-input-modern option { background: #1e1e3a; color: #fff; }

        /* === BADGES === */
        .badge-modern {
            padding: 4px 10px; border-radius: 8px;
            font-size: 12px; font-weight: 500;
        }
        .badge-course { background: rgba(99,102,241,0.15); color: #a5b4fc; }
        .badge-semester { background: rgba(245,158,11,0.15); color: #fcd34d; }

        /* === PAGINATION === */
        .pagination { gap: 4px; }
        .page-link {
            background: var(--bg-card) !important;
            border: 1px solid var(--border) !important;
            color: var(--text-secondary) !important;
            border-radius: 10px !important;
            padding: 8px 14px !important; font-size: 13px;
            transition: all 0.2s ease;
        }
        .page-link:hover { background: rgba(99,102,241,0.1) !important; color: var(--accent-light) !important; }
        .page-item.active .page-link {
            background: var(--gradient) !important;
            border-color: transparent !important;
            color: #fff !important;
        }
        .page-item.disabled .page-link { opacity: 0.3; }

        /* === FOOTER === */
        .main-footer {
            text-align: center; padding: 24px;
            color: var(--text-secondary); font-size: 12px;
            border-top: 1px solid var(--border);
            margin-top: 48px;
        }

        /* === MOBILE === */
        .mobile-toggle { display: none; background: none; border: none; color: var(--text-primary); font-size: 24px; cursor: pointer; }
        @media (max-width: 768px) {
            .mobile-toggle { display: block; }
            .nav-links { display: none; position: absolute; top: 68px; left: 0; right: 0; background: rgba(15,15,35,0.95); backdrop-filter: blur(20px); flex-direction: column; padding: 16px; border-bottom: 1px solid var(--border); }
            .nav-links.show { display: flex; }
            .nav-user-info { display: none; }
            .card-body-glass { padding: 20px; }
            .table-modern { font-size: 12px; }
            .table-modern thead th, .table-modern tbody td { padding: 10px 8px; }
        }
    </style>
</head>
<body>
    <nav class="main-nav" id="mainNav">
        <div class="nav-inner">
            <a href="{{ route('students.index') }}" class="nav-brand">
                <div class="nav-brand-icon">🎓</div>
                Student System
            </a>

            <button class="mobile-toggle" onclick="document.querySelector('.nav-links').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>

            <div class="nav-links" id="navLinks">
                <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
                <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Students
                </a>
                <a href="{{ route('students.create') }}" class="nav-link {{ request()->routeIs('students.create') ? 'active' : '' }}">
                    <i class="bi bi-person-plus-fill"></i> Add Student
                </a>
            </div>

            <div class="nav-user">
                <div class="nav-user-info">
                    <div class="nav-user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="nav-user-role">Administrator</div>
                </div>
                <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                <form action="{{ route('logout') }}" method="POST" style="margin:0">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="main-content">
        @if(session('success'))
            <div class="alert-modern">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="main-footer">
        &copy; {{ date('Y') }} Student System — Built with Laravel
    </footer>
</body>
</html>
