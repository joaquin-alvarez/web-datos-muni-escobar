@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<!-- Hero Section -->
<section class="gradient-blue text-white">
    <div class="container mx-auto px-4 py-12 sm:py-16 lg:py-20">
        <div class="max-w-3xl animate-fade-in-up">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold font-heading mb-4 leading-tight">
                Portal de Datos Abiertos del Municipio de Escobar
            </h1>
            <p class="text-base sm:text-lg text-blue-100 mb-8 max-w-2xl leading-relaxed">
                Accedé a información pública, datasets y recursos del gobierno municipal.
                Transparencia e información al alcance de todos los ciudadanos.
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('datasets.index') }}" class="inline-flex items-center justify-center gap-2 bg-white text-escobar-blue px-6 py-3 rounded-lg font-semibold text-sm hover:bg-blue-50 transition-colors">
                    <i class="fas fa-database text-xs"></i>
                    Explorar Datasets
                </a>
                <a href="{{ route('information-request.create') }}" class="inline-flex items-center justify-center gap-2 border border-white/40 text-white px-6 py-3 rounded-lg font-semibold text-sm hover:bg-white/10 transition-colors">
                    <i class="fas fa-paper-plane text-xs"></i>
                    Solicitar Información
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<section class="bg-white border-b border-gray-200">
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-wrap justify-center sm:justify-start gap-8 sm:gap-12 lg:gap-16">
            <div class="text-center sm:text-left">
                <div class="text-2xl sm:text-3xl font-bold font-heading text-escobar-blue">{{ $totalDatasets }}</div>
                <div class="text-xs text-gray-500 font-medium uppercase tracking-wider mt-0.5">Datasets publicados</div>
            </div>
            <div class="text-center sm:text-left">
                <div class="text-2xl sm:text-3xl font-bold font-heading text-escobar-blue">{{ $totalCategories }}</div>
                <div class="text-xs text-gray-500 font-medium uppercase tracking-wider mt-0.5">Categorías temáticas</div>
            </div>
            <div class="text-center sm:text-left">
                <div class="text-2xl sm:text-3xl font-bold font-heading text-escobar-blue">{{ $totalFormats }}</div>
                <div class="text-xs text-gray-500 font-medium uppercase tracking-wider mt-0.5">Formatos disponibles</div>
            </div>
        </div>
    </div>
</section>

<!-- Categories & Recent Datasets -->
<div class="container mx-auto px-4 py-8 sm:py-10 lg:py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Categories Sidebar -->
        <aside class="lg:col-span-1">
            <h2 class="text-lg font-bold font-heading text-gray-800 mb-4">Categorías temáticas</h2>
            <nav class="space-y-1">
                @foreach($categories as $category)
                    <a href="{{ route('datasets.index', ['category' => $category->slug]) }}"
                       class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-blue-50 hover:text-escobar-blue transition-colors group">
                        <div class="flex items-center gap-2.5">
                            <i class="fas {{ $category->icon }} text-xs text-gray-400 group-hover:text-escobar-blue w-4 text-center transition-colors"></i>
                            <span class="font-medium">{{ $category->name }}</span>
                        </div>
                        <span class="text-xs text-gray-400 font-semibold">{{ $category->datasets_count }}</span>
                    </a>
                @endforeach
            </nav>
            <a href="{{ route('datasets.index') }}" class="inline-flex items-center gap-1.5 text-escobar-blue font-semibold text-sm mt-4 hover:underline">
                Ver todos los datasets
                <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </aside>

        <!-- Recent Datasets -->
        <div class="lg:col-span-3">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-bold font-heading text-gray-800">Últimas actualizaciones</h2>
                <a href="{{ route('datasets.index', ['sort' => 'modified']) }}" class="text-escobar-blue font-semibold text-sm hover:underline hidden sm:inline-flex items-center gap-1.5">
                    Ver todos <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-5">
                @foreach($recentDatasets as $dataset)
                    <a href="{{ route('datasets.show', $dataset->slug) }}"
                       class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-200 p-5 transition-all">
                        <h3 class="font-semibold font-heading text-gray-800 text-base group-hover:text-escobar-blue transition-colors line-clamp-2 leading-snug mb-2">
                            {{ $dataset->title }}
                        </h3>

                        <p class="text-gray-500 text-sm line-clamp-2 mb-4 leading-relaxed">
                            {{ $dataset->description }}
                        </p>

                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-600 px-2.5 py-1 rounded text-xs font-medium">
                                <i class="fas {{ $dataset->category->icon ?? 'fa-tag' }} text-[10px] text-gray-400"></i>
                                {{ $dataset->category->name }}
                            </span>
                            <div class="flex gap-1">
                                @foreach($dataset->formats->take(3) as $format)
                                    <span class="inline-block px-1.5 py-0.5 rounded text-white text-[10px] font-bold uppercase"
                                          style="background-color: {{ $format->color }}">
                                        {{ $format->extension }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-3 pt-3 border-t border-gray-100 flex items-center gap-1.5 text-xs text-gray-400">
                            <i class="fas fa-clock text-[10px]"></i>
                            <span>{{ $dataset->last_modified->diffForHumans() }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Information Request Notice -->
<section class="bg-gray-100 border-t border-gray-200">
    <div class="container mx-auto px-4 py-8 sm:py-10">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 max-w-4xl">
            <div>
                <h2 class="text-lg font-bold font-heading text-gray-800 mb-1">Acceso a la Información Pública</h2>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Todo ciudadano tiene derecho a solicitar información pública al Municipio, según la normativa vigente.
                </p>
            </div>
            <a href="{{ route('information-request.create') }}" class="gradient-blue text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:shadow-md transition-all flex-shrink-0 inline-flex items-center gap-2">
                <i class="fas fa-paper-plane text-xs"></i>
                Solicitar información
            </a>
        </div>
    </div>
</section>
@endsection
