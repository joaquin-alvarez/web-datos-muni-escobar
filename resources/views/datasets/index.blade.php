@extends('layouts.app')

@section('title', 'Datasets')

@section('content')
<div class="gradient-blue text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-database text-4xl"></i>
            </div>
            <div>
                <h1 class="text-5xl font-bold font-heading mb-2 text-shadow">Datasets</h1>
                <p class="text-xl text-blue-50 font-light">Accedé a los datos abiertos del Municipio de Escobar</p>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-escobar-green via-white to-escobar-green opacity-50"></div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <aside class="lg:w-64 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4 border border-gray-100">
                <h2 class="text-lg font-bold font-heading mb-4 text-gray-800 flex items-center gap-2">
                    <i class="fas fa-filter text-escobar-blue"></i>
                    Filtrar por tema
                </h2>
                
                <div class="space-y-2">
                    <a href="{{ route('datasets.index') }}" 
                       class="block px-4 py-3 rounded-lg transition-all font-medium {{ !request('category') ? 'gradient-blue text-white shadow-md' : 'text-gray-700 hover:bg-blue-50 hover:text-escobar-blue' }}">
                        <i class="fas fa-list w-5"></i>
                        Todos los datasets
                        <span class="float-right text-sm font-bold bg-white/20 px-2 py-0.5 rounded">{{ $totalCount }}</span>
                    </a>
                    
                    @foreach($categories as $category)
                        <a href="{{ route('datasets.index', ['category' => $category->slug]) }}" 
                           class="block px-4 py-3 rounded-lg transition-all font-medium text-sm {{ request('category') == $category->slug ? 'gradient-blue text-white shadow-md' : 'text-gray-700 hover:bg-blue-50 hover:text-escobar-blue' }}">
                            <i class="fas {{ $category->icon }} w-5"></i>
                            {{ $category->name }}
                            <span class="float-right font-bold {{ request('category') == $category->slug ? 'bg-white/20 px-2 py-0.5 rounded' : 'text-gray-500' }}">{{ $category->datasets_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>

        <div class="flex-1">
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="text-gray-600">
                        <span class="font-bold font-heading text-3xl text-escobar-blue">{{ $datasets->total() }}</span>
                        <span class="text-sm ml-2">datasets encontrados</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-600 font-medium">Ordenar por:</label>
                        <select onchange="window.location.href=this.value" 
                                class="border-2 border-gray-200 rounded-lg px-4 py-2 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-escobar-blue focus:border-escobar-blue transition-all">
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

            <div class="space-y-5">
                @forelse($datasets as $dataset)
                    <div class="bg-white rounded-xl shadow-lg hover-lift p-6 border border-gray-100 transition-all">
                        <div class="flex flex-col lg:flex-row justify-between gap-4">
                            <div class="flex-1">
                                <a href="{{ route('datasets.show', $dataset->slug) }}" 
                                   class="text-xl font-bold font-heading text-escobar-blue hover:text-escobar-blue-light transition-colors">
                                    {{ $dataset->title }}
                                </a>
                                
                                <p class="text-gray-600 mt-3 line-clamp-2 leading-relaxed">
                                    {{ $dataset->description }}
                                </p>
                                
                                <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-lg">
                                        <i class="fas fa-building text-escobar-blue"></i>
                                        <span class="font-medium">{{ $dataset->organization }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-lg">
                                        <i class="fas fa-tag text-escobar-green"></i>
                                        <span class="font-medium">{{ $dataset->category->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-lg">
                                        <i class="fas fa-clock text-gray-500"></i>
                                        <span class="font-medium">{{ $dataset->last_modified->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap lg:flex-col items-start gap-2">
                                @foreach($dataset->formats as $format)
                                    <span class="inline-block px-3 py-2 rounded-lg text-white text-xs font-bold uppercase shadow-md hover:scale-105 transition-transform"
                                          style="background-color: {{ $format->color }}">
                                        {{ $format->extension }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center border border-gray-100">
                        <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-inbox text-5xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-600 text-lg font-semibold">No se encontraron datasets</p>
                        <p class="text-gray-500 text-sm mt-2">Intenta ajustar los filtros de búsqueda</p>
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
