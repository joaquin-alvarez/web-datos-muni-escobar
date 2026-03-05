@extends('layouts.app')

@section('title', $dataset->title)

@section('content')
<!-- Breadcrumb -->
<div class="bg-white border-b border-gray-100">
    <div class="container mx-auto px-4 py-3 sm:py-4">
        <nav class="text-xs sm:text-sm flex items-center gap-2">
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-escobar-blue transition-colors flex items-center gap-1.5">
                <i class="fas fa-home text-[10px]"></i>
                <span class="hidden sm:inline">Inicio</span>
            </a>
            <i class="fas fa-chevron-right text-gray-300 text-[10px]"></i>
            <a href="{{ route('datasets.index') }}" class="text-gray-400 hover:text-escobar-blue transition-colors font-medium">Datasets</a>
            <i class="fas fa-chevron-right text-gray-300 text-[10px]"></i>
            <span class="text-gray-700 font-semibold truncate max-w-[200px] sm:max-w-none">{{ $dataset->title }}</span>
        </nav>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8 lg:py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-5 sm:p-7 lg:p-9 border border-gray-200">
                <!-- Header -->
                <div class="mb-6 sm:mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold font-heading text-gray-800 mb-3 leading-tight">{{ $dataset->title }}</h1>
                        <div class="flex flex-wrap gap-2 text-xs">
                            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-escobar-blue px-3 py-1.5 rounded-lg font-semibold">
                                <i class="fas fa-building text-[10px]"></i>
                                {{ $dataset->organization }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 bg-green-50 text-escobar-green px-3 py-1.5 rounded-lg font-semibold">
                                <i class="fas fa-tag text-[10px]"></i>
                                {{ $dataset->category->name }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 bg-gray-50 text-gray-500 px-3 py-1.5 rounded-lg font-medium">
                                <i class="fas fa-clock text-[10px]"></i>
                                {{ $dataset->last_modified->diffForHumans() }}
                            </span>
                        </div>
                </div>

                <!-- Description -->
                <div class="bg-gray-50 p-5 sm:p-6 rounded-xl border-l-4 border-escobar-blue mb-8">
                    <h2 class="text-lg sm:text-xl font-bold font-heading mb-3 text-gray-800 flex items-center gap-2">
                        <i class="fas fa-align-left text-escobar-blue text-sm"></i>
                        Descripción
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-sm sm:text-base">{{ $dataset->description }}</p>
                </div>

                <!-- Resources -->
                <div>
                    <h2 class="text-lg sm:text-xl font-bold font-heading mb-5 text-gray-800 flex items-center gap-2">
                        <i class="fas fa-download text-escobar-green text-sm"></i>
                        Recursos disponibles
                        <span class="text-xs font-semibold bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full ml-1">{{ $dataset->formats->count() }}</span>
                    </h2>

                    <div class="space-y-3">
                        @foreach($dataset->formats as $format)
                            <div class="group border border-gray-200 rounded-xl p-4 sm:p-5 hover:border-gray-300 transition-colors bg-white">
                                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4">
                                    <div class="flex items-center gap-4 flex-1 w-full min-w-0">
                                        <span class="inline-flex items-center justify-center px-3 py-2.5 rounded-lg text-white text-xs font-bold uppercase w-16 text-center"
                                              style="background-color: {{ $format->color }}">
                                            {{ $format->extension }}
                                        </span>

                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-gray-800 text-sm sm:text-base mb-0.5 truncate">{{ $format->pivot->file_name }}</h3>
                                            <p class="text-xs text-gray-400 flex items-center gap-1.5">
                                                <i class="fas fa-weight-hanging text-[10px]"></i>
                                                {{ number_format($format->pivot->file_size / 1024, 0) }} KB
                                            </p>
                                        </div>
                                    </div>

                                    <a href="{{ $format->pivot->file_url }}"
                                       class="bg-escobar-blue text-white px-5 sm:px-6 py-2.5 rounded-lg hover:bg-escobar-blue-dark transition-colors inline-flex items-center justify-center gap-2 font-semibold w-full sm:w-auto text-sm">
                                        <i class="fas fa-download text-xs"></i>
                                        Descargar
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-5">
            <!-- Additional Info -->
            <div class="bg-white rounded-xl shadow-sm p-5 sm:p-6 border border-gray-200">
                <h3 class="font-bold font-heading text-sm text-gray-500 mb-4 uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-info-circle text-escobar-blue text-xs"></i>
                    Información del dataset
                </h3>

                <dl class="space-y-3 text-sm">
                    <div class="flex items-start gap-3 py-2.5 border-b border-gray-50">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-tag text-escobar-blue text-xs"></i>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs font-semibold uppercase tracking-wide">Categoría</dt>
                            <dd class="text-gray-800 font-medium mt-0.5">{{ $dataset->category->name }}</dd>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 py-2.5 border-b border-gray-50">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-building text-escobar-blue text-xs"></i>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs font-semibold uppercase tracking-wide">Organización</dt>
                            <dd class="text-gray-800 font-medium mt-0.5">{{ $dataset->organization }}</dd>
                        </div>
                    </div>
                    @if($dataset->source)
                    <div class="flex items-start gap-3 py-2.5 border-b border-gray-50">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-database text-escobar-blue text-xs"></i>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs font-semibold uppercase tracking-wide">Fuente</dt>
                            <dd class="text-gray-800 font-medium mt-0.5">{{ $dataset->source }}</dd>
                        </div>
                    </div>
                    @endif
                    <div class="flex items-start gap-3 py-2.5 border-b border-gray-50">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-code-branch text-escobar-blue text-xs"></i>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs font-semibold uppercase tracking-wide">Versión</dt>
                            <dd class="text-gray-800 font-medium mt-0.5">{{ $dataset->version }}</dd>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 py-2.5 border-b border-gray-50">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-sync-alt text-escobar-blue text-xs"></i>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs font-semibold uppercase tracking-wide">Periodicidad</dt>
                            <dd class="text-gray-800 font-medium mt-0.5">{{ $dataset->periodicity }}</dd>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 py-2.5 border-b border-gray-50">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-calendar-plus text-escobar-blue text-xs"></i>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs font-semibold uppercase tracking-wide">Creación</dt>
                            <dd class="text-gray-800 font-medium mt-0.5">{{ $dataset->created_date->format('d/m/Y') }}</dd>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 py-2.5 border-b border-gray-50">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-calendar-check text-escobar-blue text-xs"></i>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs font-semibold uppercase tracking-wide">Última actualización</dt>
                            <dd class="text-gray-800 font-medium mt-0.5">{{ $dataset->last_modified->format('d/m/Y') }}</dd>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 py-2.5 border-b border-gray-50">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-balance-scale text-escobar-blue text-xs"></i>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs font-semibold uppercase tracking-wide">Licencia</dt>
                            <dd class="text-gray-800 font-medium mt-0.5">{{ $dataset->license }}</dd>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 py-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-file text-escobar-blue text-xs"></i>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs font-semibold uppercase tracking-wide">Formatos</dt>
                            <dd class="text-gray-800 font-medium mt-0.5">{{ $dataset->formats->count() }} archivos</dd>
                        </div>
                    </div>
                </dl>
            </div>

            <!-- Share -->
            <div class="bg-white rounded-xl shadow-sm p-5 sm:p-6 border border-gray-200">
                <h3 class="font-bold font-heading text-sm text-gray-500 mb-4 uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-share-alt text-escobar-green text-xs"></i>
                    Compartir
                </h3>

                <div class="grid grid-cols-3 gap-2 mb-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('datasets.show', $dataset)) }}"
                       target="_blank" rel="noopener noreferrer"
                       class="flex items-center justify-center py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors"
                       title="Facebook">
                        <i class="fab fa-facebook-f text-base"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('datasets.show', $dataset)) }}&text={{ urlencode($dataset->title) }}"
                       target="_blank" rel="noopener noreferrer"
                       class="flex items-center justify-center py-3 rounded-lg bg-gray-800 text-white hover:bg-gray-900 transition-colors"
                       title="X / Twitter">
                        <i class="fab fa-x-twitter text-base"></i>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($dataset->title . ' - ' . route('datasets.show', $dataset)) }}"
                       target="_blank" rel="noopener noreferrer"
                       class="flex items-center justify-center py-3 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors"
                       title="WhatsApp">
                        <i class="fab fa-whatsapp text-base"></i>
                    </a>
                </div>

                <button onclick="copyDatasetLink()"
                        class="w-full bg-gray-50 text-gray-600 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center justify-center gap-2 font-semibold text-sm border border-gray-200">
                    <i class="fas fa-link text-xs"></i>
                    Copiar enlace
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyDatasetLink() {
        navigator.clipboard.writeText('{{ route('datasets.show', $dataset) }}').then(function() {
            if (typeof showToast === 'function') {
                showToast('Enlace copiado al portapapeles', 'success');
            }
        }, function() {
            if (typeof showToast === 'function') {
                showToast('No se pudo copiar el enlace', 'error');
            }
        });
    }
</script>
@endpush
@endsection
