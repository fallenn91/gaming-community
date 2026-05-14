<div class="flex flex-col gap-2">

  <button wire:click="toggleLibrary"
    class="px-4 py-2 rounded-lg bg-[#6366f1] hover:bg-[#ddd6fe] hover:text-black transition">
    {{ $userGame ? 'Remove from library' : 'Add to library' }}
  </button>

  @if ($userGame && $showStatuses)
      <div class="flex gap-2 text-xs">

        <button wire:click="setStatus('playing')"
          class="{{ $userGame->pivot->status === 'playing' ? 'text-cyan-300' : 'text-gray-400' }}">
          Playing
        </button>

        <button wire:click="setStatus('completed')"
          class="{{ $userGame->pivot->status === 'completed' ? 'text-green-400' : 'text-gray-400' }}">
          Completed
        </button>

        <button wire:click="setStatus('wishlist')"
          class="{{ $userGame->pivot->status === 'wishlist' ? 'text-purple-300' : 'text-gray-400' }}">
          Wishlist
        </button>

        <button wire:click="setStatus('dropped')"
          class="{{ $userGame->pivot->status === 'dropped' ? 'text-red-400' : 'text-gray-400' }}">
          Dropped
        </button>

      </div>
  @endif
</div>