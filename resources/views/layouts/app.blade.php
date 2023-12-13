<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @stack('style')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom Style -->
    @yield('importcss')
    @yield('importjs')

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ URL::asset('images/logo-utcc60th.png') }}" alt="" width="60" height="54" class="d-inline-block align-text-middle">
                    {{ __('MOU') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-nowrap {{ request()->routeIs('home') ? 'active' : '' }}"
                                    aria-current="page" href="{{ url('/home') }}">
                                    <i class="bi bi-house-door fs-5"></i>
                                    {{ __('Home') }}
                                </a>
                            </li>
                            @if (Auth::user()->role === 1)
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap {{ request()->routeIs('mous.*') ? 'active' : '' }}"
                                        href="{{ url('mous') }}">
                                        <i class="bi bi-clipboard-check fs-5"></i>
                                        {{ __('MOU') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap {{ request()->routeIs('departments.*') ? 'active' : '' }}"
                                        href="{{ url('departments') }}">
                                        <i class="bi bi-diagram-2 fs-5"></i>
                                        {{ __('Departments') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap {{ request()->routeIs('users.*') ? 'active' : '' }}"
                                        href="{{ url('users') }}">
                                        <i class="bi bi-people fs-5"></i>
                                        {{ __('Users') }}
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person fs-5"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">
                                        <i class="bi bi-person-badge fs-sm"></i>{{ __(' User Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right fs-sm"></i> {{ __(' Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            @yield('footer')
            @stack('scripts')
        </main>
    </div>
</body>

</html>
