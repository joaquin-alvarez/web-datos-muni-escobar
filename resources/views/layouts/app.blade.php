<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Datos Abiertos') - Municipio de Escobar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0d6efd',
                        secondary: '#198754',
                        escobar: {
                            blue: '#0052a3',
                            'blue-dark': '#003d7a',
                            'blue-light': '#1976d2',
                            green: '#00a651',
                            'green-dark': '#008040',
                            'green-light': '#4caf50',
                            dark: '#1a1a1a',
                            light: '#f8f9fa',
                            gray: '#6c757d'
                        }
                    },
                    fontFamily: {
                        'sans': ['Open Sans', 'system-ui', 'sans-serif'],
                        'heading': ['Montserrat', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
        }
        
        .gradient-blue {
            background: linear-gradient(135deg, #0052a3 0%, #1976d2 100%);
        }
        
        .gradient-overlay {
            background: linear-gradient(135deg, rgba(0, 82, 163, 0.95) 0%, rgba(25, 118, 210, 0.95) 100%);
        }
        
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }
        
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #0052a3;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-md">
        <div class="gradient-blue text-white py-2.5">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex space-x-6">
                        <a href="#" class="hover:text-blue-100 transition-colors flex items-center gap-1">
                            <i class="fas fa-building text-xs"></i>
                            Municipio
                        </a>
                        <a href="#" class="hover:text-blue-100 transition-colors flex items-center gap-1">
                            <i class="fas fa-envelope text-xs"></i>
                            Contacto
                        </a>
                    </div>
                    <div class="flex space-x-3">
                        <a href="#" class="hover:text-blue-100 transition-colors" aria-label="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="hover:text-blue-100 transition-colors" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="hover:text-blue-100 transition-colors" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="container mx-auto px-4 py-5">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center space-x-4 group">
                    <div class="flex items-center gap-3">
                        <div class="bg-gradient-to-br from-escobar-blue to-escobar-blue-light p-3 rounded-lg shadow-md">
                            <i class="fas fa-database text-white text-xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-heading text-escobar-blue group-hover:text-escobar-blue-light transition-colors">
                                Datos Abiertos
                            </div>
                            <div class="text-xs text-gray-600 font-medium tracking-wide uppercase">
                                Municipio de Escobar
                            </div>
                        </div>
                    </div>
                </a>
                
                <div class="flex items-center space-x-6">
                    <a href="{{ route('datasets.index') }}" class="nav-link text-gray-700 hover:text-escobar-blue font-semibold text-base pb-1">
                        Datasets
                    </a>
                    <a href="{{ route('glossary.index') }}" class="nav-link text-gray-700 hover:text-escobar-blue font-semibold text-base pb-1">
                        Glosario
                    </a>
                    <div class="relative group">
                        <button class="nav-link text-gray-700 hover:text-escobar-blue font-semibold text-base pb-1 flex items-center gap-1">
                            Gobierno
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="{{ route('government.authorities') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-escobar-blue font-medium transition-colors">
                                    <i class="fas fa-landmark w-5 mr-2"></i>Autoridades
                                </a>
                                <a href="{{ route('government.officials') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-escobar-blue font-medium transition-colors">
                                    <i class="fas fa-id-card w-5 mr-2"></i>Funcionarios
                                </a>
                                <a href="{{ route('government.organisms') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-escobar-blue font-medium transition-colors">
                                    <i class="fas fa-sitemap w-5 mr-2"></i>Organismos
                                </a>
                                <a href="{{ route('government.contact') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-escobar-blue font-medium transition-colors">
                                    <i class="fas fa-address-book w-5 mr-2"></i>Contacto de Áreas
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('information-request.create') }}" class="gradient-blue text-white px-6 py-2.5 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 hover:scale-105">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Solicitar Info
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-escobar-blue-dark text-white mt-20">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-white p-2 rounded-lg">
                            <i class="fas fa-database text-escobar-blue text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold font-heading">Datos Abiertos Escobar</h3>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed mb-4">
                        Portal de datos abiertos del Municipio de Escobar.
                        Transparencia e información pública al alcance de todos los ciudadanos.
                    </p>
                    <div class="flex gap-3 mt-6">
                        <a href="#" class="bg-white/10 hover:bg-white/20 w-10 h-10 rounded-full flex items-center justify-center transition-all">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="bg-white/10 hover:bg-white/20 w-10 h-10 rounded-full flex items-center justify-center transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-white/10 hover:bg-white/20 w-10 h-10 rounded-full flex items-center justify-center transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-white/10 hover:bg-white/20 w-10 h-10 rounded-full flex items-center justify-center transition-all">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold font-heading mb-4 text-white">Portal</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('datasets.index') }}" class="text-gray-300 hover:text-white hover:translate-x-1 inline-block transition-all"><i class="fas fa-angle-right mr-2"></i>Datasets</a></li>
                        <li><a href="{{ route('glossary.index') }}" class="text-gray-300 hover:text-white hover:translate-x-1 inline-block transition-all"><i class="fas fa-angle-right mr-2"></i>Glosario</a></li>
                        <li><a href="{{ route('information-request.create') }}" class="text-gray-300 hover:text-white hover:translate-x-1 inline-block transition-all"><i class="fas fa-angle-right mr-2"></i>Solicitar información</a></li>
                        <li><a href="{{ url('/api/datasets') }}" class="text-gray-300 hover:text-white hover:translate-x-1 inline-block transition-all"><i class="fas fa-angle-right mr-2"></i>API</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold font-heading mb-4 text-white">Gobierno</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('government.authorities') }}" class="text-gray-300 hover:text-white hover:translate-x-1 inline-block transition-all"><i class="fas fa-angle-right mr-2"></i>Autoridades</a></li>
                        <li><a href="{{ route('government.officials') }}" class="text-gray-300 hover:text-white hover:translate-x-1 inline-block transition-all"><i class="fas fa-angle-right mr-2"></i>Funcionarios</a></li>
                        <li><a href="{{ route('government.organisms') }}" class="text-gray-300 hover:text-white hover:translate-x-1 inline-block transition-all"><i class="fas fa-angle-right mr-2"></i>Organismos</a></li>
                        <li><a href="{{ route('government.contact') }}" class="text-gray-300 hover:text-white hover:translate-x-1 inline-block transition-all"><i class="fas fa-angle-right mr-2"></i>Contacto de Áreas</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold font-heading mb-4 text-white">Contacto</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-envelope mt-1 text-escobar-green"></i>
                            <span>datos@escobar.gob.ar</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-phone mt-1 text-escobar-green"></i>
                            <span>(0348) 444-1000</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-1 text-escobar-green"></i>
                            <span>Municipio de Escobar<br>Buenos Aires, Argentina</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 mt-10 pt-8 text-center">
                <p class="text-sm text-gray-400">
                    &copy; {{ date('Y') }} Municipio de Escobar. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
