@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navegación de paginación" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex h-max items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default leading-5 rounded-lg">
                    <i class="fas fa-chevron-left mr-2"></i>
                    Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white gradient-blue border border-transparent leading-5 rounded-lg hover:shadow-lg transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-escobar-blue">
                    <i class="fas fa-chevron-left mr-2"></i>
                    Anterior
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-semibold text-white gradient-blue border border-transparent leading-5 rounded-lg hover:shadow-lg transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-escobar-blue">
                    Siguiente
                    <i class="fas fa-chevron-right ml-2"></i>
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default leading-5 rounded-lg">
                    Siguiente
                    <i class="fas fa-chevron-right ml-2"></i>
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-600 leading-5">
                    Mostrando
                    <span class="font-bold text-escobar-blue">{{ $paginator->firstItem() }}</span>
                    a
                    <span class="font-bold text-escobar-blue">{{ $paginator->lastItem() }}</span>
                    de
                    <span class="font-bold text-escobar-blue">{{ $paginator->total() }}</span>
                    resultados
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-lg">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-lg leading-5" aria-hidden="true">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-white gradient-blue border border-transparent rounded-l-lg leading-5 hover:shadow-lg transition-all duration-300 hover:scale-105 focus:z-10 focus:outline-none focus:ring-2 focus:ring-escobar-blue" aria-label="@lang('pagination.previous')">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-bold text-white gradient-blue border border-transparent cursor-default leading-5 shadow-md">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-semibold text-gray-700 bg-white border border-gray-300 leading-5 hover:bg-blue-50 hover:text-escobar-blue transition-all duration-200 focus:z-10 focus:outline-none focus:ring-2 focus:ring-escobar-blue" aria-label="Ir a la página {{ $page }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-semibold text-white gradient-blue border border-transparent rounded-r-lg leading-5 hover:shadow-lg transition-all duration-300 hover:scale-105 focus:z-10 focus:outline-none focus:ring-2 focus:ring-escobar-blue" aria-label="@lang('pagination.next')">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-r-lg leading-5" aria-hidden="true">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
