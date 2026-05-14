<div class="w-full">
  {{-- PROFILE HEADER --}}
  <div class="rounded-2xl overflow-hidden"
       style="background: rgba(255,255,255,0.07); backdrop-filter: blur(16px); border: 1px solid rgba(139,92,246,0.35); box-shadow: 0 8px 40px rgba(0,0,0,0.4);">

    {{-- BANNER --}}
    <div class="h-40 relative" style="background: linear-gradient(135deg, #100828 0%, #1e0f45 50%, #100828 100%);">
      <div class="absolute -top-20 -left-20 w-60 h-60 rounded-full pointer-events-none"
           style="background:radial-gradient(circle, rgba(139,92,246,0.5) 0%, transparent 70%); filter:blur(40px);"></div>
      <div class="absolute -bottom-20 -right-20 w-60 h-60 rounded-full pointer-events-none"
           style="background:radial-gradient(circle, rgba(217,70,239,0.45) 0%, transparent 70%); filter:blur(40px);"></div>
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
        <h2 class="text-lg font-bold" style="color: #ddd6fe;">
          {{ $user->username ?? 'cyber_user' }}
        </h2>

        <p class="text-xs mt-0.5" style="color: rgba(217,70,239,0.8);">
          Lv.{{ $user->level ?? 1 }} • {{ $user->xp ?? 0 }} XP
        </p>

        <p class="text-sm mt-2" style="color: rgba(221,214,254,0.55);">
          {{ $user->bio ?? 'FPS player • Indie dev • Night grinder ⚡' }}
        </p>

        {{-- ACTIONS --}}
        @if (auth()->id() !== $user->id)
        <div class="flex gap-3 mt-4 mb-4">
          <livewire:interactions.follow-button :user="$user" wire:key="follow-{{ $user->id }}" /> 
          <button class="px-4 py-1.5 rounded-full text-sm transition"
                  style="border: 1px solid rgba(139,92,246,0.4); color: #ddd6fe; background: rgba(139,92,246,0.08);"
                  onmouseover="this.style.borderColor='rgba(139,92,246,0.8)'"
                  onmouseout="this.style.borderColor='rgba(139,92,246,0.4)'">
            Message
          </button>
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