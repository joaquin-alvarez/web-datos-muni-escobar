@extends('layouts.app')

@section('title', 'Organismos y Entidades')

@section('content')
<!-- Page Header -->
<div class="gradient-blue text-white py-8 sm:py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-heading mb-1">Organismos y Entidades</h1>
        <p class="text-sm sm:text-base text-blue-100">Estructura orgánica del Municipio de Escobar</p>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8 lg:py-12">
    @foreach($organisms as $organism)
        <div class="mb-10 sm:mb-12">
            <div class="gradient-blue rounded-2xl shadow-md p-5 sm:p-7 lg:p-8 text-white mb-5 sm:mb-6">
                <div>
                    <div class="flex items-center gap-3 sm:gap-4 mb-4">
                        <div class="bg-white/15 p-2.5 sm:p-3 rounded-lg">
                            <i class="fas fa-landmark text-xl sm:text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold font-heading">{{ $organism->name }}</h2>
                            <span class="text-blue-200 font-medium text-xs sm:text-sm uppercase tracking-wider">{{ $organism->type }}</span>
                        </div>
                    </div>
                    <p class="text-blue-100 leading-relaxed mb-4 text-sm sm:text-base max-w-3xl">{{ $organism->description }}</p>

                    @if($organism->head_name)
                        <div class="bg-white/10 rounded-lg p-3 sm:p-4 inline-flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                                <i class="fas fa-user text-xs"></i>
                            </div>
                            <div>
                                <span class="text-blue-200 text-xs font-medium">Responsable</span>
                                <div class="font-bold text-sm">{{ $organism->head_name }} <span class="font-normal text-blue-200">- {{ $organism->head_position }}</span></div>
                            </div>
                        </div>
                    @endif

                    @if($organism->functions)
                        <div class="mt-5 sm:mt-6">
                            <h4 class="font-bold font-heading text-sm mb-3 flex items-center gap-2 uppercase tracking-wider">
                                <i class="fas fa-tasks text-xs"></i>
                                Funciones principales
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                @foreach(explode('. ', rtrim($organism->functions, '.')) as $func)
                                    @if(trim($func))
                                        <div class="flex items-start gap-2.5 bg-white/8 rounded-lg p-3">
                                            <i class="fas fa-check-circle text-escobar-green mt-0.5 text-xs"></i>
                                            <span class="text-xs sm:text-sm text-blue-50">{{ trim($func) }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($organism->children->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 ml-4 sm:ml-6 border-l-4 border-escobar-blue/15 pl-4 sm:pl-6">
                    @foreach($organism->children as $child)
                        <div class="bg-white rounded-xl shadow-sm p-5 sm:p-6 border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-3 mb-3 sm:mb-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-building text-escobar-blue text-sm"></i>
                                </div>
                                <div class="min-w-0">
                                    <h3 class="font-bold font-heading text-gray-800 text-sm sm:text-base leading-snug">{{ $child->name }}</h3>
                                    <span class="text-xs text-escobar-blue font-semibold">{{ $child->type }}</span>
                                </div>
                            </div>
                            <p class="text-gray-500 text-xs sm:text-sm leading-relaxed mb-4">{{ $child->description }}</p>

                            @if($child->head_name)
                                <div class="bg-gray-50 rounded-xl p-3 text-xs sm:text-sm mb-3">
                                    <span class="text-gray-400 font-medium text-xs">Responsable</span>
                                    <div class="font-semibold text-gray-800 mt-0.5">{{ $child->head_name }}</div>
                                    <div class="text-gray-500 text-xs">{{ $child->head_position }}</div>
                                </div>
                            @endif

                            @if($child->functions)
                                <div>
                                    <h5 class="font-semibold text-gray-500 text-xs mb-2 uppercase tracking-wide">Funciones</h5>
                                    <ul class="space-y-1.5">
                                        @foreach(explode('. ', rtrim($child->functions, '.')) as $func)
                                            @if(trim($func))
                                                <li class="text-gray-500 text-xs flex items-start gap-1.5">
                                                    <i class="fas fa-chevron-right text-escobar-green mt-0.5 text-[9px]"></i>
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

    <div class="mt-8 bg-gray-50 p-5 rounded-xl border-l-4 border-escobar-blue">
        <p class="text-gray-500 text-xs sm:text-sm flex items-start gap-2">
            <i class="fas fa-info-circle text-escobar-blue mt-0.5"></i>
            <span><strong class="text-gray-700">Nota:</strong> La estructura orgánica se presenta parcialmente, hasta el nivel de Secretarías, según lo establecido por la normativa vigente.</span>
        </p>
    </div>
</div>
@endsection
