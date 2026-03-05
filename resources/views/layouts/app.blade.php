<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Datos Abiertos') - Municipio de Escobar</title>
    <meta name="description" content="Portal de datos abiertos del Municipio de Escobar. Transparencia e información pública al alcance de todos.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Scroll Progress -->
    <div id="scroll-progress" class="scroll-progress" style="width: 0%"></div>

    <!-- Top Bar -->
    <div class="gradient-blue-dark text-white py-2">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center text-xs sm:text-sm">
                <div class="flex items-center space-x-4 sm:space-x-6">
                    @if($institution && $institution->website)
                    <a href="{{ $institution->website }}" target="_blank" rel="noopener noreferrer" class="hover:text-blue-200 transition-colors flex items-center gap-1.5 opacity-90 hover:opacity-100">
                        <i class="fas fa-external-link-alt text-[10px]"></i>
                        <span class="hidden sm:inline">Municipio de Escobar</span>
                        <span class="sm:hidden">Municipio</span>
                    </a>
                    @endif
                    <a href="{{ route('government.contact') }}" class="hover:text-blue-200 transition-colors flex items-center gap-1.5 opacity-90 hover:opacity-100">
                        <i class="fas fa-envelope text-[10px]"></i>
                        <span>Contacto</span>
                    </a>
                </div>
                <div class="flex items-center space-x-1">
                    @if($institution && $institution->facebook_url)
                    <a href="{{ $institution->facebook_url }}" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded-full flex items-center justify-center hover:bg-white/15 transition-all" aria-label="Facebook">
                        <i class="fab fa-facebook-f text-xs"></i>
                    </a>
                    @endif
                    @if($institution && $institution->instagram_url)
                    <a href="{{ $institution->instagram_url }}" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded-full flex items-center justify-center hover:bg-white/15 transition-all" aria-label="Instagram">
                        <i class="fab fa-instagram text-xs"></i>
                    </a>
                    @endif
                    @if($institution && $institution->twitter_url)
                    <a href="{{ $institution->twitter_url }}" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded-full flex items-center justify-center hover:bg-white/15 transition-all" aria-label="Twitter/X">
                        <i class="fab fa-x-twitter text-xs"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Header & Nav -->
    <header id="main-header" class="bg-white/95 backdrop-blur-md sticky top-0 z-50 transition-shadow duration-300 border-b border-gray-100">
        <nav class="container mx-auto px-4 py-3 lg:py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3 group">
                    <div class="relative">
                        <div class="bg-gradient-to-br from-escobar-blue to-escobar-blue-light p-2.5 sm:p-3 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                            <i class="fas fa-database text-white text-lg sm:text-xl"></i>
                        </div>
                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-escobar-green rounded-full border-2 border-white"></div>
                    </div>
                    <div>
                        <div class="text-lg sm:text-xl lg:text-2xl font-extrabold font-heading text-escobar-blue group-hover:text-escobar-blue-light transition-colors leading-tight">
                            Datos Abiertos
                        </div>
                        <div class="text-[10px] sm:text-xs text-gray-500 font-semibold tracking-widest uppercase">
                            Municipio de Escobar
                        </div>
                    </div>
                </a>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden w-11 h-11 rounded-xl bg-gray-50 hover:bg-escobar-blue hover:text-white text-gray-700 flex items-center justify-center transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-escobar-blue/30" aria-label="Abrir menú">
                    <i class="fas fa-bars text-lg" id="menu-icon"></i>
                </button>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('datasets.index') }}" class="nav-link px-4 py-2 text-gray-700 hover:text-escobar-blue font-semibold text-[15px] rounded-lg hover:bg-blue-50/60 transition-all {{ request()->routeIs('datasets.*') ? 'text-escobar-blue active' : '' }}">
                        <i class="fas fa-database mr-1.5 text-sm"></i>Datasets
                    </a>
                    <a href="{{ route('glossary.index') }}" class="nav-link px-4 py-2 text-gray-700 hover:text-escobar-blue font-semibold text-[15px] rounded-lg hover:bg-blue-50/60 transition-all {{ request()->routeIs('glossary.*') ? 'text-escobar-blue active' : '' }}">
                        <i class="fas fa-book mr-1.5 text-sm"></i>Glosario
                    </a>
                    <div class="relative group">
                        <button class="nav-link px-4 py-2 text-gray-700 hover:text-escobar-blue font-semibold text-[15px] rounded-lg hover:bg-blue-50/60 transition-all flex items-center gap-1.5 {{ request()->routeIs('government.*') ? 'text-escobar-blue active' : '' }}">
                            <i class="fas fa-landmark mr-1 text-sm"></i>Gobierno
                            <i class="fas fa-chevron-down text-[10px] transition-transform duration-200 group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute top-full right-0 mt-1 w-60 bg-white rounded-2xl shadow-2xl border border-gray-100/80 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden">
                            <div class="p-2">
                                <a href="{{ route('government.authorities') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent hover:text-escobar-blue font-medium transition-all rounded-xl">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-landmark text-escobar-blue text-xs"></i>
                                    </div>
                                    Autoridades
                                </a>
                                <a href="{{ route('government.officials') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent hover:text-escobar-blue font-medium transition-all rounded-xl">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-id-card text-escobar-blue text-xs"></i>
                                    </div>
                                    Funcionarios
                                </a>
                                <a href="{{ route('government.organisms') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent hover:text-escobar-blue font-medium transition-all rounded-xl">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-sitemap text-escobar-blue text-xs"></i>
                                    </div>
                                    Organismos
                                </a>
                                <a href="{{ route('government.contact') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent hover:text-escobar-blue font-medium transition-all rounded-xl">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-address-book text-escobar-blue text-xs"></i>
                                    </div>
                                    Contacto de Áreas
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('information-request.create') }}" class="ml-2 gradient-blue text-white px-5 py-2.5 rounded-xl font-semibold hover:shadow-lg hover:shadow-escobar-blue/25 transition-all duration-300 hover:scale-[1.03] text-sm flex items-center gap-2">
                        <i class="fas fa-paper-plane text-xs"></i>
                        Solicitar Info
                    </a>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="mobile-menu lg:hidden mt-3">
                <div class="bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden shadow-inner">
                    <a href="{{ route('datasets.index') }}" class="flex items-center gap-3 px-5 py-3.5 text-gray-700 hover:bg-white hover:text-escobar-blue font-semibold transition-all {{ request()->routeIs('datasets.*') ? 'bg-white text-escobar-blue' : '' }}">
                        <div class="w-9 h-9 rounded-lg bg-white shadow-sm flex items-center justify-center">
                            <i class="fas fa-database text-escobar-blue text-sm"></i>
                        </div>
                        Datasets
                    </a>
                    <a href="{{ route('glossary.index') }}" class="flex items-center gap-3 px-5 py-3.5 text-gray-700 hover:bg-white hover:text-escobar-blue font-semibold transition-all {{ request()->routeIs('glossary.*') ? 'bg-white text-escobar-blue' : '' }}">
                        <div class="w-9 h-9 rounded-lg bg-white shadow-sm flex items-center justify-center">
                            <i class="fas fa-book text-escobar-blue text-sm"></i>
                        </div>
                        Glosario
                    </a>

                    <!-- Mobile Government Submenu -->
                    <div>
                        <button id="mobile-gov-toggle" class="w-full flex items-center justify-between gap-3 px-5 py-3.5 text-gray-700 hover:bg-white hover:text-escobar-blue font-semibold transition-all">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-white shadow-sm flex items-center justify-center">
                                    <i class="fas fa-landmark text-escobar-blue text-sm"></i>
                                </div>
                                Gobierno
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" id="gov-chevron"></i>
                        </button>
                        <div id="mobile-gov-submenu" class="hidden bg-white/60 mx-3 mb-2 rounded-xl overflow-hidden">
                            <a href="{{ route('government.authorities') }}" class="block px-5 py-3 text-sm text-gray-600 hover:text-escobar-blue hover:bg-blue-50 font-medium transition-all">
                                <i class="fas fa-landmark w-5 mr-2 text-escobar-blue/60"></i>Autoridades
                            </a>
                            <a href="{{ route('government.officials') }}" class="block px-5 py-3 text-sm text-gray-600 hover:text-escobar-blue hover:bg-blue-50 font-medium transition-all">
                                <i class="fas fa-id-card w-5 mr-2 text-escobar-blue/60"></i>Funcionarios
                            </a>
                            <a href="{{ route('government.organisms') }}" class="block px-5 py-3 text-sm text-gray-600 hover:text-escobar-blue hover:bg-blue-50 font-medium transition-all">
                                <i class="fas fa-sitemap w-5 mr-2 text-escobar-blue/60"></i>Organismos
                            </a>
                            <a href="{{ route('government.contact') }}" class="block px-5 py-3 text-sm text-gray-600 hover:text-escobar-blue hover:bg-blue-50 font-medium transition-all">
                                <i class="fas fa-address-book w-5 mr-2 text-escobar-blue/60"></i>Contacto de Áreas
                            </a>
                        </div>
                    </div>

                    <div class="p-3">
                        <a href="{{ route('information-request.create') }}" class="block gradient-blue text-white font-semibold text-center py-3.5 rounded-xl hover:shadow-lg transition-all text-sm">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Solicitar Información
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white mt-auto">
        <!-- Decorative top border -->
        <div class="h-1 bg-gradient-to-r from-escobar-green via-escobar-blue to-escobar-green"></div>

        <div class="container mx-auto px-4 py-12 lg:py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-12">
                <!-- Brand -->
                <div class="sm:col-span-2 lg:col-span-4">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="bg-gradient-to-br from-escobar-blue to-escobar-blue-light p-2.5 rounded-xl shadow-lg">
                            <i class="fas fa-database text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold font-heading">Datos Abiertos</h3>
                            <span class="text-gray-400 text-xs font-medium tracking-wider uppercase">Escobar</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6 max-w-sm">
                        Portal de datos abiertos del Municipio de Escobar.
                        Transparencia e información pública al alcance de todos los ciudadanos.
                    </p>
                    <div class="flex gap-2">
                        @if($institution && $institution->facebook_url)
                        <a href="{{ $institution->facebook_url }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-escobar-blue hover:scale-110 flex items-center justify-center transition-all duration-300 border border-white/10">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        @endif
                        @if($institution && $institution->instagram_url)
                        <a href="{{ $institution->instagram_url }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-500 hover:scale-110 flex items-center justify-center transition-all duration-300 border border-white/10">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        @endif
                        @if($institution && $institution->whatsapp_number)
                        <a href="{{ $institution->whatsapp_number }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-green-600 hover:scale-110 flex items-center justify-center transition-all duration-300 border border-white/10">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </a>
                        @endif
                        @if($institution && $institution->youtube_url)
                        <a href="{{ $institution->youtube_url }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-red-600 hover:scale-110 flex items-center justify-center transition-all duration-300 border border-white/10">
                            <i class="fab fa-youtube text-sm"></i>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Portal Links -->
                <div class="lg:col-span-2">
                    <h3 class="text-sm font-bold font-heading mb-5 text-white uppercase tracking-wider">Portal</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('datasets.index') }}" class="text-gray-400 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all group"><i class="fas fa-chevron-right text-[10px] text-escobar-blue group-hover:text-escobar-green transition-colors"></i>Datasets</a></li>
                        <li><a href="{{ route('glossary.index') }}" class="text-gray-400 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all group"><i class="fas fa-chevron-right text-[10px] text-escobar-blue group-hover:text-escobar-green transition-colors"></i>Glosario</a></li>
                        <li><a href="{{ route('information-request.create') }}" class="text-gray-400 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all group"><i class="fas fa-chevron-right text-[10px] text-escobar-blue group-hover:text-escobar-green transition-colors"></i>Solicitar información</a></li>
                        <li><a href="{{ url('/api/v1/datasets') }}" class="text-gray-400 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all group"><i class="fas fa-chevron-right text-[10px] text-escobar-blue group-hover:text-escobar-green transition-colors"></i>API</a></li>
                    </ul>
                </div>

                <!-- Government Links -->
                <div class="lg:col-span-3">
                    <h3 class="text-sm font-bold font-heading mb-5 text-white uppercase tracking-wider">Gobierno</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('government.authorities') }}" class="text-gray-400 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all group"><i class="fas fa-chevron-right text-[10px] text-escobar-blue group-hover:text-escobar-green transition-colors"></i>Autoridades</a></li>
                        <li><a href="{{ route('government.officials') }}" class="text-gray-400 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all group"><i class="fas fa-chevron-right text-[10px] text-escobar-blue group-hover:text-escobar-green transition-colors"></i>Funcionarios</a></li>
                        <li><a href="{{ route('government.organisms') }}" class="text-gray-400 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all group"><i class="fas fa-chevron-right text-[10px] text-escobar-blue group-hover:text-escobar-green transition-colors"></i>Organismos</a></li>
                        <li><a href="{{ route('government.contact') }}" class="text-gray-400 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all group"><i class="fas fa-chevron-right text-[10px] text-escobar-blue group-hover:text-escobar-green transition-colors"></i>Contacto de Áreas</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="lg:col-span-3">
                    <h3 class="text-sm font-bold font-heading mb-5 text-white uppercase tracking-wider">Contacto</h3>
                    <ul class="space-y-4 text-sm text-gray-400">
                        @if($institution && $institution->email)
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-escobar-green/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-envelope text-escobar-green text-xs"></i>
                            </div>
                            <a href="mailto:{{ $institution->email }}" class="hover:text-white transition-colors leading-relaxed">{{ $institution->email }}</a>
                        </li>
                        @endif
                        @if($institution && $institution->phone)
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-escobar-green/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-phone text-escobar-green text-xs"></i>
                            </div>
                            <span>{{ $institution->phone }}</span>
                        </li>
                        @endif
                        @if($institution && $institution->address)
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-escobar-green/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-map-marker-alt text-escobar-green text-xs"></i>
                            </div>
                            <span class="leading-relaxed">{!! nl2br(e($institution->address)) !!}</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} Municipio de Escobar. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button id="back-to-top" class="back-to-top w-12 h-12 rounded-xl gradient-blue text-white shadow-lg hover:shadow-xl hover:scale-110 flex items-center justify-center transition-all duration-300" aria-label="Volver arriba">
        <i class="fas fa-arrow-up text-sm"></i>
    </button>

    <!-- Toast Container -->
    <div id="toast-container" class="toast bg-white rounded-2xl shadow-2xl border border-gray-100 px-5 py-4 flex items-center gap-3 max-w-sm">
        <div id="toast-icon" class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
            <i class="fas fa-check text-green-600"></i>
        </div>
        <div>
            <p id="toast-message" class="text-sm font-semibold text-gray-800">Mensaje</p>
        </div>
    </div>

    @stack('scripts')

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileGovToggle = document.getElementById('mobile-gov-toggle');
        const mobileGovSubmenu = document.getElementById('mobile-gov-submenu');
        const menuIcon = document.getElementById('menu-icon');

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
                menuIcon.classList.toggle('fa-bars');
                menuIcon.classList.toggle('fa-xmark');
            });
        }

        if (mobileGovToggle) {
            mobileGovToggle.addEventListener('click', function() {
                mobileGovSubmenu.classList.toggle('hidden');
                const chevron = document.getElementById('gov-chevron');
                if (chevron) chevron.classList.toggle('rotate-180');
            });
        }

        // Scroll progress bar
        const scrollProgress = document.getElementById('scroll-progress');
        window.addEventListener('scroll', function() {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            if (docHeight > 0) {
                scrollProgress.style.width = (scrollTop / docHeight * 100) + '%';
            }
        });

        // Header shadow on scroll
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 10) {
                header.classList.add('shadow-lg');
                header.classList.remove('border-b', 'border-gray-100');
            } else {
                header.classList.remove('shadow-lg');
                header.classList.add('border-b', 'border-gray-100');
            }
        });

        // Back to top
        const backToTop = document.getElementById('back-to-top');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 500) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });
        if (backToTop) {
            backToTop.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Toast notification helper
        window.showToast = function(message, type = 'success') {
            const toast = document.getElementById('toast-container');
            const toastMessage = document.getElementById('toast-message');
            const toastIcon = document.getElementById('toast-icon');

            toastMessage.textContent = message;

            if (type === 'success') {
                toastIcon.innerHTML = '<i class="fas fa-check text-green-600"></i>';
                toastIcon.className = 'w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0';
            } else if (type === 'error') {
                toastIcon.innerHTML = '<i class="fas fa-times text-red-600"></i>';
                toastIcon.className = 'w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0';
            } else {
                toastIcon.innerHTML = '<i class="fas fa-info text-blue-600"></i>';
                toastIcon.className = 'w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0';
            }

            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);
        };
    </script>
</body>
</html>
