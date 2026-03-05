@extends('layouts.app')

@section('title', 'Contacto de Áreas')

@section('content')
<!-- Page Header -->
<div class="gradient-blue text-white py-8 sm:py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-heading mb-1">Contacto de Áreas</h1>
        <p class="text-sm sm:text-base text-blue-100">Información de contacto de las áreas gubernamentales</p>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8 lg:py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 stagger-children">
        @foreach($areas as $area)
            <div class="bg-white rounded-xl shadow-sm p-5 sm:p-6 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-escobar-blue flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-building text-white text-sm"></i>
                    </div>
                    <h3 class="font-bold font-heading text-gray-800 text-sm sm:text-base leading-snug">{{ $area->name }}</h3>
                </div>

                <div class="space-y-2.5 text-sm">
                    @if($area->responsible)
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-user text-escobar-blue text-[10px]"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-gray-400 font-medium text-xs">Responsable</span>
                            <p class="text-gray-800 font-semibold text-sm">{{ $area->responsible }}</p>
                        </div>
                    </div>
                    @endif

                    @if($area->address)
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-map-marker-alt text-escobar-blue text-[10px]"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-gray-400 font-medium text-xs">Dirección</span>
                            <p class="text-gray-700 font-medium text-sm">{{ $area->address }}</p>
                        </div>
                    </div>
                    @endif

                    @if($area->phone)
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-phone text-escobar-blue text-[10px]"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-gray-400 font-medium text-xs">Teléfono</span>
                            <p class="text-gray-700 font-medium text-sm">{{ $area->phone }}</p>
                        </div>
                    </div>
                    @endif

                    @if($area->email)
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-envelope text-escobar-blue text-[10px]"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-gray-400 font-medium text-xs">Email</span>
                            <a href="mailto:{{ $area->email }}" class="text-escobar-blue hover:text-escobar-blue-light font-medium text-sm block truncate transition-colors">{{ $area->email }}</a>
                        </div>
                    </div>
                    @endif

                    @if($area->schedule)
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-clock text-escobar-blue text-[10px]"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-gray-400 font-medium text-xs">Horario</span>
                            <p class="text-gray-700 font-medium text-sm">{{ $area->schedule }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 sm:mt-10 bg-gradient-to-r from-blue-50 to-transparent p-4 sm:p-6 rounded-xl border-l-4 border-escobar-blue">
        <p class="text-gray-600 text-xs sm:text-sm">
            <i class="fas fa-info-circle text-escobar-blue mr-2"></i>
            <strong>Nota:</strong> Los datos de contacto se presentan parcialmente, hasta el nivel de Secretarías más el contacto general del área.
        </p>
    </div>
</div>
@endsection
