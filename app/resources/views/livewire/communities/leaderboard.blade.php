<div class="max-w-7xl mx-auto py-8">

    <div class="mb-5">
        <h1 class="text-xl font-semibold text-white">
            Leaderboard
        </h1>
        <p class="text-sm text-gray-500">
            Top guilds by XP
        </p>
    </div>

    <div class="rounded-2xl border border-white/50 bg-[#6246EA] bg-[linear-gradient(303deg,rgba(98,70,234,0.57)_26%,rgba(43,44,52,0.47)_60%)] overflow-hidden">

        {{-- HEADER --}}
        <div class="grid grid-cols-12 px-5 py-3 text-base border-b border-white/50 font-semibold">
            <div class="col-span-1 text-[#d946ef]">#</div>
            <div class="col-span-2 text-[#d946ef]">Guild</div>
            <div class="col-span-3 text-right text-[#d946ef]">Level</div>
            <div class="col-span-3 text-right text-[#d946ef]">Rank</div>
            <div class="col-span-3 text-right text-[#d946ef]">XP</div>
        </div>

        {{-- ROWS --}}
        <div class="divide-y divide-white/5">

            @foreach ($communities as $index => $community)
                <div class="grid grid-cols-12 items-center px-5 py-3 hover:bg-white/5 transition">

                    {{-- Rank --}}
                    <div class="col-span-1 text-sm text-zinc-400">
                        {{ $index + 1 }}
                    </div>

                    {{-- community --}}
                    <div class="col-span-2 flex items-center gap-3">

                        <span class="text-sm text-zinc-200">
                            {{ $community->name }}
                        </span>
                    </div>

                    {{-- XP --}}
                    <div class="col-span-3 text-right text-sm text-zinc-300 font-medium">
                        {{ number_format($community->level ?? 0) }}
                    </div>
                    <div class="col-span-3 text-right text-sm text-zinc-300 font-medium">
                        {{ ($community->rank ?? 'No Rank Yet') }} 
                    </div>
                    <div class="col-span-3 text-right text-sm text-zinc-300 font-medium">
                        {{ number_format($community->xp ?? 0) }} XP
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</div>