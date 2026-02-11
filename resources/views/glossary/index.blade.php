@extends('layouts.app')

@section('title', 'Glosario')

@section('content')
<div class="gradient-blue text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-book text-4xl"></i>
            </div>
            <div>
                <h1 class="text-5xl font-bold font-heading mb-2 text-shadow">Glosario</h1>
                <p class="text-xl text-blue-50 font-light">Definiciones de términos relacionados con datos abiertos</p>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-escobar-green via-white to-escobar-green opacity-50"></div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
        <div class="flex flex-wrap gap-2 justify-center">
            <a href="{{ route('glossary.index') }}" 
               class="px-4 py-2 rounded-lg font-bold text-sm transition-all {{ !$letter ? 'gradient-blue text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-blue-50 hover:text-escobar-blue' }}">
                Todos
            </a>
            @foreach($letters as $l)
                <a href="{{ route('glossary.index', ['letter' => $l]) }}" 
                   class="px-4 py-2 rounded-lg font-bold text-sm transition-all {{ $letter == $l ? 'gradient-blue text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-blue-50 hover:text-escobar-blue' }}">
                    {{ $l }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="space-y-4">
        @forelse($terms as $term)
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover-lift transition-all">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 bg-gradient-to-br from-escobar-blue to-escobar-blue-light w-12 h-12 rounded-xl flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-lg font-heading">{{ $term->letter }}</span>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold font-heading text-gray-800 mb-2">{{ $term->term }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $term->definition }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-lg p-12 text-center border border-gray-100">
                <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-book-open text-5xl text-gray-400"></i>
                </div>
                <p class="text-gray-600 text-lg font-semibold">No se encontraron términos</p>
                <p class="text-gray-500 text-sm mt-2">Intenta seleccionar otra letra</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
