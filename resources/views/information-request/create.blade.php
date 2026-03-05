@extends('layouts.app')

@section('title', 'Solicitar Información')

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
                    <i class="fas fa-paper-plane text-2xl sm:text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-heading text-shadow-lg">Solicitar Información</h1>
                    <p class="text-sm sm:text-base lg:text-lg text-blue-100 font-light mt-1">Enviá tu solicitud de información pública</p>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 40" fill="none" class="w-full"><path d="M0 40V20C240 0 480 0 720 10C960 20 1200 30 1440 20V40H0Z" fill="#f9fafb"/></svg>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8 lg:py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
        <!-- Form -->
        <div class="lg:col-span-2 animate-fade-in-up">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-2xl p-5 mb-6 flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-green-800 font-heading text-sm">¡Solicitud enviada!</h3>
                        <p class="text-green-700 text-xs sm:text-sm mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-lg p-5 sm:p-7 lg:p-9 border border-gray-100">
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

                    <button type="submit" class="gradient-blue text-white px-7 py-3.5 rounded-xl hover:shadow-lg hover:shadow-escobar-blue/25 transition-all inline-flex items-center justify-center gap-2.5 font-bold hover:scale-[1.03] w-full sm:w-auto text-sm">
                        <i class="fas fa-paper-plane text-xs"></i>
                        Enviar solicitud
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-5 animate-fade-in-up delay-200">
            <div class="bg-white rounded-2xl shadow-lg p-5 sm:p-6 border border-gray-100">
                <div class="w-11 h-11 rounded-xl gradient-blue flex items-center justify-center shadow-md mb-4">
                    <i class="fas fa-shield-alt text-white text-sm"></i>
                </div>
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

            <div class="bg-white rounded-2xl shadow-lg p-5 sm:p-6 border border-gray-100">
                <div class="w-11 h-11 rounded-xl gradient-green flex items-center justify-center shadow-md mb-4">
                    <i class="fas fa-list-check text-white text-sm"></i>
                </div>
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
