<div class="space-y-1">
    
    @foreach ($conversations as $conversation)
        @php 
          $other = $conversation->user;
          $last = $conversation->last_message;
        @endphp
        
        <a href="{{ route('messages.show', $other) }}"
           class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5
                  transition cursor-pointer border border-transparent
                  hover:border-white/10 group">
                    
            <!-- Avatar con indicador online -->
            <div class="relative flex-shrink-0">
                @if ($other->avatar)
                    <img src="{{ asset('storage/' . $other->avatar) }}" 
                         alt="{{ $other->username }}"
                         class="w-10 h-10 rounded-full object-cover">
                @else
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500"></div>
                @endif
                
                @if ($other->isOnline())
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border border-black/30"></span>
                @endif
            </div>
            
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2">
                    <p class="text-sm font-medium text-white truncate group-hover:text-[#a78bfa] transition">
                        {{ $other->username }}
                    </p>
                    <span class="text-[10px] text-gray-500 flex-shrink-0">
                        {{ $last?->created_at->diffForHumans(short: true) }}
                    </span>
                </div>
                <p class="text-xs text-gray-400 truncate">
                    @if ($last?->sender_id === auth()->id())
                        <span class="text-[#a78bfa]">You:</span>
                    @endif
                    {{ $last?->content }}
                </p>
            </div>
        </a>
    @endforeach
</div>