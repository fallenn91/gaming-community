<x-layouts.app>
    <div class="space-y-6">
        <section class="rounded-3xl border border-cyan-400/20 bg-gradient-to-br from-[#0f172a] via-[#172554] to-[#111827] p-6 shadow-[0_0_35px_rgba(34,211,238,0.12)]">
            <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">Weekly Leaderboard</p>
            <h2 class="mt-2 text-3xl font-semibold text-white">Top players of the week</h2>
            <p class="mt-2 text-sm text-slate-300">See who climbed the charts this week across games, guilds, and community activity.</p>
        </section>

        <div class="rounded-2xl border border-white/10 bg-black/20 p-5">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">Weekly ranking</h3>
                <span class="rounded-full border border-cyan-400/20 bg-cyan-400/10 px-3 py-1 text-xs text-cyan-300">Updated every 7 days</span>
            </div>

            <div class="space-y-3">
                @forelse($users as $index => $user)
                    <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-r from-cyan-400 to-[#a78bfa] font-semibold text-white">#{{ $index + 1 }}</div>
                            <div>
                                <p class="font-medium text-white">{{ $user->username ?? $user->name }}</p>
                                <p class="text-xs text-slate-400">{{ $user->xp }} XP · {{ $user->reputation }} rep</p>
                            </div>
                        </div>
                        <a href="{{ route('profile', $user->id) }}" class="text-sm text-cyan-300">View profile</a>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">No hay usuarios disponibles por ahora.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>
