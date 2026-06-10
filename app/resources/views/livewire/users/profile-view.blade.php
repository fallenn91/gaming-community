<div class="w-full">
  {{-- PROFILE HEADER --}}
  <div class="rounded-2xl overflow-hidden"
       style="background: rgba(255,255,255,0.07); backdrop-filter: blur(16px); border: 1px solid rgba(139,92,246,0.35); box-shadow: 0 8px 40px rgba(0,0,0,0.4);">

    {{-- BANNER --}}
    <div class="h-40 relative overflow-hidden">

    @if($user->banner)
        <img
            src="{{ asset('storage/' . $user->banner) }}"
            alt="Banner"
            class="absolute inset-0 w-full h-full object-cover"
        >

        {{-- Overlay para que el texto siga siendo legible --}}
        <div class="absolute inset-0 bg-black/40"></div>
    @else
        <div class="absolute inset-0"
             style="background: linear-gradient(135deg, #100828 0%, #1e0f45 50%, #100828 100%);">
        </div>
    @endif

    {{-- Efectos decorativos --}}
    <div class="absolute -top-20 -left-20 w-60 h-60 rounded-full pointer-events-none"
         style="background:radial-gradient(circle, rgba(139,92,246,0.5) 0%, transparent 70%); filter:blur(40px);">
    </div>

    <div class="absolute -bottom-20 -right-20 w-60 h-60 rounded-full pointer-events-none"
         style="background:radial-gradient(circle, rgba(217,70,239,0.45) 0%, transparent 70%); filter:blur(40px);">
    </div>

</div>

    {{-- PROFILE INFO --}}
    <div class="px-4 pb-5 relative">

      {{-- AVATAR --}}
      <div class="absolute -top-10">
        <div class="w-20 h-20 rounded-full p-[2px]"
             style="background: linear-gradient(135deg, #8b5cf6, #d946ef);">
          <div class="w-full h-full rounded-full overflow-hidden"
               style="background: #100828;">
            @if(isset($user) && $user->avatar)
              <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
            @endif
          </div>
        </div>
      </div>
      

      {{-- TEXT --}}
      <div class="pt-12">
        <div class="flex gap-3 items-center">
          <h2 class="text-lg font-bold" style="color: #ddd6fe;">
            {{ $user->username ?? 'cyber_user' }} 
          </h2>
          <a href="{{ route('profile.edit')}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 cursor-pointer hover:text-cyan-400">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
          </a>
        </div>

        <p class="text-xs mt-0.5" style="color: rgba(217,70,239,0.8);">
          Lv.{{ $user->level ?? 1 }} • {{ $user->xp ?? 0 }} XP
        </p>
        <p class="text-xs mt-0.5" style="color: rgba(217,70,239,0.8);">
          {{ $user->reputation ?? 0 }} Reputation
          
          <span class="text-xs text-purple-300">
              {{ app(\App\Services\ReputationService::class)->getTitle($user) }}
          </span>

          {{-- Votos (no se muestra en tu propio perfil) --}}
          @if (auth()->id() !== $user->id)
              <livewire:interactions.reputation-vote :target="$user" />
          @endif
        </p>

        <p class="text-sm mt-2" style="color: rgba(221,214,254,0.55);">
          {{ $user->bio ?? 'FPS player • Indie dev • Night grinder ⚡' }}
        </p>

        {{-- ACTIONS --}}
        @if (auth()->id() !== $user->id)
        <div class="flex gap-3 mt-4 mb-4">
          <livewire:interactions.follow-button :user="$user" wire:key="follow-{{ $user->id }}" /> 
          <a href="{{ route('messages.show', $user) }}" class="px-4 py-1.5 rounded-full text-sm transition"
                  style="border: 1px solid rgba(139,92,246,0.4); color: #ddd6fe; background: rgba(139,92,246,0.08);"
                  onmouseover="this.style.borderColor='rgba(139,92,246,0.8)'"
                  onmouseout="this.style.borderColor='rgba(139,92,246,0.4)'">
            Message
        </a>
        </div>
        @endif
      </div>
    </div>
  </div>

  {{-- PROFILE BODY --}}
  <div class="w-full flex flex-col gap-4 mt-4">
        
      {{-- STATS / SOCIAL --}}
      <div class="flex gap-2 flex-wrap">
          @foreach([
              ['Followers', $followersCount],
              ['Following', $followingCount],
              ['Likes', $likesCount]
          ] as [$label, $count])

              <span class="px-4 py-2 rounded-lg text-sm transition"
                    style="background: rgba(139,92,246,0.1); border: 1px solid rgba(139,92,246,0.35); color: #ddd6fe;"
                    onmouseover="this.style.borderColor='rgba(139,92,246,0.7)'"
                    onmouseout="this.style.borderColor='rgba(139,92,246,0.35)'">

                  {{ $label }}
                  <span style="color: rgba(217,70,239,0.9);">
                      {{ $count }}
                  </span>
              </span>

          @endforeach
          <span class="px-4 py-2 rounded-lg text-sm transition hover:text-cyan-300"><a href="{{ route('library') }}">Library</a></span>
      </div>

      {{-- ACHIEVEMENTS --}}
      @if ($user->achievements->count())
      
          <div class="mt-4">
            <p class="text-xs mb-2 uppercase tracking-widest" style="color: rgba(217, 70, 239, 0.8);">
              Achievements
            </p>

            <div class="flex flex-wrap gap-2">
              @foreach ($user->achievements as $achievement)
                  <div class="px-3 py-2 rounded-lg text-xs flex items-center gap-2 transition"
                    style="background: rgba(139,92,246,0.12);
                          border: 1px solid rgba(139,92,246,0.3);
                          color: #ddd6fe;
                          backdrop-filter: blur(10px);"
                    onmouseover="this.style.borderColor='rgba(217, 70, 239, 0.6)'"
                    onmouseout="this.style.borderColor='rgba(139, 92, 246, 0.3)'">

                    <span>🏆</span>

                    <div class="flex flex-col leading-tight">
                      <span class="font-semibold">
                        {{ $achievement->name }}
                      </span>

                      <span class="text-[10px]" style="color: rgba(217, 70, 239, 0.7)">
                          +{{ $achievement->xp_reward }} XP
                      </span>
                    </div>
                  </div>
              @endforeach
            </div>
          </div>
      @endif
      
    {{-- POSTS --}}
      <livewire:feed.post-feed :user="$user"/>
  </div>
</div>