@extends('layouts.app')

@section('title', 'Contacto de Áreas')

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
                    <i class="fas fa-address-book text-2xl sm:text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-heading text-shadow-lg">Contacto de Áreas</h1>
                    <p class="text-sm sm:text-base lg:text-lg text-blue-100 font-light mt-1">Información de contacto de las áreas gubernamentales</p>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 40" fill="none" class="w-full"><path d="M0 40V20C240 0 480 0 720 10C960 20 1200 30 1440 20V40H0Z" fill="#f9fafb"/></svg>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8 lg:py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 stagger-children">
        @foreach($areas as $area)
            <div class="bg-white rounded-2xl shadow-md p-5 sm:p-6 border border-gray-100 hover-lift transition-all animate-fade-in-up">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-11 h-11 rounded-xl gradient-blue flex items-center justify-center shadow-md flex-shrink-0">
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
