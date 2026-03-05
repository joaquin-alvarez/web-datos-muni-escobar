@extends('layouts.app')

@section('title', 'Autoridades')

@section('content')
<!-- Page Header -->
<div class="gradient-blue text-white py-8 sm:py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-heading mb-1">Autoridades</h1>
        <p class="text-sm sm:text-base text-blue-100">Intendente y Gabinete del Municipio de Escobar</p>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8 lg:py-12">
    @if($intendente)
    <section class="mb-10 sm:mb-14 lg:mb-16">
        <h2 class="text-xl sm:text-2xl font-bold font-heading text-gray-800 mb-6 sm:mb-8">
            Intendente Municipal
        </h2>
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                <div class="lg:col-span-1">
                    <img src="{{ $intendente->photo_url }}"
                         alt="Foto de {{ $intendente->name }}"
                         class="w-full h-full object-cover min-h-[280px] sm:min-h-[360px]">
                </div>
                <div class="lg:col-span-2 p-5 sm:p-8 lg:p-10">
                    <div class="mb-5 sm:mb-6">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-heading text-gray-800 mb-3">{{ $intendente->name }}</h3>
                        <span class="inline-flex items-center gap-2 bg-escobar-blue text-white px-4 py-1.5 rounded-lg text-sm font-medium">
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

                    <a href="{{ $intendente->cv_url }}" class="bg-escobar-blue text-white px-5 py-2.5 rounded-lg hover:bg-escobar-blue-dark transition-colors inline-flex items-center gap-2 font-semibold text-sm">
                        <i class="fas fa-file-pdf"></i>
                        Descargar CV
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section>
        <h2 class="text-xl sm:text-2xl font-bold font-heading text-gray-800 mb-6 sm:mb-8">
            Gabinete Municipal
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 stagger-children">
            @foreach($cabinet as $member)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 hover:shadow-md transition-shadow">
                    <img src="{{ $member->photo_url }}"
                         alt="Foto de {{ $member->name }}"
                         class="w-full h-48 sm:h-52 object-cover">
                    <div class="p-5 sm:p-6">
                        <h3 class="text-base sm:text-lg font-bold font-heading text-gray-800 mb-1.5 leading-snug">{{ $member->name }}</h3>
                        <span class="inline-flex items-center bg-blue-50 text-escobar-blue px-2.5 py-1 rounded text-xs font-medium mb-3">
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
