<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Flower Shop') }}</title>
    <style>
        :root {
            --bg: #fffaf7;
            --panel: #ffffff;
            --panel-alt: #fff0f2;
            --primary: #d6406e;
            --primary-dark: #8f1e3d;
            --accent: #f5b5c6;
            --text: #2d1a1a;
            --muted: #6d5a5a;
            --line: #f1d6db;
            --success: #2f8f61;
            --warning: #d47a22;
            --shadow: 0 12px 35px rgba(122, 64, 81, 0.12);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fffaf7 0%, #fff2f4 100%);
            color: var(--text);
        }
        a { color: inherit; text-decoration: none; }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 18px 0;
            border-bottom: 1px solid var(--line);
            margin-bottom: 24px;
        }
        .brand {
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: var(--primary-dark);
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .greeting {
            font-weight: 700;
            color: var(--primary-dark);
            margin-right: 16px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border-radius: 999px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary {
            background: white;
            color: var(--primary-dark);
            border: 1px solid var(--line);
        }
        .btn-ghost {
            background: transparent;
            color: var(--text);
        }
        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }
        .hero {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 40px;
            align-items: center;
            padding: 32px 0 12px;
        }
        .hero h1 {
            font-size: clamp(2.4rem, 5vw, 4rem);
            margin: 0 0 16px;
            line-height: 1.05;
        }
        .hero p {
            margin: 0 0 24px;
            color: var(--muted);
            font-size: 1.06rem;
            line-height: 1.7;
        }
        .hero-box {
            padding: 28px;
            background: linear-gradient(135deg, #ffffff, #fff0f2);
        }
        .eyebrow {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 999px;
            background: #ffe4eb;
            color: var(--primary-dark);
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-size: 0.7rem;
            margin-bottom: 16px;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .feature {
            padding: 22px;
        }
        .feature h3 { margin: 12px 0 10px; }
        .feature p { margin: 0; color: var(--muted); line-height: 1.65; }
        .icon {
            width: 54px; height: 54px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: var(--panel-alt);
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin: 26px 0 30px;
        }
        .stat {
            padding: 20px;
        }
        .stat-label {
            font-size: 0.79rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-top: 8px;
            color: var(--primary-dark);
        }
        .page-header {
            margin-bottom: 22px;
        }
        .page-header h1 {
            margin: 0 0 8px;
            font-size: 2rem;
        }
        .page-header p {
            margin: 0;
            color: var(--muted);
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }
        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }
        .field label {
            font-weight: 600;
            font-size: 0.92rem;
        }
        .field input,
        .field textarea,
        .field select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: white;
            font: inherit;
        }
        .field input:focus,
        .field textarea:focus,
        .field select:focus {
            outline: 2px solid rgba(214, 64, 110, 0.2);
            border-color: var(--primary);
        }
        .table-wrap {
            overflow: auto;
            background: white;
            border: 1px solid var(--line);
            border-radius: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }
        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #f5e1e6;
            vertical-align: top;
        }
        th {
            background: #fff3f6;
            color: var(--primary-dark);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-size: 0.75rem;
        }
        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            background: #fce7ef;
            color: var(--primary-dark);
        }
        .badge.pending { background: #fff4d8; color: #9a6100; }
        .badge.production { background: #e8f2ff; color: #315c9c; }
        .badge.delivered { background: #e9f8ef; color: #2b7d5a; }
        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 12px;
            background: #eafaf1;
            color: #215d42;
            border: 1px solid #cce9d5;
        }
        .error {
            color: #b12846;
            font-size: 0.8rem;
            margin-top: 4px;
        }
        .layout-grid {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 24px;
        }
        .sidebar {
            padding: 18px;
            min-height: 400px;
        }
        .sidebar a {
            display: block;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 8px;
            color: var(--muted);
            font-weight: 600;
        }
        .sidebar a.active,
        .sidebar a:hover {
            background: #fff0f4;
            color: var(--primary-dark);
        }
        .order-items {
            display: grid;
            gap: 12px;
        }
        @media (max-width: 900px) {
            .hero,
            .feature-grid,
            .stats,
            .layout-grid,
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="nav">
            <a href="{{ route('home') }}" class="brand">Bloom & Co.</a>

            <div class="nav-links">
                @auth
                    <div class="greeting">Welcome {{ ucfirst(Auth::user()->role ?? 'user') }}</div>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @endauth
            </div>
        </nav>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
