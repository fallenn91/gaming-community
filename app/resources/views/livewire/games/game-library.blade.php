<div>

    <!-- TABS -->
    <div class="flex gap-3 mb-4 text-sm">

        <button wire:click="$set('filter', 'playing')" class="{{ $filter === 'playing' ? 'text-cyan-400' : 'text-gray-400' }}"
    wire:click="$set('filter', 'playing')">

            Playing
        </button>

        <button wire:click="$set('filter', 'completed')" class="{{ $filter === 'completed' ? 'text-cyan-400' : 'text-gray-400' }}"
    wire:click="$set('filter', 'completed')">

            Completed
        </button>

        <button wire:click="$set('filter', 'wishlist')" class="{{ $filter === 'wishlist' ? 'text-cyan-400' : 'text-gray-400' }}"
    wire:click="$set('filter', 'wishlist')">

            Wishlist
        </button>

        <button wire:click="$set('filter', 'dropped')" class="{{ $filter === 'dropped' ? 'text-cyan-400' : 'text-gray-400' }}"
    wire:click="$set('filter', 'dropped')">

            Dropped
        </button>

    </div>

    <!-- LISTA -->
    <div class="grid grid-cols-3 gap-3">

        @forelse ($this->games as $game)
            <div class="game-card">
                <div>{{ $game->name }}</div>
                <div class="text-xs opacity-70">
                    {{ $game->pivot->status }}
                </div>
            </div>
        @empty
            <p class="text-gray-400">No games in this category</p>
        @endforelse

    </div>

</div>