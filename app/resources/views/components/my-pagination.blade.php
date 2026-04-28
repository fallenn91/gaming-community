@if ($paginator->hasPages())
<nav class="flex items-center justify-center gap-1 mt-6 flex-wrap">

    {{-- Anterior --}}
    @if ($paginator->onFirstPage())
        <span class="px-3 py-1.5 text-sm text-gray-600 border border-[#a78bfa]/20 rounded-md cursor-not-allowed">
            ← Prev
        </span>
    @else
        <button wire:click="previousPage" wire:loading.attr="disabled"
            class="px-3 py-1.5 text-sm text-gray-300 border border-[#a78bfa]/20 rounded-md hover:border-[#a78bfa]/50 hover:text-[#a78bfa] transition-colors">
            ← Prev
        </button>
    @endif

    {{-- Números --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="px-2 py-1.5 text-sm text-gray-500">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="px-3 py-1.5 text-sm font-medium text-[#a78bfa] border border-[#a78bfa] bg-[#a78bfa]/15 rounded-md">
                        {{ $page }}
                    </span>
                @else
                    <button wire:click="gotoPage({{ $page }})"
                        class="px-3 py-1.5 text-sm text-gray-300 border border-[#a78bfa]/20 rounded-md hover:border-[#a78bfa]/50 hover:text-[#a78bfa] transition-colors">
                        {{ $page }}
                    </button>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Siguiente --}}
    @if ($paginator->hasMorePages())
        <button wire:click="nextPage" wire:loading.attr="disabled"
            class="px-3 py-1.5 text-sm text-gray-300 border border-[#a78bfa]/20 rounded-md hover:border-[#a78bfa]/50 hover:text-[#a78bfa] transition-colors">
            Next →
        </button>
    @else
        <span class="px-3 py-1.5 text-sm text-gray-600 border border-[#a78bfa]/20 rounded-md cursor-not-allowed">
            Next →
        </span>
    @endif

</nav>
@endif