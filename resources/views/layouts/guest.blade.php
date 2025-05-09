<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

        <!-- Tabler Core -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
        
        <!-- Tabler Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-fonts.min.css">
        
        <!-- Tabler Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
    </head>
    <body class="antialiased">
        <div class="min-h-screen d-flex flex-column justify-content-center align-items-center py-4 bg-light">
            <div>
                <a href="/">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="80" height="80">
                </a>
            </div>

            <div class="card w-100 mx-auto mt-4" style="max-width: 28rem;">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
        
        <!-- Tabler Core JS -->
        <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    </body>
</html>
