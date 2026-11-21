<div class="mx-auto flex w-full max-w-5xl flex-col gap-6 px-4 py-8">
    <div class="overflow-hidden rounded-3xl border border-white/10 bg-zinc-900/80 shadow-2xl shadow-black/30 backdrop-blur-xl">
        <div class="h-36 bg-gradient-to-r from-violet-600 via-fuchsia-600 to-cyan-500"></div>
        <div class="p-6">
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $community->name }}</h1>
                    <p class="mt-2 text-sm text-zinc-400">{{ $community->description ?: 'A new space for players to connect.' }}</p>
                </div>

                <div class="flex items-center gap-3">
                    <span class="rounded-full border border-cyan-400/20 bg-cyan-500/10 px-3 py-1 text-xs font-medium uppercase tracking-wide text-cyan-300">
                        {{ ucfirst($community->visibility) }}
                    </span>
                    <span class="rounded-full border border-violet-400/20 bg-violet-500/10 px-3 py-1 text-xs font-medium uppercase tracking-wide text-violet-300">
                        Lv.{{ $community->level ?? 1 }}
                    </span>
                </div>
            </div>

            <div id="join" class="mt-6">
                <livewire:communities.community-join :community="$community" />
            </div>
        </div>
    </div>

    @php
        $isAdmin = auth()->check() && auth()->user()->isAdmin();
        $isOwner = auth()->check() && auth()->id() === $community->owner_id;
    @endphp

    @if($isAdmin)
        <div class="mt-2 rounded-3xl border border-amber-400/20 bg-amber-500/10 p-5">
            <h2 class="text-lg font-semibold text-amber-300">Admin community panel</h2>
            <p class="mt-2 text-sm text-zinc-300">You are viewing the community as an administrator.</p>
        </div>
    @elseif($isOwner)
        <div class="mt-2">
            <livewire:communities.community-requests :community="$community" />
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
        @if(! $isAdmin)
            <div class="space-y-6">
                <livewire:communities.community-post-composer :community="$community" />
                <div class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6">
                    <h2 class="text-lg font-semibold text-white">Recent activity</h2>
                    <p class="mt-2 text-sm text-zinc-400">This community is ready to receive posts and members.</p>
                </div>
            </div>
        @endif

        <div class="space-y-6">
            <livewire:communities.community-members :community="$community" />
            <div class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6">
                <h2 class="text-lg font-semibold text-white">Community info</h2>
                <ul class="mt-4 space-y-3 text-sm text-zinc-400">
                    <li>Owner: {{ $community->owner?->name ?? '—' }}</li>
                    <li>Members: {{ $community->members()->count() }}</li>
                    <li>Rank: {{ $community->rank ?? 'Bronze' }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
