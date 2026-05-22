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
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        h1, h2 { 
            font-family: 'Montserrat', sans-serif; 
        }
        h3, h4 { 
            font-family: 'Space Grotesk', sans-serif; 
        }
        p, span, li, td, input, textarea, select { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        button, a.btn, .badge, label { 
            font-family: 'Onest', sans-serif; 
        }
        
        /* Glow Pulse */
        @keyframes glowPulse {
            0%, 100% { box-shadow: 0 0 5px rgba(59, 130, 246, 0.5), 0 0 20px rgba(59, 130, 246, 0.2); }
            50% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.8), 0 0 40px rgba(59, 130, 246, 0.4); }
        }
        .animate-glow {
            animation: glowPulse 2s infinite;
        }
        
        /* Bounce In */
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-bounce-in {
            animation: bounceIn 0.6s ease-out;
        }
    
        /* Tilt Effect */
        .tilt-card {
            transition: transform 0.1s ease;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

       
    </style>
    @stack('styles')
</head>
<body class="bg-white text-gray-900 antialiased">
    <!-- Scroll Progress Bar -->
    <div id="scroll-progress"></div>


    <!-- Navbar -->
    <header x-data="{ open: false }" class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <a href="/" class="text-2xl font-extrabold text-blue-600">
                    KING<span class="text-gray-900">GAME</span>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-600 hover:text-blue-600 transition font-medium text-sm">Beranda</a>
                    <a href="/#devices" class="text-gray-600 hover:text-blue-600 transition font-medium text-sm">Konsol</a>
                    <a href="/#games" class="text-gray-600 hover:text-blue-600 transition font-medium text-sm">Game</a>
                    <a href="/#testimonials" class="text-gray-600 hover:text-blue-600 transition font-medium text-sm">Testimoni</a>
                </div>

                {{-- Desktop Auth Buttons --}}
                <div class="hidden md:flex items-center space-x-3">
                    {{-- Kosong karena hanya landing page --}}
                </div>

                {{-- Mobile Hamburger --}}
                <button @click="open = !open" class="md:hidden p-2 text-gray-600 hover:text-blue-600">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="open" x-transition class="md:hidden border-t border-gray-100 bg-white pb-4">
                <div class="px-2 pt-3 space-y-1">
                    <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg text-sm font-medium">Beranda</a>
                    <a href="/#devices" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg text-sm font-medium">Konsol</a>
                    <a href="/#games" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg text-sm font-medium">Game</a>
                    <a href="/#testimonials" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg text-sm font-medium">Testimoni</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">&copy; {{ date('Y') }} KingGame. All rights reserved.</p>
        </div>
    </footer>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
        });
        
        // Counter Animation
        function animateCounter(element) {
            const target = parseInt(element.dataset.target);
            let count = 0;
            const duration = 1500;
            const interval = duration / target;
            
            const timer = setInterval(() => {
                count++;
                element.innerText = count + '+';
                if (count >= target) {
                    element.innerText = target + '+';
                    clearInterval(timer);
                }
            }, interval);
        }
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('counter')) {
                        animateCounter(entry.target);
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        document.querySelectorAll('.counter').forEach(el => observer.observe(el));
    </script>

    </script>

    @stack('scripts')
</body>
</html>