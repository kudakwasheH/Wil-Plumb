<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - WIL Plumbing</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(30, 41, 59, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            padding: 2.5rem;
            color: #f8fafc;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.45);
        }
        .login-card h2 {
            color: #fff;
            font-weight: 700;
        }

        /* ── Input Fields ── */
        .form-control-pb {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #f1f5f9;
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }
        .form-control-pb:focus {
            background: rgba(15, 23, 42, 0.9);
            border-color: #0ea5e9;
            color: #f1f5f9;
            box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25);
        }
        .form-control-pb::placeholder {
            color: #64748b;
        }

        /* ── Field Labels ── */
        .login-card .form-label {
            color: #cbd5e1 !important;
            font-weight: 500;
            font-size: 0.83rem;
            letter-spacing: 0.01em;
        }

        /* ── Subtitle / hint texts ── */
        .login-card .text-muted {
            color: #94a3b8 !important;
        }

        /* ── Remember Me Checkbox ── */
        .login-card .form-check-input {
            background-color: rgba(15, 23, 42, 0.7);
            border: 2px solid #0ea5e9;
            border-radius: 4px;
            width: 1.1em;
            height: 1.1em;
            cursor: pointer;
            transition: all 0.2s;
        }
        .login-card .form-check-input:checked {
            background-color: #0ea5e9;
            border-color: #0ea5e9;
        }
        .login-card .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(14, 165, 233, 0.35);
            outline: none;
        }
        .login-card .form-check-label {
            color: #cbd5e1 !important;
            font-size: 0.875rem;
            cursor: pointer;
            user-select: none;
        }

        /* ── Error Alert Box ── */
        .login-card .alert-danger {
            background-color: rgba(185, 28, 28, 0.35) !important;
            border: 1px solid rgba(248, 113, 113, 0.6) !important;
            color: #fca5a5 !important;
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }
        .login-card .alert-danger li {
            color: #fca5a5 !important;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <img src="{{ asset('logo.png') }}" alt="WIL Plumbing" height="60" class="bg-white p-1 rounded mb-3">
        <h2 class="h3 mb-1">WIL <span class="text-info">Plumbing</span></h2>
        <p class="text-muted small">Administration Portal</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mb-4" role="alert">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control form-control-pb" placeholder="admin@wilplumbing.com" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-pb" placeholder="••••••••" required>
        </div>

        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
        </div>

        <button type="submit" class="btn btn-pb-primary w-100 py-2 mt-2">Sign In</button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="text-info text-decoration-none small"><i class="bi bi-arrow-left me-1"></i> Back to Homepage</a>
    </div>
</div>

</body>
</html>
