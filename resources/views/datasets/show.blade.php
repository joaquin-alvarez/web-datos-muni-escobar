@extends('layouts.app')

@section('title', $dataset->title)

@section('content')
<div class="bg-gradient-to-r from-gray-50 to-blue-50 py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <nav class="text-sm flex items-center gap-2">
            <a href="{{ route('home') }}" class="text-escobar-blue hover:text-escobar-blue-light font-medium transition-colors flex items-center gap-1">
                <i class="fas fa-home"></i>
                Inicio
            </a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <a href="{{ route('datasets.index') }}" class="text-escobar-blue hover:text-escobar-blue-light font-medium transition-colors">Datasets</a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <span class="text-gray-700 font-semibold">{{ $dataset->title }}</span>
        </nav>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-start gap-4 mb-6">
                    <div class="bg-gradient-to-br from-escobar-blue to-escobar-blue-light p-4 rounded-xl shadow-lg">
                        <i class="fas fa-file-alt text-white text-3xl"></i>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-4xl font-bold font-heading text-gray-800 mb-2">{{ $dataset->title }}</h1>
                        <div class="flex flex-wrap gap-3 text-sm text-gray-600">
                            <div class="flex items-center gap-2 bg-blue-50 px-3 py-2 rounded-lg">
                                <i class="fas fa-building text-escobar-blue"></i>
                                <span class="font-medium">{{ $dataset->organization }}</span>
                            </div>
                            <div class="flex items-center gap-2 bg-green-50 px-3 py-2 rounded-lg">
                                <i class="fas fa-tag text-escobar-green"></i>
                                <span class="font-medium">{{ $dataset->category->name }}</span>
                            </div>
                            <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg">
                                <i class="fas fa-clock text-gray-600"></i>
                                <span class="font-medium">Actualizado {{ $dataset->last_modified->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-50 to-transparent p-6 rounded-xl border-l-4 border-escobar-blue">
                    <h2 class="text-2xl font-bold font-heading mb-4 text-gray-800 flex items-center gap-2">
                        <i class="fas fa-info-circle text-escobar-blue"></i>
                        Descripción
                    </h2>
                    <p class="text-gray-700 leading-relaxed text-base">{{ $dataset->description }}</p>
                </div>

                <div class="mt-8">
                    <h2 class="text-2xl font-bold font-heading mb-6 text-gray-800 flex items-center gap-2">
                        <i class="fas fa-download text-escobar-green"></i>
                        Recursos disponibles
                    </h2>
                    
                    <div class="space-y-4">
                        @foreach($dataset->formats as $format)
                            <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-escobar-blue hover:shadow-lg transition-all hover-lift bg-gradient-to-r from-white to-gray-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-5 flex-1">
                                        <div class="flex-shrink-0">
                                            <span class="inline-block px-4 py-3 rounded-xl text-white text-sm font-bold uppercase w-20 text-center shadow-md"
                                                  style="background-color: {{ $format->color }}">
                                                {{ $format->extension }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex-1">
                                            <h3 class="font-bold text-gray-800 text-lg mb-1">{{ $format->pivot->file_name }}</h3>
                                            <p class="text-sm text-gray-600 flex items-center gap-2">
                                                <i class="fas fa-hdd text-escobar-blue"></i>
                                                <span class="font-medium">{{ number_format($format->pivot->file_size / 1024, 0) }} KB</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ $format->pivot->file_url }}" 
                                       class="gradient-blue text-white px-8 py-3 rounded-xl hover:shadow-xl transition-all inline-flex items-center gap-2 font-bold hover:scale-105">
                                        <i class="fas fa-download"></i>
                                        Descargar
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 mb-6 shadow-lg border border-blue-200">
                <h3 class="font-bold font-heading text-lg text-gray-800 mb-5 flex items-center gap-2">
                    <i class="fas fa-info-circle text-escobar-blue text-xl"></i>
                    Información adicional
                </h3>
                
                <dl class="space-y-4 text-sm">
                    <div class="bg-white/60 p-3 rounded-lg">
                        <dt class="text-gray-600 font-semibold mb-1 flex items-center gap-2">
                            <i class="fas fa-tag text-escobar-blue"></i>
                            Categoría
                        </dt>
                        <dd class="text-gray-800 font-medium">{{ $dataset->category->name }}</dd>
                    </div>
                    <div class="bg-white/60 p-3 rounded-lg">
                        <dt class="text-gray-600 font-semibold mb-1 flex items-center gap-2">
                            <i class="fas fa-building text-escobar-blue"></i>
                            Organización
                        </dt>
                        <dd class="text-gray-800 font-medium">{{ $dataset->organization }}</dd>
                    </div>
                    <div class="bg-white/60 p-3 rounded-lg">
                        <dt class="text-gray-600 font-semibold mb-1 flex items-center gap-2">
                            <i class="fas fa-calendar text-escobar-blue"></i>
                            Última actualización
                        </dt>
                        <dd class="text-gray-800 font-medium">{{ $dataset->last_modified->format('d/m/Y') }}</dd>
                    </div>
                    <div class="bg-white/60 p-3 rounded-lg">
                        <dt class="text-gray-600 font-semibold mb-1 flex items-center gap-2">
                            <i class="fas fa-file text-escobar-blue"></i>
                            Formatos disponibles
                        </dt>
                        <dd class="text-gray-800 font-medium">{{ $dataset->formats->count() }} archivos</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="font-bold font-heading text-lg text-gray-800 mb-5 flex items-center gap-2">
                    <i class="fas fa-share-alt text-escobar-green text-xl"></i>
                    Compartir dataset
                </h3>
                
                <div class="flex gap-3">
                    <a href="#" class="flex-1 bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition-all hover:scale-105 shadow-md">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="flex-1 bg-blue-400 text-white text-center py-3 rounded-lg hover:bg-blue-500 transition-all hover:scale-105 shadow-md">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="flex-1 bg-green-600 text-white text-center py-3 rounded-lg hover:bg-green-700 transition-all hover:scale-105 shadow-md">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
