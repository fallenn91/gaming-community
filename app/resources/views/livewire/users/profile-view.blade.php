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
        <div class="flex gap-3 mt-4 mb-4">
          <button class="px-4 py-1.5 rounded-full text-sm font-medium text-white transition"
                  style="background: linear-gradient(135deg, #8b5cf6, #6246ea);"
                  onmouseover="this.style.boxShadow='0 0 20px rgba(139,92,246,0.5)'"
                  onmouseout="this.style.boxShadow='none'">
            Follow
          </button>
          <button class="px-4 py-1.5 rounded-full text-sm transition"
                  style="border: 1px solid rgba(139,92,246,0.4); color: #ddd6fe; background: rgba(139,92,246,0.08);"
                  onmouseover="this.style.borderColor='rgba(139,92,246,0.8)'"
                  onmouseout="this.style.borderColor='rgba(139,92,246,0.4)'">
            Message
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- PROFILE BODY --}}
  <div class="w-full flex flex-col gap-4 mt-4">

    

    {{-- STATS / SOCIAL --}}
    <div class="flex gap-2 flex-wrap">      
      @foreach([['Followers', $user->followers->count()], ['Following', $user->following->count()], ['Likes', $user->likes->count()]] as [$label, $count])
        <span class="px-4 py-2 rounded-lg text-sm cursor-pointer transition"
              style="background: rgba(139,92,246,0.1); border: 1px solid rgba(139,92,246,0.35); color: #ddd6fe;"
              onmouseover="this.style.borderColor='rgba(139,92,246,0.7)'"
              onmouseout="this.style.borderColor='rgba(139,92,246,0.35)'">
          {{ $label }} <span style="color: rgba(217,70,239,0.9);">{{ $count }}</span>
        </span>
      @endforeach
    </div>

    {{-- POSTS --}}
    <div class="flex flex-col gap-3">
      @foreach ($user->posts as $post)
        <div class="rounded-2xl p-4 transition"
             style="background: rgba(139,92,246,0.08); backdrop-filter: blur(12px); border: 1px solid rgba(139,92,246,0.25); box-shadow: 0 4px 20px rgba(0,0,0,0.3);"
             onmouseover="this.style.borderColor='rgba(139,92,246,0.5)'; this.style.boxShadow='0 8px 30px rgba(139,92,246,0.15)'"
             onmouseout="this.style.borderColor='rgba(139,92,246,0.25)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.3)'">

          {{-- Post header --}}
          <div class="flex items-center gap-3 mb-3">
            <div class="w-8 h-8 rounded-full flex-shrink-0"
                 style="background: linear-gradient(135deg, #8b5cf6, #d946ef);"></div>
            <div>
              <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full {{ $post->user->isOnline() ? 'bg-green-400' : 'bg-gray-500' }}"></div>
                <span class="text-sm font-medium" style="color: #ddd6fe;">
                  {{ $post->user->username }}
                </span>
              </div>
              <p class="text-xs" style="color: rgba(217,70,239,0.75);">
                {{ $post->user->role ?? 'Member' }}
              </p>
              <p class="text-xs" style="color: rgba(221,214,254,0.3);">
                {{ $post->created_at->diffForHumans() }}
              </p>
            </div>
          </div>

          {{-- Post content --}}
          <p class="text-sm" style="color: rgba(255,255,255,0.85);">{{ $post->content }}</p>

          @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="mt-3 rounded-xl w-full object-cover">
          @endif

          {{-- Actions --}}
          <div class="flex gap-4 mt-4 text-sm" style="color: rgba(221,214,254,0.4);">
            <button class="transition hover:text-pink-400">❤️ {{ $post->likes->count() }}</button>
            <button class="transition" style="color: rgba(221,214,254,0.4);"
                    onmouseover="this.style.color='rgba(139,92,246,0.9)'"
                    onmouseout="this.style.color='rgba(221,214,254,0.4)'">
              💬 {{ $post->comments->count() }}
            </button>
          </div>

        </div>
      @endforeach
    </div>

  </div>
</div>