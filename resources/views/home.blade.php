@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden gradient-blue text-white">
    <!-- Decorative elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/4"></div>
        <div class="absolute top-1/2 left-1/2 w-[600px] h-[600px] bg-escobar-green/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="container mx-auto px-4 py-16 sm:py-20 lg:py-28 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <div class="animate-fade-in-up">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium mb-6 border border-white/20">
                    <div class="w-2 h-2 bg-escobar-green rounded-full animate-pulse"></div>
                    Portal de Datos Abiertos
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold font-heading mb-6 text-shadow-lg leading-tight">
                    Datos Abiertos del<br>
                    <span class="text-escobar-green">Municipio de Escobar</span>
                </h1>
                <p class="text-lg sm:text-xl text-blue-100 mb-10 max-w-2xl mx-auto leading-relaxed font-light">
                    Accedé a información pública, datasets y recursos del gobierno municipal.
                    Transparencia al alcance de todos.
                </p>
            </div>

            <div class="animate-fade-in-up delay-200 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('datasets.index') }}" class="inline-flex items-center justify-center gap-2.5 bg-white text-escobar-blue px-8 py-4 rounded-xl font-bold text-base hover:shadow-2xl hover:shadow-white/20 hover:scale-[1.03] transition-all duration-300">
                    <i class="fas fa-database"></i>
                    Explorar Datasets
                </a>
                <a href="{{ route('information-request.create') }}" class="inline-flex items-center justify-center gap-2.5 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-8 py-4 rounded-xl font-bold text-base hover:bg-white/20 hover:border-white/50 transition-all duration-300">
                    <i class="fas fa-paper-plane"></i>
                    Solicitar Información
                </a>
            </div>
        </div>
    </div>

    <!-- Wave separator -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 48L60 42.7C120 37 240 27 360 26.7C480 27 600 37 720 42.7C840 48 960 48 1080 42.7C1200 37 1320 27 1380 21.3L1440 16V80H1380C1320 80 1200 80 1080 80C960 80 840 80 720 80C600 80 480 80 360 80C240 80 120 80 60 80H0V48Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

<!-- Stats Section -->
<section class="container mx-auto px-4 -mt-4 relative z-10 mb-16">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 text-center hover-lift border border-gray-100 animate-fade-in-up delay-100">
            <div class="w-14 h-14 rounded-xl gradient-blue flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-database text-white text-xl"></i>
            </div>
            <div class="text-3xl sm:text-4xl font-extrabold font-heading text-escobar-blue mb-1">{{ $totalDatasets }}</div>
            <div class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Datasets</div>
        </div>
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 text-center hover-lift border border-gray-100 animate-fade-in-up delay-200">
            <div class="w-14 h-14 rounded-xl gradient-green flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-layer-group text-white text-xl"></i>
            </div>
            <div class="text-3xl sm:text-4xl font-extrabold font-heading text-escobar-green mb-1">{{ $totalCategories }}</div>
            <div class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Categorías</div>
        </div>
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 text-center hover-lift border border-gray-100 animate-fade-in-up delay-300">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-file-alt text-white text-xl"></i>
            </div>
            <div class="text-3xl sm:text-4xl font-extrabold font-heading text-amber-600 mb-1">{{ $totalFormats }}</div>
            <div class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Formatos</div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="container mx-auto px-4 mb-16 lg:mb-20">
    <div class="text-center mb-10">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-heading text-gray-800 mb-3">
            Explorá por categoría
        </h2>
        <p class="text-gray-500 text-base sm:text-lg max-w-2xl mx-auto">
            Los datos están organizados en distintas temáticas para facilitar tu búsqueda
        </p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5 max-w-5xl mx-auto stagger-children">
        @foreach($categories as $category)
            <a href="{{ route('datasets.index', ['category' => $category->slug]) }}"
               class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-5 sm:p-6 text-center hover-lift border border-gray-100 transition-all animate-fade-in-up">
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-blue-50 group-hover:bg-gradient-to-br group-hover:from-escobar-blue group-hover:to-escobar-blue-light flex items-center justify-center mx-auto mb-3 transition-all duration-300">
                    <i class="fas {{ $category->icon }} text-escobar-blue group-hover:text-white text-lg sm:text-xl transition-colors duration-300"></i>
                </div>
                <h3 class="font-bold text-gray-800 text-sm sm:text-base mb-1 group-hover:text-escobar-blue transition-colors">{{ $category->name }}</h3>
                <span class="text-xs text-gray-400 font-semibold">{{ $category->datasets_count }} datasets</span>
            </a>
        @endforeach
    </div>
