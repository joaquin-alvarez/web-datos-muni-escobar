@extends('layouts.app')

@section('title', 'Autoridades')

@section('content')
<div class="gradient-blue text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-landmark text-4xl"></i>
            </div>
            <div>
                <h1 class="text-5xl font-bold font-heading mb-2 text-shadow">Autoridades</h1>
                <p class="text-xl text-blue-50 font-light">Intendente y Gabinete del Municipio de Escobar</p>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-escobar-green via-white to-escobar-green opacity-50"></div>
</div>

<div class="container mx-auto px-4 py-12">
    @if($intendente)
    <section class="mb-16">
        <h2 class="text-3xl font-bold font-heading text-gray-800 mb-8 flex items-center gap-3">
            <i class="fas fa-star text-escobar-blue"></i>
            Intendente Municipal
        </h2>
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                <div class="lg:col-span-1">
                    <img src="{{ $intendente->photo_url }}" 
                         alt="Foto de {{ $intendente->name }}" 
                         class="w-full h-full object-cover min-h-[400px]">
                </div>
                <div class="lg:col-span-2 p-8 lg:p-12">
                    <div class="mb-6">
                        <h3 class="text-4xl font-bold font-heading text-gray-800 mb-2">{{ $intendente->name }}</h3>
                        <span class="inline-block gradient-blue text-white px-6 py-2 rounded-full text-lg font-semibold shadow-md">
                            {{ $intendente->position }}
                        </span>
                    </div>
                    
                    <div class="mb-8">
                        <h4 class="text-xl font-bold font-heading text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-user text-escobar-blue"></i>
                            Biografía
                        </h4>
                        <p class="text-gray-600 leading-relaxed text-base">{{ $intendente->biography }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center gap-3 bg-blue-50 px-4 py-3 rounded-lg">
                            <i class="fas fa-envelope text-escobar-blue text-lg"></i>
                            <span class="text-gray-700 font-medium">{{ $intendente->email }}</span>
                        </div>
                        <div class="flex items-center gap-3 bg-blue-50 px-4 py-3 rounded-lg">
                            <i class="fas fa-phone text-escobar-blue text-lg"></i>
                            <span class="text-gray-700 font-medium">{{ $intendente->phone }}</span>
                        </div>
                    </div>

                    <a href="{{ $intendente->cv_url }}" class="gradient-blue text-white px-8 py-3 rounded-xl hover:shadow-xl transition-all inline-flex items-center gap-2 font-bold hover:scale-105">
                        <i class="fas fa-file-pdf"></i>
                        Descargar CV
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section>
        <h2 class="text-3xl font-bold font-heading text-gray-800 mb-8 flex items-center gap-3">
            <i class="fas fa-users text-escobar-blue"></i>
            Gabinete Municipal
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cabinet as $member)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover-lift transition-all">
                    <img src="{{ $member->photo_url }}" 
                         alt="Foto de {{ $member->name }}" 
                         class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold font-heading text-gray-800 mb-1">{{ $member->name }}</h3>
                        <span class="inline-block bg-escobar-blue text-white px-3 py-1 rounded-full text-sm font-semibold mb-3">
                            {{ $member->position }}
                        </span>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">{{ $member->biography }}</p>
                        
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-envelope text-escobar-blue"></i>
                                <span>{{ $member->email }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-phone text-escobar-blue"></i>
                                <span>{{ $member->phone }}</span>
                            </div>
                        </div>

                        <a href="{{ $member->cv_url }}" class="mt-4 inline-flex items-center gap-2 text-escobar-blue font-semibold text-sm hover:text-escobar-blue-light transition-colors">
                            <i class="fas fa-file-pdf"></i>
                            Ver CV
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
