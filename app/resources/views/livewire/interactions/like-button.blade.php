<div>
  <button wire:click="toggleLike" class=" {{ $this->hasLiked ? 'text-pink-500' : 'text-gray-400' }} cursor-pointer">

    ❤️ {{ $this->likes->count() }}
  </button>
</div>