</section>

<!-- Recent Datasets Section -->
<section class="bg-gradient-to-br from-gray-50 to-blue-50/30 py-14 lg:py-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
            <div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-heading text-gray-800 mb-2">
                    Datasets recientes
                </h2>
                <p class="text-gray-500 text-base">Últimas actualizaciones en el portal</p>
            </div>
            <a href="{{ route('datasets.index') }}" class="inline-flex items-center gap-2 text-escobar-blue font-bold hover:gap-3 transition-all text-sm">
                Ver todos
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 stagger-children">
            @foreach($recentDatasets as $dataset)
                <a href="{{ route('datasets.show', $dataset->slug) }}"
                   class="group bg-white rounded-2xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden hover-lift transition-all animate-fade-in-up">
                    <!-- Card Header with category color -->
                    <div class="h-2 gradient-blue"></div>
                    <div class="p-5 sm:p-6">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <h3 class="font-bold font-heading text-gray-800 text-base sm:text-lg group-hover:text-escobar-blue transition-colors line-clamp-2 leading-snug">
                                {{ $dataset->title }}
                            </h3>
                            <i class="fas fa-arrow-up-right-from-square text-gray-300 group-hover:text-escobar-blue transition-colors flex-shrink-0 mt-1"></i>
                        </div>

                        <p class="text-gray-500 text-sm line-clamp-2 mb-4 leading-relaxed">
                            {{ $dataset->description }}
                        </p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 bg-blue-50 text-escobar-blue px-2.5 py-1 rounded-lg text-xs font-semibold">
                                    <i class="fas {{ $dataset->category->icon ?? 'fa-tag' }} text-[10px]"></i>
                                    {{ $dataset->category->name }}
                                </span>
                            </div>
                            <div class="flex gap-1.5">
                                @foreach($dataset->formats->take(3) as $format)
                                    <span class="inline-block px-2 py-1 rounded-md text-white text-[10px] font-bold uppercase"
                                          style="background-color: {{ $format->color }}">
                                        {{ $format->extension }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center gap-1.5 text-xs text-gray-400">
                            <i class="fas fa-clock"></i>
                            <span>Actualizado {{ $dataset->last_modified->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="container mx-auto px-4 py-14 lg:py-20">
    <div class="gradient-blue rounded-3xl p-8 sm:p-12 lg:p-16 text-white text-center relative overflow-hidden">
        <!-- Decorative circles -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/4"></div>

        <div class="relative z-10">
            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-paper-plane text-2xl"></i>
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-heading mb-4">
                ¿No encontrás lo que buscás?
            </h2>
            <p class="text-blue-100 text-base sm:text-lg mb-8 max-w-xl mx-auto leading-relaxed">
                Podés solicitar información pública directamente al Municipio.
                Es tu derecho como ciudadano.
            </p>
            <a href="{{ route('information-request.create') }}" class="inline-flex items-center justify-center gap-2.5 bg-white text-escobar-blue px-8 py-4 rounded-xl font-bold text-base hover:shadow-2xl hover:shadow-white/20 hover:scale-[1.03] transition-all duration-300">
                <i class="fas fa-paper-plane"></i>
                Solicitar Información
            </a>
        </div>
    </div>
</section>
@endsection
