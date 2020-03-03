<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('icofont/icofont.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200 text-gray-800 antialiased font-sans">

    <div id="app">

        <main class="w-screen h-screen overflow-hidden flex flex-col">

            <div class="absolute top-0 left-0 w-full h-12 bg-white shadow flex items-center justify-between px-6">
                <a href="/">
                    <h1 class="text-xl font-bold tracking-tight">
                        <span class="font-normal">
                            {{ config('app.branding', '') }}
                        </span>
                        {{ config('app.name', 'Comrade') }}
                    </h1>
                </a>

                <div class="h-full flex items-center">
                    <a href="{{ route('login') }}" class="h-full flex items-center m-0 px-3 border-b-2 focus:outline-none {{ Route::is('login') ? 'border-blue-500' : 'border-white hover:border-gray-500' }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="h-full flex items-center m-0 px-3 border-b-2 focus:outline-none {{ Route::is('register') ? 'border-blue-500' : 'border-white hover:border-gray-500' }}">Register</a>
                    @endif
                </div>
            </div>

            <div class="w-full h-full">
                @yield('content')
            </div>

        </main>

    </div>

</body>
</html>
