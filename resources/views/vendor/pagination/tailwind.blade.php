@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navegación de paginación" class="flex items-center justify-between">
        <!-- Mobile -->
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-default rounded-xl">
                    <i class="fas fa-chevron-left mr-2 text-xs"></i>Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white gradient-blue rounded-xl hover:shadow-lg transition-all hover:scale-[1.03]">
                    <i class="fas fa-chevron-left mr-2 text-xs"></i>Anterior
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center px-5 py-2.5 ml-3 text-sm font-semibold text-white gradient-blue rounded-xl hover:shadow-lg transition-all hover:scale-[1.03]">
                    Siguiente<i class="fas fa-chevron-right ml-2 text-xs"></i>
                </a>
            @else
                <span class="inline-flex items-center px-5 py-2.5 ml-3 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-default rounded-xl">
                    Siguiente<i class="fas fa-chevron-right ml-2 text-xs"></i>
                </span>
            @endif
        </div>

        <!-- Desktop -->
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <p class="text-sm text-gray-500">
                Mostrando
                <span class="font-bold text-gray-800">{{ $paginator->firstItem() }}</span>
                a
                <span class="font-bold text-gray-800">{{ $paginator->lastItem() }}</span>
                de
                <span class="font-bold text-escobar-blue">{{ $paginator->total() }}</span>
                resultados
            </p>

            <div class="inline-flex items-center gap-1">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <span class="w-10 h-10 inline-flex items-center justify-center text-gray-300 bg-gray-50 border border-gray-200 cursor-default rounded-xl text-sm">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-10 h-10 inline-flex items-center justify-center text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-blue-50 hover:text-escobar-blue hover:border-escobar-blue/30 transition-all text-sm" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </a>
                @endif

                {{-- Pages --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="w-10 h-10 inline-flex items-center justify-center text-gray-400 text-sm font-medium">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="w-10 h-10 inline-flex items-center justify-center text-white gradient-blue rounded-xl text-sm font-bold shadow-md">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="w-10 h-10 inline-flex items-center justify-center text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-blue-50 hover:text-escobar-blue hover:border-escobar-blue/30 transition-all text-sm font-medium" aria-label="Ir a la página {{ $page }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-10 h-10 inline-flex items-center justify-center text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-blue-50 hover:text-escobar-blue hover:border-escobar-blue/30 transition-all text-sm" aria-label="@lang('pagination.next')">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </a>
                @else
                    <span class="w-10 h-10 inline-flex items-center justify-center text-gray-300 bg-gray-50 border border-gray-200 cursor-default rounded-xl text-sm">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
