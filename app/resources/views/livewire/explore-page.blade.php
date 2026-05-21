<div class="space-y-6">

    <!-- TABS -->
    <div class="flex gap-4 text-sm border-b border-white/10 pb-2">

        <button
            wire:click="setTab('games')"
            class="{{ $tab === 'games' ? 'text-cyan-400 border-b border-cyan-400' : 'text-gray-400' }}"
        >
            Games
        </button>

        <button
            wire:click="setTab('users')"
            class="{{ $tab === 'users' ? 'text-cyan-400 border-b border-cyan-400' : 'text-gray-400' }}"
        >
            Users
        </button>
        <button
            wire:click="setTab('posts')"
            class="{{ $tab === 'posts' ? 'text-cyan-400 border-b border-cyan-400' : 'text-gray-400' }}"
        >
            Posts
        </button>

    </div>

    <!-- CONTENT -->

    @if($tab === 'games')

        <div class="grid grid-cols-3 gap-3">
            @foreach($games as $game)
                <div class="game-card">
                    {{ $game->name }}
                </div>
            @endforeach
        </div>

    @endif

    @if($tab === 'users')

        <div class="grid grid-cols-3 gap-3">
            @foreach($users as $user)
                <a href="{{ route('profile', $user) }}" class="text-cyan-300">
                    {{ $user->username }}
                </a>
            @endforeach
        </div>

    @endif
    @if($tab === 'posts')

        
            <livewire:feed.post-feed />
        

    @endif

</div>