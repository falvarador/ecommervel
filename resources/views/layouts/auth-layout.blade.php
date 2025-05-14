<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Ecommervel') }}</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <main class="container">
                <div class="columns is-centered">
                    <div class="column is-4-desktop">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </section>
    <x-footer />
</body>

</html>