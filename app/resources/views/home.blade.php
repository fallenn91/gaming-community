<x-layouts.app>
  <div class="space-y-5">
    <section class="overflow-hidden rounded-[28px] border border-[#a78bfa]/30 bg-gradient-to-br from-[#130f2a] via-[#24174a] to-[#100a22] p-6 shadow-[0_0_50px_rgba(167,139,250,0.16)]">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="max-w-2xl">
          <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">Welcome back</p>
          <h1 class="mt-2 text-3xl font-semibold text-white sm:text-4xl">Your gaming universe is ready to grow</h1>
          <p class="mt-3 text-sm text-slate-300">Create posts, join guilds, discover new games, and stay close to the creators you love.</p>
        </div>
        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-200">
          🎮 3 live rooms · 12 fresh posts
        </div>
      </div>
    </section>

    <div class="grid gap-4 lg:grid-cols-3">
      <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
        <p class="text-sm font-semibold text-[#a78bfa]">⚡ Quick actions</p>
        <div class="mt-3 flex flex-wrap gap-2">
          <a href="{{ route('discover') }}" class="rounded-full border border-cyan-400/30 bg-cyan-400/10 px-3 py-2 text-sm text-cyan-300">Discover</a>
          <a href="{{ route('events') }}" class="rounded-full border border-[#a78bfa]/30 bg-[#a78bfa]/10 px-3 py-2 text-sm text-[#d8c8ff]">Events</a>
          <a href="{{ route('community') }}" class="rounded-full border border-white/10 px-3 py-2 text-sm text-slate-300">Guilds</a>
        </div>
      </div>

      <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
        <p class="text-sm font-semibold text-[#a78bfa]">🔥 Trending tags</p>
        <div class="mt-3 flex flex-wrap gap-2">
          @foreach($tags as $tag)
            <span class="rounded-full border border-[#a78bfa]/20 bg-[#a78bfa]/10 px-3 py-1 text-xs text-[#d8c8ff]">#{{ $tag->name }}</span>
          @endforeach
        </div>
      </div>

      <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
        <p class="text-sm font-semibold text-[#a78bfa]">🎮 Play today</p>
        <p class="mt-2 text-sm text-slate-300">Valorant • CS2 • Elden Ring • Minecraft</p>
      </div>
    </div>

    <livewire:feed.create-post />
    <livewire:user.presence />
    <livewire:feed.post-feed />
  </div>
</x-layouts.app>