<div class="w-full flex-col">
  <div class="w-full mb-4">
    <input type="text" wire:model.live="search" placeholder="Buscar juego..." class="bg-black/30 px-3 py-1 rounded text-sm border border-[#a78bfa]  focus:ring-2 focus:ring-[#a78bfa]"/>
  </div>
  <div class="w-full grid grid-cols-3 gap-3">
    @foreach ($games as $game)
     <div class="game-card">
      <livewire:games.game-actions :game="$game" />
       <div>
         <img src="" alt="">
       </div>
       <div class="flex flex-col gap-3">
         {{ $game->name }}
         {{ $game->description }}
         <span class="game-slug">{{ $game->slug }}</span>
         <p class="text-cyan-400">{{ $game->pivot?->status }}</p>
       </div>
     </div>
   @endforeach
  </div>
</div>