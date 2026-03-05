@extends('layouts.app')

@section('title', 'Autoridades')

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
                    <i class="fas fa-landmark text-2xl sm:text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-heading text-shadow-lg">Autoridades</h1>
                    <p class="text-sm sm:text-base lg:text-lg text-blue-100 font-light mt-1">Intendente y Gabinete del Municipio de Escobar</p>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 40" fill="none" class="w-full"><path d="M0 40V20C240 0 480 0 720 10C960 20 1200 30 1440 20V40H0Z" fill="#f9fafb"/></svg>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8 lg:py-12">
    @if($intendente)
    <section class="mb-10 sm:mb-14 lg:mb-16 animate-fade-in-up">
        <h2 class="text-xl sm:text-2xl font-extrabold font-heading text-gray-800 mb-6 sm:mb-8 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl gradient-blue flex items-center justify-center shadow-md">
                <i class="fas fa-star text-white text-sm"></i>
            </div>
            Intendente Municipal
        </h2>
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                <div class="lg:col-span-1">
                    <img src="{{ $intendente->photo_url }}"
                         alt="Foto de {{ $intendente->name }}"
                         class="w-full h-full object-cover min-h-[280px] sm:min-h-[360px]">
                </div>
                <div class="lg:col-span-2 p-5 sm:p-8 lg:p-10">
                    <div class="mb-5 sm:mb-6">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-heading text-gray-800 mb-3">{{ $intendente->name }}</h3>
                        <span class="inline-flex items-center gap-2 gradient-blue text-white px-5 py-2 rounded-xl text-sm sm:text-base font-semibold shadow-md">
                            <i class="fas fa-landmark text-xs"></i>
                            {{ $intendente->position }}
                        </span>
                    </div>

                    <div class="mb-6 sm:mb-8">
                        <h4 class="text-sm font-bold font-heading text-gray-500 mb-3 uppercase tracking-wider flex items-center gap-2">
                            <i class="fas fa-user text-escobar-blue text-xs"></i>
                            Biografía
                        </h4>
                        <p class="text-gray-500 leading-relaxed text-sm sm:text-base">{{ $intendente->biography }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
                        <div class="flex items-center gap-3 bg-blue-50/60 px-4 py-3 rounded-xl">
                            <div class="w-8 h-8 rounded-lg bg-escobar-blue/10 flex items-center justify-center">
                                <i class="fas fa-envelope text-escobar-blue text-xs"></i>
                            </div>
                            <span class="text-gray-700 font-medium text-sm truncate">{{ $intendente->email }}</span>
                        </div>
                        <div class="flex items-center gap-3 bg-blue-50/60 px-4 py-3 rounded-xl">
                            <div class="w-8 h-8 rounded-lg bg-escobar-blue/10 flex items-center justify-center">
                                <i class="fas fa-phone text-escobar-blue text-xs"></i>
                            </div>
                            <span class="text-gray-700 font-medium text-sm">{{ $intendente->phone }}</span>
                        </div>
                    </div>

                    <a href="{{ $intendente->cv_url }}" class="gradient-blue text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all inline-flex items-center gap-2 font-bold hover:scale-[1.03] text-sm">
                        <i class="fas fa-file-pdf"></i>
                        Descargar CV
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="animate-fade-in-up delay-200">
        <h2 class="text-xl sm:text-2xl font-extrabold font-heading text-gray-800 mb-6 sm:mb-8 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl gradient-green flex items-center justify-center shadow-md">
                <i class="fas fa-users text-white text-sm"></i>
            </div>
            Gabinete Municipal
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 stagger-children">
            @foreach($cabinet as $member)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 hover-lift transition-all animate-fade-in-up">
                    <img src="{{ $member->photo_url }}"
                         alt="Foto de {{ $member->name }}"
                         class="w-full h-48 sm:h-52 object-cover">
                    <div class="p-5 sm:p-6">
                        <h3 class="text-base sm:text-lg font-bold font-heading text-gray-800 mb-1.5 leading-snug">{{ $member->name }}</h3>
                        <span class="inline-flex items-center gap-1.5 bg-escobar-blue/10 text-escobar-blue px-3 py-1 rounded-lg text-xs font-semibold mb-3">
                            {{ $member->position }}
                        </span>
                        <p class="text-gray-500 text-xs sm:text-sm leading-relaxed mb-4 line-clamp-3">{{ $member->biography }}</p>

                        <div class="space-y-2 text-xs sm:text-sm border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-2 text-gray-500">
                                <i class="fas fa-envelope text-escobar-blue text-[10px]"></i>
                                <span class="truncate">{{ $member->email }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-500">
                                <i class="fas fa-phone text-escobar-blue text-[10px]"></i>
                                <span>{{ $member->phone }}</span>
                            </div>
                        </div>

                        <a href="{{ $member->cv_url }}" class="mt-4 inline-flex items-center gap-2 text-escobar-blue font-semibold text-xs hover:text-escobar-blue-light hover:gap-3 transition-all">
                            <i class="fas fa-file-pdf"></i>
                            Ver CV
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
