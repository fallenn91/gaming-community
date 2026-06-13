<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="bg-[#1a1333] text-white">

<div x-data="{ sidebarOpen: false }" x-init="sidebarOpen = window.innerWidth >= 1024" class="relative">

<!-- NAVBAR -->
<header class="w-full bg-[#1a1333] fixed top-0 left-0 z-50">
  <div class="max-w-6xl mx-auto px-4 py-3 text-[20px] flex items-center relative gap-4">
    <div class="text-[#a78bfa] font-bold">
      CYBERCOMM
    </div>
    <div class="absolute left-1/2 transform -translate-x-1/2 w-2/3 max-w-xl hidden lg:block">
      <livewire:utils.global-search />
    </div>
    <div class="flex items-center gap-8 ml-auto">
      @auth
        <livewire:notifications.notification-bell />
      @endauth
          <a href="{{ route('profile', auth()->user()->id) }}" class="ml-2">
            <img src="{{ asset('storage/' .  auth()->user()->avatar ) }}" class="w-8 h-8 rounded-full">
          </a>

  </div>
</header>

<!-- Sliding left sidebar (outside main) -->
<div class="fixed top-15 bottom-0 left-0 w-56 bg-black/10 p-4 border border-white/5 transform transition-transform duration-300 z-40 lg:translate-x-0">
  <nav class="space-y-2 text-sm">
    <a href="{{ route('home') }}" class="block px-3 py-2 rounded hover:bg-[#a78bfa]/10">Home</a>
    <a href="{{ route('explore') }}" class="block px-3 py-2 rounded hover:bg-[#a78bfa]/10">Explore</a>
    <a href="{{ route('community') }}" class="block px-3 py-2 rounded hover:bg-[#a78bfa]/10">Guilds</a>
    <a href="{{ route('messages.index') }}" class="block px-3 py-2 rounded hover:bg-[#a78bfa]/10">Chat</a>
    <a href="{{ route('profile', auth()->user()->id) }}" class="block px-3 py-2 rounded hover:bg-[#a78bfa]/10">Profile</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="w-full text-left px-3 py-2 rounded hover:bg-[#a78bfa]/10 hover:text-red-500 cursor-pointer">Logout</button>
    </form>
  </nav>
  <div class="mt-4 pt-4 border-t border-white/5">
    <h4 class="text-[#a78bfa] mb-2 mt-2 text-sm">Leaderboard</h4>
    <nav class="space-y-2 text-sm">
      <a href="" class="block px-3 py-2 rounded hover:bg-[#a78bfa]/10">Top Weekly</a>
      <a href="" class="block px-3 py-2 rounded hover:bg-[#a78bfa]/10">Top Global</a>
    </nav>
  </div>
</div>


@php
  $noHasSideBar = ['explore', 'community'];   
  $hasSideBar = !request()->routeIs($noHasSideBar);
@endphp

<!-- MAIN CONTENT -->
<div class="max-w-6xl mx-auto pt-20 px-4 grid gap-6 {{ $hasSideBar? 'lg:grid-cols-[1fr_240px]' : 'grid-cols-1' }}">
  
    <!-- SLOT (aquí entra Livewire o Blade) -->
    <div
    x-data="{ show: false, message: '', type: 'success' }"
    x-on:toast.window="
        message = $event.detail.message;
        type = $event.detail.type ?? 'success';
        show = true;
        setTimeout(() => show = false, 3500);
    "
    class="fixed bottom-5 right-5 z-50"
  >
      <div
          x-show="show"
          x-transition
          class="px-5 py-4 rounded-2xl shadow-lg border backdrop-blur-md"
          :class="type === 'success' ? 'toast-success' : 'toast-default'"
      >
          <div class="flex items-center gap-3">
              <div class="text-2xl">🏆</div>
              <div>
                  <p class="text-sm font-semibold text-white">
                      Achievement desbloqueado
                  </p>
                  <p class="text-xs opacity-80 text-white" x-text="message"></p>
              </div>
          </div>
      </div>
  </div>
    <main class="space-y-4">
        {{ $slot }}
    </main>

    <!-- RIGHT SIDEBAR -->
    @if ($hasSideBar)
    <aside class="space-y-6 hidden lg:block sticky top-20 px-4 self-start">
      <div class="flex flex-col gap-5">
        <div>
          <h3 class="text-[#a78bfa] mb-3 text-lg">{{ auth()->user()->username }}</h3>
          <livewire:users.xp-bar />
        </div>
        <div class="bg-black/20 rounded-xl p-3 border border-white/5 text-xs">
          🔔 You have 3 new interactions
        </div>
        <div>
            <h3 class="text-[#a78bfa] mb-3 text-sm">Trending Tags</h3>

            <div class="flex flex-wrap gap-2 text-xs text-gray-300">
                <span class="px-2 py-1 border border-[#a78bfa]/20 rounded">#gaming</span>
                <span class="px-2 py-1 border border-[#a78bfa]/20 rounded">#ai</span>
                <span class="px-2 py-1 border border-[#a78bfa]/20 rounded">#dev</span>
                <span class="px-2 py-1 border border-[#a78bfa]/20 rounded">#indie</span>
            </div>
        </div>
        <div class="bg-black/20 rounded-xl p-4 border border-white/5 flex justify-between text-xs">
          <span>👾 1,240 online</span>
          <span>📝 8,320 posts</span>
          <span>🔥 120 trends</span>
        </div>
        <div>
            <h3 class="text-[#a78bfa] mb-3 text-sm">Suggested Users</h3>

            <div class="space-y-3 text-sm">
              @foreach ($users->take(3) as $user)    
              <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500"></div>
                  <a href="{{ route('profile', $user->id)}}" class="hover:text-cyan-300 transition duration-300"><span>{{ $user->username }}</span></a>
              </div>
              @endforeach
            </div>
        </div>
        <div class="bg-black/20 rounded-xl p-4 border border-white/5">
          <h3 class="text-[#a78bfa] text-sm mb-2">💬 Global Chat</h3>
          <p class="text-xs text-gray-400">@user: anyone online?</p>
        </div>
      </div>
    </aside>
    @endif
</div>
</div>
@auth
  <livewire:user.presence />
@endauth
@livewireScripts
</body>
</html>