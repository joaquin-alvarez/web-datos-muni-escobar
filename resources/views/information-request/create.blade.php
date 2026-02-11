@extends('layouts.app')

@section('title', 'Solicitar Información')

@section('content')
<div class="gradient-blue text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-paper-plane text-4xl"></i>
            </div>
            <div>
                <h1 class="text-5xl font-bold font-heading mb-2 text-shadow">Solicitar Información</h1>
                <p class="text-xl text-blue-50 font-light">Enviá tu solicitud de información pública</p>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-escobar-green via-white to-escobar-green opacity-50"></div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-6 flex items-start gap-3">
                    <i class="fas fa-check-circle text-green-500 text-2xl mt-0.5"></i>
                    <div>
                        <h3 class="font-bold text-green-800 font-heading">¡Solicitud enviada!</h3>
                        <p class="text-green-700 text-sm mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-xl p-8 border border-gray-100">
                <h2 class="text-2xl font-bold font-heading text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-edit text-escobar-blue"></i>
                    Formulario de solicitud
                </h2>

                <form action="{{ route('information-request.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nombre completo <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-escobar-blue focus:border-escobar-blue transition-all"
                               placeholder="Ingresá tu nombre completo">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Correo electrónico <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-escobar-blue focus:border-escobar-blue transition-all"
                               placeholder="tu@email.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                            Asunto <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-escobar-blue focus:border-escobar-blue transition-all"
                               placeholder="Asunto de tu solicitud">
                        @error('subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                            Mensaje <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" id="message" rows="6" required
                                  class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-escobar-blue focus:border-escobar-blue transition-all resize-none"
                                  placeholder="Describí la información que necesitás...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="gradient-blue text-white px-8 py-3 rounded-xl hover:shadow-xl transition-all inline-flex items-center gap-2 font-bold hover:scale-105">
                        <i class="fas fa-paper-plane"></i>
                        Enviar solicitud
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 mb-6 shadow-lg border border-blue-200">
                <h3 class="font-bold font-heading text-lg text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-escobar-blue text-xl"></i>
                    Sobre tu derecho a la información
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Todo ciudadano tiene derecho a solicitar y recibir información pública de los organismos del Estado, 
                    según lo establecido por la Ley de Acceso a la Información Pública.
                </p>
                <p class="text-gray-600 text-sm leading-relaxed">
                    El plazo de respuesta es de 15 días hábiles, prorrogable por otros 15 días en casos excepcionales.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="font-bold font-heading text-lg text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-question-circle text-escobar-green text-xl"></i>
                    ¿Qué podés solicitar?
                </h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-escobar-green mt-1"></i>
                        <span>Datos estadísticos y registros públicos</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-escobar-green mt-1"></i>
                        <span>Documentos oficiales y resoluciones</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-escobar-green mt-1"></i>
                        <span>Información presupuestaria y financiera</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-escobar-green mt-1"></i>
                        <span>Datos sobre programas y políticas públicas</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-escobar-green mt-1"></i>
                        <span>Información ambiental y de salud</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
