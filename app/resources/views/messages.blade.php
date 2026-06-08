<x-layouts.app>
    <div class="grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-6 h-[calc(100vh-140px)]">
        
        <!-- Conversations List Sidebar -->
        <div class="hidden lg:flex flex-col bg-black/20 rounded-xl border border-white/10 overflow-hidden">
            <div class="p-4 border-b border-white/10">
                <h2 class="text-lg font-semibold text-white">Messages</h2>
                <p class="text-xs text-gray-400 mt-1">Direct messages</p>
            </div>
            <div class="flex-1 overflow-y-auto">
                <livewire:messages.conversation-list />
            </div>
        </div>

        <!-- Chat Window -->
        <div class="flex flex-col">
            @if ($recipient)
                <livewire:messages.chat-window :recipient="$recipient" />
            @else
                <div class="flex-1 flex items-center justify-center bg-black/20 rounded-xl border border-white/10">
                    <div class="text-center">
                        <div class="text-5xl mb-4">💬</div>
                        <h3 class="text-xl font-semibold text-white mb-2">No conversation selected</h3>
                        <p class="text-gray-400 mb-4">Select a conversation to start chatting</p>
                        <a href="{{ route('messages.index') }}" class="inline-block px-6 py-2 bg-[#a78bfa] hover:bg-[#9166f6] text-white rounded-xl transition">
                            View conversations
                        </a>
                    </div>
                </div>
            @endif
        </div>

    </div>

    <!-- Mobile view - Tab selector -->
    <div class="lg:hidden flex gap-2 mb-4">
        <button class="tab-btn flex-1 py-2 px-4 bg-[#a78bfa] text-white rounded-xl text-sm font-medium transition" data-tab="conversations">
            Conversations
        </button>
        <button class="tab-btn flex-1 py-2 px-4 bg-white/10 text-gray-300 rounded-xl text-sm font-medium transition hover:bg-white/20" data-tab="chat">
            Chat
        </button>
    </div>

    <!-- Mobile view - Conversations panel -->
    <div id="conversations-tab" class="lg:hidden bg-black/20 rounded-xl border border-white/10 overflow-hidden">
        <div class="p-4 border-b border-white/10">
            <h2 class="text-lg font-semibold text-white">Messages</h2>
        </div>
        <div class="max-h-[400px] overflow-y-auto">
            <livewire:messages.conversation-list />
        </div>
    </div>

    <!-- Mobile view - Chat panel -->
    @if ($recipient)
        <div id="chat-tab" class="hidden lg:hidden">
            <livewire:messages.chat-window :recipient="$recipient" />
        </div>
    @endif

    <script>
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const tab = e.target.dataset.tab;
                
                document.querySelectorAll('.tab-btn').forEach(b => {
                    b.classList.remove('bg-[#a78bfa]', 'text-white');
                    b.classList.add('bg-white/10', 'text-gray-300');
                });
                
                e.target.classList.add('bg-[#a78bfa]', 'text-white');
                e.target.classList.remove('bg-white/10', 'text-gray-300');
                
                document.getElementById('conversations-tab').classList.toggle('hidden', tab !== 'conversations');
                if (document.getElementById('chat-tab')) {
                    document.getElementById('chat-tab').classList.toggle('hidden', tab !== 'chat');
                }
            });
        });
    </script>
</x-layouts.app>