<x-layouts.app>
    <a href="{{ route ('community.create') }}" class="bg-[#6246ea] px-4 py-2 rounded-full cursor-pointer hover:bg-[#8b5cf6] transition duration-300 ">
      Create Community
    </a>
    <livewire:communities.leaderboard />
  <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3 mt-6">
      @foreach ($communities as $community)
          <div
              class="group relative overflow-hidden rounded-2xl border border-white/10 bg-[#6366f1]/20 p-6 shadow-lg shadow-black/20 backdrop-blur transition duration-300 hover:-translate-y-1 hover:border-violet-500/40 hover:shadow-violet-500/10"
          >
              {{-- Glow --}}
              <div class="absolute inset-0 bg-gradient-to-br from-violet-500/5 via-fuchsia-500/5 to-cyan-500/5 opacity-0 transition duration-300 group-hover:opacity-100"></div>

              <div class="relative z-10">
                  {{-- Header --}}
                  <div class="flex items-start justify-between gap-3">
                      <div>
                          <h2 class="text-xl font-bold tracking-tight text-violet-300">
                              {{ $community->name }}
                          </h2>

                          <p class="mt-1 text-sm text-cyan-400">
                              {{ $community->slug }}
                          </p>
                      </div>

                      <span
                          class="rounded-full border border-violet-500/30 bg-violet-500/10 px-3 py-1 text-xs font-medium text-violet-200"
                      >
                          {{ $community->status }}
                      </span>
                  </div>

                  {{-- Stats --}}
                  <div class="mt-5 flex items-center gap-3">
                      <div class="rounded-xl bg-[#6246ea]/50 px-4 py-2">
                          <p class="text-[11px] uppercase tracking-wide text-zinc-400">
                              Level
                          </p>

                          <p class="text-lg font-semibold text-white">
                              Lv.{{ $community->level ?? 1 }}
                          </p>
                      </div>

                      <div class="rounded-xl bg-[#6246ea]/50 px-4 py-2">
                          <p class="text-[11px] uppercase tracking-wide text-zinc-400">
                              XP
                          </p>

                          <p class="text-lg font-semibold text-fuchsia-300">
                              {{ number_format($community->xp ?? 0) }}
                          </p>
                      </div>

                      <div class="rounded-xl bg-[#6246ea]/50 px-4 py-2">
                          <p class="text-[11px] uppercase tracking-wide text-zinc-400">
                              Rank
                          </p>

                          <p class="text-lg font-semibold text-cyan-300">
                              {{ $community->rank ?? '—' }}
                          </p>
                      </div>
                  </div>

                  {{-- Description --}}
                  <p class="mt-5 line-clamp-3 text-sm leading-relaxed text-zinc-300">
                      {{ $community->description }}
                  </p>
              </div>
          </div>
      @endforeach
  </div>
</x-layouts.app>