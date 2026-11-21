<x-layouts.app>
    <div class="space-y-6">
        <section class="rounded-3xl border border-[#a78bfa]/30 bg-gradient-to-br from-[#1a1333] via-[#24174a] to-[#140d2b] p-6 shadow-[0_0_45px_rgba(167,139,250,0.12)]">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">Discover</p>
                    <h2 class="mt-2 text-3xl font-semibold text-white">Find your next squad, game, and vibe</h2>
                    <p class="mt-2 max-w-2xl text-sm text-slate-300">Explore trending games, standout creators, and the communities shaping the next match night.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-300">
                    ✨ Live now · 182 players online
                </div>
            </div>
        </section>

        <div class="grid gap-6 lg:grid-cols-2">
            <section class="rounded-2xl border border-white/10 bg-black/20 p-5">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white">Popular Games</h3>
                    <a href="{{ route('explore') }}" class="text-sm text-cyan-300">View all</a>
                </div>
                <div class="grid gap-3">
                    @foreach($games as $game)
                        <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                            <div>
                                <p class="font-medium text-white">{{ $game->name }}</p>
                                <p class="text-xs text-slate-400">Trending in the community</p>
                            </div>
                            <span class="rounded-full border border-cyan-400/30 bg-cyan-400/10 px-3 py-1 text-xs text-cyan-300">Hot</span>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="rounded-2xl border border-white/10 bg-black/20 p-5">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white">Rising Creators</h3>
                    <a href="{{ route('explore') }}" class="text-sm text-cyan-300">See more</a>
                </div>
                <div class="space-y-3">
                    @foreach($creators as $creator)
                        <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500 text-sm font-semibold text-white">
                                    {{ strtoupper(substr($creator->username, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-white">{{ $creator->username }}</p>
                                    <p class="text-xs text-slate-400">{{ $creator->reputation }} rep</p>
                                </div>
                            </div>
                            <a href="{{ route('profile', $creator->id) }}" class="rounded-full border border-[#a78bfa]/30 px-3 py-1 text-xs text-[#a78bfa]">Visit</a>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <section class="rounded-2xl border border-white/10 bg-black/20 p-5">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">Trending tags</h3>
                <span class="text-sm text-slate-400">Updated live</span>
            </div>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <span class="rounded-full border border-[#a78bfa]/30 bg-[#a78bfa]/10 px-3 py-2 text-sm text-[#d8c8ff]">#{{ $tag->name }}</span>
                @endforeach
            </div>
        </section>
    </div>
</x-layouts.app>
