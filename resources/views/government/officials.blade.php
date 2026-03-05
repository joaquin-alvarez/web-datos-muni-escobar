@extends('layouts.app')

@section('title', 'Funcionarios')

@section('content')
<!-- Page Header -->
<div class="gradient-blue text-white py-8 sm:py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-heading mb-1">Funcionarios</h1>
        <p class="text-sm sm:text-base text-blue-100">Lista de funcionarios del Municipio de Escobar</p>
    </div>
</div>

<div class="container mx-auto px-4 py-6 sm:py-8">
    <!-- Counter -->
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-5 mb-6 border border-gray-200">
        <div class="flex items-center gap-3">
            <span class="font-bold font-heading text-2xl text-escobar-blue">{{ $officials->count() }}</span>
            <span class="text-sm text-gray-500">funcionarios registrados</span>
        </div>
    </div>

    <!-- Desktop Table View -->
    <div class="hidden lg:block bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left font-heading font-bold text-xs uppercase tracking-wider text-gray-500">Funcionario</th>
                        <th class="px-6 py-4 text-left font-heading font-bold text-xs uppercase tracking-wider text-gray-500">Cargo</th>
                        <th class="px-6 py-4 text-left font-heading font-bold text-xs uppercase tracking-wider text-gray-500">Categoría</th>
                        <th class="px-6 py-4 text-left font-heading font-bold text-xs uppercase tracking-wider text-gray-500">Área</th>
                        <th class="px-6 py-4 text-left font-heading font-bold text-xs uppercase tracking-wider text-gray-500">Contacto</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($officials as $official)
                        <tr class="hover:bg-blue-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $official->photo_url }}"
                                         alt="{{ $official->name }}"
                                         class="w-10 h-10 rounded-xl object-cover shadow-sm border border-gray-200">
                                    <span class="font-semibold text-gray-800 text-sm">{{ $official->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 font-medium text-sm">{{ $official->position }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center bg-blue-50 text-escobar-blue px-3 py-1 rounded-lg text-xs font-bold">
                                    {{ $official->rank }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ $official->area }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1.5 text-xs">
                                    <a href="mailto:{{ $official->email }}" class="text-escobar-blue hover:text-escobar-blue-light flex items-center gap-1.5 transition-colors">
                                        <i class="fas fa-envelope text-[10px]"></i>
                                        {{ $official->email }}
                                    </a>
                                    <span class="text-gray-400 flex items-center gap-1.5">
                                        <i class="fas fa-phone text-[10px]"></i>
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

    <!-- Mobile Card View -->
    <div class="lg:hidden space-y-3 stagger-children">
        @foreach($officials as $official)
            <div class="bg-white rounded-xl shadow-sm p-4 sm:p-5 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-3 sm:gap-4 mb-3">
                    <img src="{{ $official->photo_url }}"
                         alt="{{ $official->name }}"
                         class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl object-cover shadow-sm border border-gray-200 flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-800 text-base mb-0.5">{{ $official->name }}</h3>
                        <p class="text-gray-500 font-medium text-sm">{{ $official->position }}</p>
                    </div>
                </div>

                <div class="space-y-2 text-xs sm:text-sm bg-gray-50 rounded-xl p-3">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-400 font-semibold min-w-[72px]">Categoría</span>
                        <span class="inline-flex items-center bg-blue-50 text-escobar-blue px-2.5 py-0.5 rounded-lg text-xs font-bold">
                            {{ $official->rank }}
                        </span>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="text-gray-400 font-semibold min-w-[72px]">Área</span>
                        <span class="text-gray-700 text-xs">{{ $official->area }}</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="text-gray-400 font-semibold min-w-[72px]">Email</span>
                        <a href="mailto:{{ $official->email }}" class="text-escobar-blue hover:text-escobar-blue-light text-xs truncate flex-1">
                            {{ $official->email }}
                        </a>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-400 font-semibold min-w-[72px]">Teléfono</span>
                        <span class="text-gray-700 text-xs">{{ $official->phone }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 bg-gray-50 p-5 rounded-xl border-l-4 border-escobar-blue">
        <p class="text-gray-500 text-xs sm:text-sm flex items-start gap-2">
            <i class="fas fa-info-circle text-escobar-blue mt-0.5"></i>
            <span><strong class="text-gray-700">Nota:</strong> La lista incluye funcionarios hasta el nivel de Secretarios, según lo establecido por la normativa vigente.</span>
        </p>
    </div>
</div>
@endsection
