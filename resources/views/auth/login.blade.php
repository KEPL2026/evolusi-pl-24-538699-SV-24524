<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'Shortener') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Bootstrap & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js', 'resources/js/auth-darkmode.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <script src="{{ asset('js/auth-darkmode.js') }}"></script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="auth-page">
    <button class="dark-mode-toggle-auth" id="darkModeToggleAuth" onclick="toggleDarkModeAuth()">
        <i class="bi bi-brightness-high" id="darkModeIconAuth"></i>
    </button>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12" style="max-width: 450px;">
                <div class="text-center mb-4">
                    <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="text-white text-decoration-none">
                        <h2 class="fw-bold">🔗 URL Shortener</h2>
                    </a>
                </div>

                <div class="card-auth">
                    <h4 class="text-white mb-4 text-center">Login</h4>

                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="login" class="form-label">Username atau Email</label>
                            <input
                                type="text"
                                class="form-control form-control-dark"
                                id="login"
                                name="login"
                                placeholder="Username atau email Anda"
                                value="{{ old('login') }}"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                class="form-control form-control-dark"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                            >
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>

                        @if ($errors->has('form'))
                            <x-alert-error :message="$errors->first('form')" />
                        @endif

                        <button type="submit" class="btn btn-danger w-100 mb-4" style="padding: 12px;">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Login
                        </button>
                    </form>

                    <div class="text-center">
                        <span class="text-muted">Belum punya akun?</span>
                        <a href="{{ route('register') }}" class="text-decoration-none text-danger">
                            Daftar di sini
                        </a>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="text-decoration-none text-muted">
                            <i class="bi bi-arrow-left me-2"></i>
                            Kembali ke Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
