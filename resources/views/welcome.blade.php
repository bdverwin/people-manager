<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark text-light">

<div class="main container d-flex flex-column justify-content-start align-items-center min-vh-100 py-4">

    <header class="w-100 mb-4 d-flex justify-content-between align-items-center border-bottom border-secondary pb-3">
        <h1 class="h3 text-light">PEOPLE MANAGER</h1>

        @auth
            <div class="d-flex align-items-center gap-2">
                <span class="text-light">Hi, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-dark btn-sm">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </header>

    <div class="w-100 d-flex justify-content-center">
        @yield('content')
    </div>

    <footer class="mt-auto pt-3 text-center text-secondary w-100 border-top border-secondary">
        <small>Created by Benhur &copy; {{ date('Y') }}</small>
    </footer>

</div>

@stack('scripts')
</body>
</html>
