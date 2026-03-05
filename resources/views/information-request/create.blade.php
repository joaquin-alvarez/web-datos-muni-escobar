@extends('layouts.app')

@section('title', 'Solicitar Información')

@section('content')
<!-- Page Header -->
<div class="gradient-blue text-white py-8 sm:py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-heading mb-1">Solicitar Información</h1>
        <p class="text-sm sm:text-base text-blue-100">Enviá tu solicitud de información pública</p>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8 lg:py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
        <!-- Form -->
        <div class="lg:col-span-2">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-5 mb-6 flex items-start gap-3">
                    <i class="fas fa-check-circle text-green-500 text-lg mt-0.5 flex-shrink-0"></i>
                    <div>
                        <h3 class="font-bold text-green-800 font-heading text-sm">¡Solicitud enviada!</h3>
                        <p class="text-green-700 text-xs sm:text-sm mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm p-5 sm:p-7 lg:p-9 border border-gray-200">
                <h2 class="text-lg sm:text-xl font-bold font-heading text-gray-800 mb-5 sm:mb-6 flex items-center gap-2">
                    <i class="fas fa-edit text-escobar-blue text-sm"></i>
                    Formulario de solicitud
                </h2>

                <form action="{{ route('information-request.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">
                            Nombre completo <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-escobar-blue/20 focus:border-escobar-blue focus:bg-white transition-all"
                               placeholder="Ingresá tu nombre completo">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle text-[10px]"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">
                            Correo electrónico <span class="text-red-400">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-escobar-blue/20 focus:border-escobar-blue focus:bg-white transition-all"
                               placeholder="tu@email.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle text-[10px]"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">
                            Asunto <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-escobar-blue/20 focus:border-escobar-blue focus:bg-white transition-all"
                               placeholder="Asunto de tu solicitud">
                        @error('subject')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle text-[10px]"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">
                            Mensaje <span class="text-red-400">*</span>
                        </label>
                        <textarea name="message" id="message" rows="6" required
                                  class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-escobar-blue/20 focus:border-escobar-blue focus:bg-white transition-all resize-none"
                                  placeholder="Describí la información que necesitás...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle text-[10px]"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-escobar-blue text-white px-6 py-3 rounded-lg hover:bg-escobar-blue-dark transition-colors inline-flex items-center justify-center gap-2 font-semibold w-full sm:w-auto text-sm">
                        <i class="fas fa-paper-plane text-xs"></i>
                        Enviar solicitud
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-5">
            <div class="bg-white rounded-xl shadow-sm p-5 sm:p-6 border border-gray-200">
                <h3 class="font-bold font-heading text-base text-gray-800 mb-3">
                    Tu derecho a la información
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-3">
                    Todo ciudadano tiene derecho a solicitar y recibir información pública de los organismos del Estado,
                    según lo establecido por la Ley de Acceso a la Información Pública.
                </p>
                <div class="bg-blue-50 rounded-xl p-3 flex items-start gap-2.5">
                    <i class="fas fa-clock text-escobar-blue text-xs mt-0.5"></i>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        <strong class="text-gray-800">Plazo de respuesta:</strong> 15 días hábiles, prorrogable por otros 15 en casos excepcionales.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-5 sm:p-6 border border-gray-200">
                <h3 class="font-bold font-heading text-base text-gray-800 mb-4">
                    ¿Qué podés solicitar?
                </h3>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li class="flex items-start gap-2.5">
                        <div class="w-5 h-5 rounded-md bg-green-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-escobar-green text-[10px]"></i>
                        </div>
                        <span>Datos estadísticos y registros públicos</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="w-5 h-5 rounded-md bg-green-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-escobar-green text-[10px]"></i>
                        </div>
                        <span>Documentos oficiales y resoluciones</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="w-5 h-5 rounded-md bg-green-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-escobar-green text-[10px]"></i>
                        </div>
                        <span>Información presupuestaria y financiera</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="w-5 h-5 rounded-md bg-green-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-escobar-green text-[10px]"></i>
                        </div>
                        <span>Datos sobre programas y políticas públicas</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="w-5 h-5 rounded-md bg-green-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-check text-escobar-green text-[10px]"></i>
                        </div>
                        <span>Información ambiental y de salud</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
