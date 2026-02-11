@extends('layouts.app')

@section('title', 'Funcionarios')

@section('content')
<div class="gradient-blue text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-id-card text-4xl"></i>
            </div>
            <div>
                <h1 class="text-5xl font-bold font-heading mb-2 text-shadow">Funcionarios</h1>
                <p class="text-xl text-blue-50 font-light">Lista de funcionarios del Municipio de Escobar</p>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-escobar-green via-white to-escobar-green opacity-50"></div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
        <div class="flex items-center justify-between">
            <div class="text-gray-600">
                <span class="font-bold font-heading text-3xl text-escobar-blue">{{ $officials->count() }}</span>
                <span class="text-sm ml-2">funcionarios registrados</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="gradient-blue text-white">
                        <th class="px-6 py-4 text-left font-heading font-bold text-sm uppercase tracking-wider">Funcionario</th>
                        <th class="px-6 py-4 text-left font-heading font-bold text-sm uppercase tracking-wider">Cargo</th>
                        <th class="px-6 py-4 text-left font-heading font-bold text-sm uppercase tracking-wider">Categoría</th>
                        <th class="px-6 py-4 text-left font-heading font-bold text-sm uppercase tracking-wider">Área</th>
                        <th class="px-6 py-4 text-left font-heading font-bold text-sm uppercase tracking-wider">Contacto</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($officials as $official)
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $official->photo_url }}" 
                                         alt="{{ $official->name }}" 
                                         class="w-10 h-10 rounded-full object-cover shadow-md">
                                    <span class="font-semibold text-gray-800">{{ $official->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700 font-medium">{{ $official->position }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block bg-blue-100 text-escobar-blue px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $official->rank }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $official->area }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1 text-sm">
                                    <a href="mailto:{{ $official->email }}" class="text-escobar-blue hover:text-escobar-blue-light flex items-center gap-1">
                                        <i class="fas fa-envelope text-xs"></i>
                                        {{ $official->email }}
                                    </a>
                                    <span class="text-gray-500 flex items-center gap-1">
                                        <i class="fas fa-phone text-xs"></i>
                                        {{ $official->phone }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 bg-gradient-to-r from-blue-50 to-transparent p-6 rounded-xl border-l-4 border-escobar-blue">
        <p class="text-gray-600 text-sm">
            <i class="fas fa-info-circle text-escobar-blue mr-2"></i>
            <strong>Nota:</strong> La lista incluye funcionarios hasta el nivel de Secretarios, según lo establecido por la normativa vigente.
        </p>
    </div>
</div>
@endsection
