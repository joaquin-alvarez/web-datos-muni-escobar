@extends('layouts.app')

@section('title', 'Contacto de Áreas')

@section('content')
<div class="gradient-blue text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-address-book text-4xl"></i>
            </div>
            <div>
                <h1 class="text-5xl font-bold font-heading mb-2 text-shadow">Contacto de Áreas</h1>
                <p class="text-xl text-blue-50 font-light">Datos de contacto de las áreas del gobierno municipal</p>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-escobar-green via-white to-escobar-green opacity-50"></div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($areas as $area)
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover-lift transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-gradient-to-br from-escobar-blue to-escobar-blue-light p-3 rounded-xl shadow-md">
                        <i class="fas fa-building text-white text-lg"></i>
                    </div>
                    <h3 class="font-bold font-heading text-gray-800 text-lg">{{ $area->name }}</h3>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <div class="text-sm">
                        <span class="text-gray-500 font-medium">Responsable:</span>
                        <div class="font-semibold text-gray-800 mt-1">{{ $area->responsible_name }}</div>
                        <div class="text-escobar-blue text-xs font-medium">{{ $area->responsible_position }}</div>
                    </div>
                </div>

                <div class="space-y-3 text-sm">
                    @if($area->address)
                        <div class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-escobar-blue mt-0.5"></i>
                            <span class="text-gray-600">{{ $area->address }}</span>
                        </div>
                    @endif
                    @if($area->phone)
                        <div class="flex items-center gap-3">
                            <i class="fas fa-phone text-escobar-blue"></i>
                            <span class="text-gray-600">{{ $area->phone }}</span>
                        </div>
                    @endif
                    @if($area->email)
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-escobar-blue"></i>
                            <a href="mailto:{{ $area->email }}" class="text-escobar-blue hover:text-escobar-blue-light font-medium">{{ $area->email }}</a>
                        </div>
                    @endif
                    @if($area->schedule)
                        <div class="flex items-center gap-3">
                            <i class="fas fa-clock text-escobar-blue"></i>
                            <span class="text-gray-600">{{ $area->schedule }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-10 bg-gradient-to-r from-blue-50 to-transparent p-6 rounded-xl border-l-4 border-escobar-blue">
        <p class="text-gray-600 text-sm">
            <i class="fas fa-info-circle text-escobar-blue mr-2"></i>
            <strong>Nota:</strong> Los datos de contacto se presentan parcialmente, hasta el nivel de Secretarías más el contacto general del área.
        </p>
    </div>
</div>
@endsection
