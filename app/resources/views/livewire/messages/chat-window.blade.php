<div class="flex flex-col h-screen md:h-[600px] bg-black/20 rounded-xl border border-white/10">

    <!-- Header -->
    <div class="flex items-center justify-between gap-3 p-4 border-b border-white/10">
        <div class="flex items-center gap-3">
            @if ($recipient->avatar)
                <img src="{{ asset('storage/' . $recipient->avatar) }}" 
                     alt="{{ $recipient->username }}"
                     class="w-10 h-10 rounded-full object-cover">
            @else
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500"></div>
            @endif
            <div>
                <p class="font-medium text-white">{{ $recipient->username }}</p>
                @if ($recipient->isOnline())
                    <p class="text-xs text-green-400">● online</p>
                @else
                    <p class="text-xs text-gray-500">offline</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Messages Container -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messages-container">

        @forelse ($this->messages as $msg)
            @php $isMine = $msg['sender_id'] === auth()->id(); @endphp

            <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }} gap-2">
                @if (!$isMine)
                    @if ($msg['sender']['avatar'] ?? false)
                        <img src="{{ asset('storage/' . $msg['sender']['avatar']) }}" 
                             alt="{{ $msg['sender']['username'] }}"
                             class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                    @else
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500 flex-shrink-0"></div>
                    @endif
                @endif

                <div class="max-w-[70%]">
                    <div class="px-4 py-2 rounded-2xl text-sm break-words
                        {{ $isMine
                            ? 'bg-[#a78bfa] text-white rounded-br-sm'
                            : 'bg-white/10 text-gray-100 rounded-bl-sm' }}">
                        {{ $msg['content'] }}
                    </div>

                    <div class="text-[11px] text-gray-500 mt-1 
                        {{ $isMine ? 'text-right' : 'text-left' }}">
                        @if (is_array($msg['created_at']) && isset($msg['created_at']['date']))
                            {{ \Carbon\Carbon::parse($msg['created_at']['date'])->format('H:i') }}
                        @else
                            {{ \Carbon\Carbon::parse($msg['created_at'])->format('H:i') }}
                        @endif
                        @if ($isMine)
                            <span class="ml-1">
                                @if ($msg['status'] === 'read')
                                    ✓✓
                                @elseif ($msg['status'] === 'sent')
                                    ✓
                                @else
                                    ⏱
                                @endif
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="flex items-center justify-center h-full">
                <p class="text-sm text-gray-400">No messages yet. Start the conversation!</p>
            </div>
        @endforelse
    </div>

    <!-- Input Form -->
    <form wire:submit.prevent="sendMessage"
          class="flex gap-2 p-4 border-t border-white/10">
        <input
            wire:model="newMessage"
            type="text"
            placeholder="Write a message..."
            class="flex-1 bg-white/5 text-white text-sm rounded-xl px-4 py-2
                   border border-white/10 focus:outline-none focus:border-[#a78bfa]
                   focus:ring-1 focus:ring-[#a78bfa]/30 placeholder-gray-500
                   transition"
            @keydown.enter="$wire.sendMessage()"
        >
        <button type="submit"
                class="px-6 py-2 bg-[#a78bfa] hover:bg-[#9166f6] text-white
                       text-sm font-medium rounded-xl transition flex-shrink-0
                       disabled:opacity-50 disabled:cursor-not-allowed"
                wire:loading.attr="disabled">
            <span wire:loading.remove>Send</span>
            <span wire:loading>...</span>
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('messages-container');
        const scrollToBottom = () => {
            if (container) {
                setTimeout(() => {
                    container.scrollTop = container.scrollHeight;
                }, 50);
            }
        };
        
        // Initial scroll
        scrollToBottom();
        
        // Listen for Livewire updates
        document.addEventListener('livewire:updated', scrollToBottom);
    });
</script>