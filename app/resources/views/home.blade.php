<x-layouts.app>

  {{-- HERO BANNER --}}
  
  <div class="w-full h-[250px] relative overflow-hidden flex items-center justify-center"
       style="background: linear-gradient(135deg, #100828 0%, #1e0f45 50%, #100828 100%);">
    <div class="absolute w-72 h-72 rounded-full top-[-50px] left-[-50px]"
         style="background:radial-gradient(circle, rgba(139,92,246,0.45) 0%, transparent 70%); filter:blur(48px);"></div>
    <div class="absolute w-72 h-72 rounded-full bottom-[-50px] right-[-50px]"
         style="background:radial-gradient(circle, rgba(217,70,239,0.4) 0%, transparent 70%); filter:blur(48px);"></div>
    <div class="text-center z-10">
      <h1 class="text-4xl font-bold tracking-widest"
          style="color: var(--primary-light); text-shadow: 0 0 24px var(--glow-primary), 0 0 60px rgba(139,92,246,0.3);">
        CYBERCOMM
      </h1>
      <p class="text-sm mt-2" style="color: rgba(221,214,254,0.5);">
        CONNECT • PLAY • EVOLVE
      </p>
    </div>
  </div>
  
  {{-- TRENDING TAGS --}}
  <div class="rounded-xl p-4"
       style="background: var(--fondo-card); backdrop-filter: blur(16px); border: 1px solid rgba(139,92,246,0.3);">
    <h3 class="text-sm mb-3" style="color: var(--primary-light);">🔥 Trending</h3>
    <div class="flex gap-2 overflow-x-auto text-xs">
      @foreach($tags as $tag)
        <span class="px-3 py-1 rounded whitespace-nowrap"
              style="border: 1px solid rgba(139,92,246,0.35); color: var(--primary-light); background: rgba(139,92,246,0.08);">
          #{{ $tag->name }}
        </span>
      @endforeach
    </div>
  </div>

  {{-- PLAY TODAY --}}
  <div class="rounded-xl p-4"
       style="background: var(--fondo-card); backdrop-filter: blur(16px); border: 1px solid rgba(139,92,246,0.3);">
    <h3 class="text-sm mb-2" style="color: var(--primary-light);">🎮 Play Today</h3>
    <p class="text-xs" style="color: rgba(221,214,254,0.5);">Valorant • CS2 • Elden Ring</p>
  </div>

  {{-- FEATURED --}}
  <div class="rounded-xl p-4"
       style="background: rgba(139,92,246,0.08); backdrop-filter: blur(16px); border: 1px solid rgba(139,92,246,0.45); box-shadow: 0 0 30px rgba(139,92,246,0.1) inset;">
    <p class="text-xs mb-2" style="color: var(--primary-light);">🔥 Featured today</p>
    <p class="text-sm" style="color: var(--blanco);">
      Welcome to CYBERCOMM — the new gaming hub for players &amp; creators 🚀
    </p>
  </div>
  
  <livewire:feed.create-post />
  <livewire:user.presence />
  <livewire:feed.post-feed />

</x-layouts.app>