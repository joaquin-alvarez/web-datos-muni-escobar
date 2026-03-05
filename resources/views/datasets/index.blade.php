@extends('layouts.app')

@section('title', 'Datasets')

@section('content')
<!-- Page Header -->
<div class="gradient-blue text-white py-10 sm:py-14 lg:py-16 relative overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/3 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 bg-white/5 rounded-full translate-y-1/3 -translate-x-1/4"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="flex items-center gap-3 sm:gap-4 mb-4">
                <div class="bg-white/15 backdrop-blur-sm p-3 sm:p-4 rounded-xl border border-white/10">
                    <i class="fas fa-database text-2xl sm:text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-heading text-shadow-lg">Datasets</h1>
                    <p class="text-sm sm:text-base lg:text-lg text-blue-100 font-light mt-1">Accedé a los datos abiertos del Municipio de Escobar</p>
                </div>
            </div>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('datasets.index') }}" class="mt-6 sm:mt-8">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Buscar datasets por título o descripción..."
                           class="w-full bg-white/10 backdrop-blur-sm border-2 border-white/20 rounded-2xl pl-12 pr-4 py-4 text-white placeholder-blue-200 text-sm sm:text-base focus:outline-none focus:bg-white/15 focus:border-white/40 transition-all">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-blue-200"></i>
                    @if(request('search'))
                        <a href="{{ route('datasets.index', request()->except('search')) }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-200 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 40" fill="none" class="w-full"><path d="M0 40V20C240 0 480 0 720 10C960 20 1200 30 1440 20V40H0Z" fill="#f9fafb"/></svg>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8">
    <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
        <!-- Sidebar -->
        <aside class="lg:w-72 flex-shrink-0">
            <div class="bg-white rounded-2xl shadow-lg p-5 sm:p-6 lg:sticky lg:top-20 border border-gray-100 lg:max-h-[calc(100vh-6rem)] lg:overflow-y-auto">
                <h2 class="text-sm font-bold font-heading mb-4 text-gray-500 uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-filter text-escobar-blue text-xs"></i>
                    Filtrar por tema
                </h2>

                <div class="space-y-1">
                    <a href="{{ route('datasets.index', request()->except('category')) }}"
                       class="flex items-center justify-between px-4 py-3 rounded-xl transition-all font-medium text-sm group {{ !request('category') ? 'gradient-blue text-white shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:text-escobar-blue' }}">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg {{ !request('category') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-100' }} flex items-center justify-center transition-colors">
                                <i class="fas fa-th-large text-xs {{ !request('category') ? 'text-white' : 'text-gray-500 group-hover:text-escobar-blue' }}"></i>
                            </div>
                            <span>Todos</span>
                        </div>
                        <span class="text-xs font-bold {{ !request('category') ? 'bg-white/20 px-2 py-0.5 rounded-full' : 'text-gray-400' }}">{{ $totalCount }}</span>
                    </a>

                    @foreach($categories as $category)
                        <a href="{{ route('datasets.index', array_merge(request()->except('category'), ['category' => $category->slug])) }}"
                           class="flex items-center justify-between px-4 py-3 rounded-xl transition-all font-medium text-sm group {{ request('category') == $category->slug ? 'gradient-blue text-white shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:text-escobar-blue' }}">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg {{ request('category') == $category->slug ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-100' }} flex items-center justify-center transition-colors">
                                    <i class="fas {{ $category->icon }} text-xs {{ request('category') == $category->slug ? 'text-white' : 'text-gray-500 group-hover:text-escobar-blue' }}"></i>
                                </div>
                                <span>{{ $category->name }}</span>
                            </div>
                            <span class="text-xs font-bold {{ request('category') == $category->slug ? 'bg-white/20 px-2 py-0.5 rounded-full' : 'text-gray-400' }}">{{ $category->datasets_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 min-w-0">
            <!-- Toolbar -->
            <div class="bg-white rounded-2xl shadow-md p-4 sm:p-5 mb-5 border border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div class="flex items-center gap-3">
                        <span class="font-extrabold font-heading text-2xl sm:text-3xl text-escobar-blue">{{ $datasets->total() }}</span>
                        <span class="text-sm text-gray-500">datasets encontrados</span>
                    </div>

                    <div class="flex items-center gap-2.5 w-full sm:w-auto">
                        <label class="text-xs text-gray-400 font-semibold uppercase tracking-wide whitespace-nowrap">Ordenar:</label>
                        <select onchange="window.location.href=this.value"
                                class="flex-1 sm:flex-none bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-escobar-blue/20 focus:border-escobar-blue transition-all appearance-none cursor-pointer">
                            <option value="{{ route('datasets.index', array_merge(request()->except('sort'), ['sort' => 'modified'])) }}"
                                    {{ $sort == 'modified' ? 'selected' : '' }}>
                                Última modificación
                            </option>
                            <option value="{{ route('datasets.index', array_merge(request()->except('sort'), ['sort' => 'az'])) }}"
                                    {{ $sort == 'az' ? 'selected' : '' }}>
                                A-Z
                            </option>
                            <option value="{{ route('datasets.index', array_merge(request()->except('sort'), ['sort' => 'za'])) }}"
                                    {{ $sort == 'za' ? 'selected' : '' }}>
                                Z-A
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Dataset Cards -->
            <div class="space-y-4 stagger-children">
                @forelse($datasets as $dataset)
                    <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-5 sm:p-6 border border-gray-100 hover-glow transition-all animate-fade-in-up">
                        <div class="flex flex-col lg:flex-row justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('datasets.show', $dataset->slug) }}"
                                   class="text-lg sm:text-xl font-bold font-heading text-gray-800 hover:text-escobar-blue transition-colors inline-flex items-start gap-2 group/link">
                                    <span class="leading-snug">{{ $dataset->title }}</span>
                                    <i class="fas fa-arrow-up-right-from-square text-xs text-gray-300 group-hover/link:text-escobar-blue mt-1.5 flex-shrink-0 transition-colors"></i>
                                </a>

                                <p class="text-sm text-gray-500 mt-2.5 line-clamp-2 leading-relaxed">
                                    {{ $dataset->description }}
                                </p>

                                <div class="flex flex-wrap items-center gap-2 mt-4 text-xs text-gray-500">
                                    <span class="inline-flex items-center gap-1.5 bg-blue-50 text-escobar-blue px-3 py-1.5 rounded-lg font-semibold">
                                        <i class="fas fa-building text-[10px]"></i>
                                        {{ $dataset->organization }}
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 bg-green-50 text-escobar-green px-3 py-1.5 rounded-lg font-semibold">
                                        <i class="fas fa-tag text-[10px]"></i>
                                        {{ $dataset->category->name }}
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 text-gray-400">
                                        <i class="fas fa-clock text-[10px]"></i>
                                        {{ $dataset->last_modified->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-wrap lg:flex-col items-start gap-2 lg:items-end">
                                @foreach($dataset->formats as $format)
                                    <span class="inline-block px-3 py-1.5 rounded-lg text-white text-xs font-bold uppercase shadow-sm hover:shadow-md hover:scale-105 transition-all cursor-default"
                                          style="background-color: {{ $format->color }}">
                                        {{ $format->extension }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl shadow-md p-10 sm:p-16 text-center border border-gray-100">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-5">
                            <i class="fas fa-search text-3xl sm:text-4xl text-gray-300"></i>
                        </div>
                        <p class="text-gray-700 text-lg font-bold font-heading mb-2">No se encontraron datasets</p>
                        <p class="text-gray-400 text-sm">Intentá ajustar los filtros o la búsqueda</p>
                        <a href="{{ route('datasets.index') }}" class="inline-flex items-center gap-2 mt-6 text-escobar-blue font-semibold text-sm hover:gap-3 transition-all">
                            <i class="fas fa-arrow-left text-xs"></i>
                            Ver todos los datasets
                        </a>
                    </div>
                @endforelse
            </div>

            @if($datasets->hasPages())
                <div class="mt-8">
                    {{ $datasets->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
