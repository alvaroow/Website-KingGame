<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KingGame - PS Rental')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&family=Onest:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2 { font-family: 'Montserrat', sans-serif; }
        h3, h4 { font-family: 'Space Grotesk', sans-serif; }
        p, span, li, td, input, textarea, select { font-family: 'Plus Jakarta Sans', sans-serif; }
        button, a.btn, .badge, label { font-family: 'Onest', sans-serif; }
    </style>

    @stack('styles')
</head>

<body class="bg-white text-gray-900 antialiased">

{{-- ================= NAVBAR LOGIC ================= --}}
@if(request()->is('dashboard*') || request()->is('admin*'))

    {{-- 🔥 DASHBOARD / ADMIN NAVBAR (MINIMAL) --}}
    <header class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- LOGO (FIX REDIRECT ROLE) --}}
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-extrabold text-blue-600">
                            KING<span class="text-gray-900">GAME</span>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold text-blue-600">
                            KING<span class="text-gray-900">GAME</span>
                        </a>
                    @endif
                @else
                    <a href="/" class="text-2xl font-extrabold text-blue-600">
                        KING<span class="text-gray-900">GAME</span>
                    </a>
                @endauth

                {{-- ONLY LOGOUT --}}
                <div class="flex items-center space-x-3">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-medium transition">
                                Keluar
                            </button>
                        </form>
                    @endauth
                </div>

            </div>
        </nav>
    </header>

@else

    {{-- 🌐 LANDING PAGE NAVBAR (FULL MENU) --}}
    <header x-data="{ open: false }" class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">

        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center h-16">

                {{-- LOGO --}}
                <a href="/" class="text-2xl font-extrabold text-blue-600">
                    KING<span class="text-gray-900">GAME</span>
                </a>

                {{-- MENU --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-600 hover:text-blue-600 text-sm font-medium">Beranda</a>
                    <a href="/#devices" class="text-gray-600 hover:text-blue-600 text-sm font-medium">Konsol</a>
                    <a href="/#games" class="text-gray-600 hover:text-blue-600 text-sm font-medium">Game</a>
                    <a href="/#testimonials" class="text-gray-600 hover:text-blue-600 text-sm font-medium">Testimoni</a>
                </div>

                {{-- AUTH --}}
                <div class="hidden md:flex items-center space-x-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 text-sm font-medium">
                            Dashboard
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-medium transition">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 text-sm font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full text-sm font-semibold shadow-md">
                            Daftar
                        </a>
                    @endauth
                </div>

            </div>

        </nav>
    </header>

@endif


{{-- ================= MAIN ================= --}}
<main>
    @yield('content')
</main>


{{-- ================= FOOTER ================= --}}
<footer class="bg-gray-900 text-white py-12 mt-10">
    <div class="container mx-auto px-4 text-center">
        <p class="text-gray-400">&copy; {{ date('Y') }} KingGame. Tempat Bermain PlayStation Terbaik.</p>
    </div>
</footer>


{{-- AOS --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true, offset: 100 });
</script>

@stack('scripts')

</body>
</html>