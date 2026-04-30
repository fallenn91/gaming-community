<div class="w-full">
  <div class="relative w-full">
      <!-- PROFILE HEADER -->
    <div class="bg-black/30 rounded-xl overflow-hidden">

      <!-- BANNER -->
      <div class="h-40 bg-gradient-to-br from-[#1a1333] to-[#0f0a24] relative">

        <!-- glow effects -->
        <div class="absolute w-60 h-60 bg-[#a78bfa]/20 blur-3xl rounded-full -top-20 -left-20"></div>
        <div class="absolute w-60 h-60 bg-fuchsia-500/20 blur-3xl rounded-full -bottom-20 -right-20"></div>

      </div>

      <!-- PROFILE INFO -->
      <div class="px-4 pb-4 relative">

        <!-- AVATAR -->
        <div class="absolute -top-10">
          <div class="w-20 h-20 rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500 p-[2px]">
            <div class="w-full h-full rounded-full bg-black"></div>
          </div>
        </div>

        <!-- TEXT -->
        <div class="pt-12">
          <h2 class="text-lg text-[#a78bfa] font-bold">@cyber_user</h2>

          <p class="text-xs text-purple-400">Lv.12 • 340 XP</p>

          <p class="text-sm text-gray-400 mt-2">
            FPS player • Indie dev • Night grinder ⚡
          </p>

          <!-- ACTIONS -->
          <div class="flex gap-3 mt-3">
            <button class="bg-[#6246ea] px-4 py-1 rounded-full text-sm">
              Follow
            </button>
            <button class="border border-[#a78bfa]/30 px-4 py-1 rounded-full text-sm">
              Message
            </button>
          </div>

        </div>

      </div>
    </div>
  </div>
  <div class="w-full min-h-screen flex flex-col p-12 gap-3">
      <div class="w-full p-4 rounded-lg flex justify-evenly items-center gap-5">
        <div class="w-[30%] h-auto flex flex-col p-3">
          <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="avatar" id="avatar" class="hidden">
            <label for="avatar" class="cursor-pointer text-sm text-gray-400 hover:text-gray-200">Change Avatar</label>
            <button type="submit">Update</button>
          </form>
          <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile photo" class="w-[100px] h-[100px] object-cover">
          <p>Level: {{ $user->level }}</p>
        </div>
        <div class="w-[70%] h-auto flex flex-col p-3">
          <h2 class="text-3xl">{{ $user->username }}</h2>
          <p>{{ $user->bio }}</p>
          <p>XP: {{ $user->xp }}</p>
          <p class="text-gray-300 text-sm" >Joined: {{ $user->created_at->format('d M Y') }}</p>
        </div>
      </div>
      <div class="flex gap-2">
        <button class="px-4 py-2 bg-[#a78bfa]/35 rounded-lg text-[#00f5ff] border border-[#00f5ff]/50 cursor-pointer">
          Follow
        </button>
        <span class="badge cursor-pointer">Followers {{ $user->followers->count() }}</span>
        <span class="badge cursor-pointer">following {{ $user->following->count() }}</span>
        <span class="badge cursor-pointer">Likes {{ $user->likes->count() }}</span>
      </div>
      <div class="flex flex-col gap-3">
        @foreach ($user->posts as $post)
            <div class="post mb-3">
    
            <div class="flex items-center gap-3 mb-2">
    
                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500"></div>
    
                <div>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full
                            {{ $post->user->isOnline() ? 'bg-green-400' : 'bg-gray-500' }}">
                        </div>
    
                        <span class="text-sm text-cyan-300">
                            {{ $post->user->username }}
                        </span>
                    </div>
    
                    <p class="text-xs text-purple-400">
                        {{ $post->user->role ?? 'Member' }}
                    </p>
    
                    <p class="text-xs text-gray-500">
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>
    
            </div>
    
            <p class="text-sm">
                {{ $post->content }}
            </p>
    
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="mt-2 rounded-lg">
            @endif
    
            <div class="flex gap-4 mt-4 text-sm text-gray-400">
                <button class="hover:text-pink-400">❤️ {{ $post->likes->count() ?? 0 }}</button>
                <button class="hover:text-cyan-400">💬 {{ $post->comments->count() ?? 0 }}</button>
            </div>
    
        </div>
        @endforeach
      </div>
  </div>
</div>
