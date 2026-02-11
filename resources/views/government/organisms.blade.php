@extends('layouts.app')

@section('title', 'Organismos y Entidades')

@section('content')
<div class="gradient-blue text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-sitemap text-4xl"></i>
            </div>
            <div>
                <h1 class="text-5xl font-bold font-heading mb-2 text-shadow">Organismos y Entidades</h1>
                <p class="text-xl text-blue-50 font-light">Estructura orgánica del Municipio de Escobar</p>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-escobar-green via-white to-escobar-green opacity-50"></div>
</div>

<div class="container mx-auto px-4 py-12">
    @foreach($organisms as $organism)
        <div class="mb-10">
            <div class="bg-gradient-to-r from-escobar-blue to-escobar-blue-light rounded-2xl shadow-xl p-8 text-white mb-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-white/20 p-3 rounded-xl">
                        <i class="fas fa-landmark text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold font-heading">{{ $organism->name }}</h2>
                        <span class="text-blue-100 font-medium">{{ $organism->type }}</span>
                    </div>
                </div>
                <p class="text-blue-50 leading-relaxed mb-4">{{ $organism->description }}</p>
                
                @if($organism->head_name)
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 inline-block">
                        <span class="text-blue-100 text-sm font-medium">Responsable:</span>
                        <span class="font-bold ml-2">{{ $organism->head_name }} - {{ $organism->head_position }}</span>
                    </div>
                @endif

                @if($organism->functions)
                    <div class="mt-6">
                        <h4 class="font-bold font-heading text-lg mb-3 flex items-center gap-2">
                            <i class="fas fa-tasks"></i>
                            Funciones principales
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach(explode('. ', rtrim($organism->functions, '.')) as $func)
                                @if(trim($func))
                                    <div class="flex items-start gap-2 bg-white/10 rounded-lg p-3">
                                        <i class="fas fa-check-circle text-escobar-green mt-0.5"></i>
                                        <span class="text-sm">{{ trim($func) }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            @if($organism->children->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pl-4 border-l-4 border-escobar-blue/20">
                    @foreach($organism->children as $child)
                        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover-lift transition-all">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="bg-escobar-blue/10 p-2 rounded-lg">
                                    <i class="fas fa-building text-escobar-blue text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold font-heading text-gray-800">{{ $child->name }}</h3>
                                    <span class="text-sm text-escobar-blue font-medium">{{ $child->type }}</span>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ $child->description }}</p>
                            
                            @if($child->head_name)
                                <div class="bg-gray-50 rounded-lg p-3 text-sm">
                                    <span class="text-gray-500 font-medium">Responsable:</span>
                                    <div class="font-semibold text-gray-800 mt-1">{{ $child->head_name }}</div>
                                    <div class="text-gray-600 text-xs">{{ $child->head_position }}</div>
                                </div>
                            @endif

                            @if($child->functions)
                                <div class="mt-4">
                                    <h5 class="font-semibold text-gray-700 text-sm mb-2">Funciones:</h5>
                                    <ul class="space-y-1">
                                        @foreach(explode('. ', rtrim($child->functions, '.')) as $func)
                                            @if(trim($func))
                                                <li class="text-gray-600 text-xs flex items-start gap-1.5">
                                                    <i class="fas fa-chevron-right text-escobar-green mt-0.5 text-[10px]"></i>
                                                    {{ trim($func) }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach

    <div class="mt-6 bg-gradient-to-r from-blue-50 to-transparent p-6 rounded-xl border-l-4 border-escobar-blue">
        <p class="text-gray-600 text-sm">
            <i class="fas fa-info-circle text-escobar-blue mr-2"></i>
            <strong>Nota:</strong> La estructura orgánica se presenta parcialmente, hasta el nivel de Secretarías, según lo establecido por la normativa vigente.
        </p>
    </div>
</div>
@endsection
