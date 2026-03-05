@extends('layouts.app')

@section('title', 'Glosario')

@section('content')
<!-- Page Header -->
<div class="gradient-blue text-white py-10 sm:py-14 lg:py-16 relative overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/3 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 bg-white/5 rounded-full translate-y-1/3 -translate-x-1/4"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="bg-white/15 backdrop-blur-sm p-3 sm:p-4 rounded-xl border border-white/10">
                    <i class="fas fa-book text-2xl sm:text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-heading text-shadow-lg">Glosario</h1>
                    <p class="text-sm sm:text-base lg:text-lg text-blue-100 font-light mt-1">Definiciones de términos relacionados con datos abiertos</p>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 40" fill="none" class="w-full"><path d="M0 40V20C240 0 480 0 720 10C960 20 1200 30 1440 20V40H0Z" fill="#f9fafb"/></svg>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8">
    <!-- Letter Filter -->
    <div class="bg-white rounded-2xl shadow-md p-4 sm:p-5 mb-6 sm:mb-8 border border-gray-100">
        <div class="flex flex-wrap gap-1.5 sm:gap-2 justify-center">
            <a href="{{ route('glossary.index') }}"
               class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl font-bold text-xs sm:text-sm transition-all flex items-center justify-center {{ !$letter ? 'gradient-blue text-white shadow-md' : 'bg-gray-50 text-gray-600 hover:bg-blue-50 hover:text-escobar-blue border border-gray-200 hover:border-escobar-blue/30' }}">
                <i class="fas fa-th text-xs"></i>
            </a>
            @foreach($letters as $l)
                <a href="{{ route('glossary.index', ['letter' => $l]) }}"
                   class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl font-bold text-xs sm:text-sm transition-all flex items-center justify-center {{ $letter == $l ? 'gradient-blue text-white shadow-md' : 'bg-gray-50 text-gray-600 hover:bg-blue-50 hover:text-escobar-blue border border-gray-200 hover:border-escobar-blue/30' }}">
                    {{ $l }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Terms -->
    <div class="space-y-3 stagger-children">
        @forelse($terms as $term)
            <div class="bg-white rounded-2xl shadow-md p-5 sm:p-6 border border-gray-100 hover-glow transition-all animate-fade-in-up">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 bg-gradient-to-br from-escobar-blue to-escobar-blue-light w-11 h-11 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center shadow-md">
                        <span class="text-white font-extrabold text-base sm:text-lg font-heading">{{ $term->letter }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg sm:text-xl font-bold font-heading text-gray-800 mb-2">{{ $term->term }}</h3>
                        <p class="text-gray-500 leading-relaxed text-sm sm:text-base">{{ $term->definition }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-md p-10 sm:p-16 text-center border border-gray-100">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-5">
                    <i class="fas fa-book-open text-3xl sm:text-4xl text-gray-300"></i>
                </div>
                <p class="text-gray-700 text-lg font-bold font-heading mb-2">No se encontraron términos</p>
                <p class="text-gray-400 text-sm">Intentá seleccionar otra letra</p>
                <a href="{{ route('glossary.index') }}" class="inline-flex items-center gap-2 mt-6 text-escobar-blue font-semibold text-sm hover:gap-3 transition-all">
                    <i class="fas fa-arrow-left text-xs"></i>
                    Ver todos los términos
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
