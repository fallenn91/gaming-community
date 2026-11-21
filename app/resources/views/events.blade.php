<x-layouts.app>
    <div class="space-y-6">
        <section class="rounded-3xl border border-cyan-400/20 bg-gradient-to-br from-[#0d132b] via-[#111c3d] to-[#0c1428] p-6 shadow-[0_0_45px_rgba(34,211,238,0.14)]">
            <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">Events</p>
            <h2 class="mt-2 text-3xl font-semibold text-white">Your next match, meetup, or launch is here</h2>
            <p class="mt-2 max-w-2xl text-sm text-slate-300">Stay close to the community with tournaments, creator sessions, and live drops curated for your favorites.</p>
        </section>

        <div class="grid gap-4">
            @foreach($events as $event)
                <article class="rounded-2xl border border-white/10 bg-black/20 p-5 backdrop-blur">
                    <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <div class="mb-2 flex items-center gap-2 text-sm text-cyan-300">
                                <span class="rounded-full border border-cyan-400/30 bg-cyan-400/10 px-2 py-1">{{ $event['type'] }}</span>
                                <span class="text-slate-400">{{ $event['date'] }}</span>
                            </div>
                            <h3 class="text-xl font-semibold text-white">{{ $event['title'] }}</h3>
                            <p class="mt-2 text-sm text-slate-300">{{ $event['description'] }}</p>
                        </div>
                        <button class="rounded-full border border-[#a78bfa]/30 bg-[#a78bfa]/10 px-4 py-2 text-sm text-[#d8c8ff] transition hover:bg-[#a78bfa]/20">
                            Join now
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</x-layouts.app>
