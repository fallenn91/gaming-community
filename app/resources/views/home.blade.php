<x-layouts.app>
  <div class="w-full h-[250px] bg-gradient-to-br from-[#1a1333] to-[#0f0a24] relative overflow-hidden flex items-center justify-center">
    <!-- Glow circles -->
    <div class="absolute w-72 h-72 bg-[#a78bfa]/25 blur-3xl rounded-full top-[-50px] left-[-50px]"></div>
    <div class="absolute w-72 h-72 bg-fuchsia-500/25 blur-3xl rounded-full bottom-[-50px] right-[-50px]"></div>
    <!-- Content -->
    <div class="text-center z-10">
      <h1 class="text-4xl font-bold text-[#a78bfa] tracking-widest"
          style="text-shadow: 0 0 20px #a78bfa;">
        CYBERCOMM
      </h1>
      <p class="text-gray-400 text-sm mt-2">
        CONNECT • PLAY • EVOLVE
      </p>
    </div>
  </div>
  <div class="bg-black/20 rounded-xl p-4 border border-white/5">
  <h3 class="text-[#a78bfa] mb-3 text-sm">🔥 Trending</h3>
  <div class="flex gap-2 overflow-x-auto text-xs">
    @foreach($tags as $tag)
    <span class="px-3 py-1 border border-[#a78bfa]/20 rounded">#{{ $tag->name }}</span>
    @endforeach
  </div>
</div>
<div class="flex gap-2 text-xs">
  <button class="px-3 py-1 bg-[#a78bfa]/20 rounded">🎮 Find match</button>
  <button class="px-3 py-1 bg-[#a78bfa]/20 rounded">👥 Find teammates</button>
  <button class="px-3 py-1 bg-[#a78bfa]/20 rounded">📢 Create post</button>
</div>
<div class="bg-black/20 rounded-xl p-4 border border-white/5">
  <h3 class="text-[#a78bfa] text-sm mb-2">🎮 Play Today</h3>
  <p class="text-xs text-gray-400">Valorant • CS2 • Elden Ring</p>
</div>
<div class="bg-black/20 rounded-xl p-4 border border-[#a78bfa]/20">
  <p class="text-xs text-[#a78bfa] mb-2">🔥 Featured today</p>
  <p class="text-sm">
    Welcome to CYBERCOMM — the new gaming hub for players & creators 🚀
  </p>
</div>
  <livewire:feed.create-post />
  <livewire:user.presence />
  <livewire:feed.post-feed />
</x-layouts.app>