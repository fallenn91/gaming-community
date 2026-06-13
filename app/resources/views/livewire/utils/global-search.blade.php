<div class="relative w-full max-w-sm">
    <input
        type="text"
        wire:model.live.debounce.300ms="search"
        wire:keydown.escape="$set('search', '')"
        placeholder="Search gamers..."
        class="w-full bg-black/30 px-3 py-1 rounded text-sm border border-[#a78bfa] focus:ring-2 focus:ring-[#a78bfa]"
    />

    {{-- DROPDOWN --}}
    @if(!empty($results) && strlen($search) > 0)
        <div class="absolute left-0 right-0 mt-2 w-full bg-black/70 backdrop-blur-md border border-[#a78bfa]/30 rounded-xl shadow-lg z-[9999] overflow-hidden">

            @forelse($results as $result)
                <a
                    href="{{ url($result['url']) }}"
                    class="flex items-center gap-3 px-3 py-2 hover:bg-[#a78bfa]/10 transition"
                >

                    {{-- ICON --}}
                    <div class="text-lg">
                        @if($result['type'] === 'Game')
                            🎮
                        @elseif($result['type'] === 'User')
                            👤
                        @else
                            🌍
                        @endif
                    </div>

                    {{-- TEXT --}}
                    <div class="flex flex-col">
                        <span class="text-sm text-white">{{ $result['title'] }}</span>
                        <span class="text-xs text-gray-400">{{ $result['type'] }}</span>
                    </div>

                </a>
            @empty
                <div class="px-3 py-2 text-sm text-gray-400">
                    No results found
                </div>
            @endforelse

        </div>
    @endif
</div>
