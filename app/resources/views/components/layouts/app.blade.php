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

<!-- NAVBAR -->
<header class="w-full bg-[#1a1333] fixed top-0 left-0 z-50">
  <div class="max-w-6xl mx-auto px-4 py-3 text-[20px] flex items-center justify-between">

    <!-- LOGO -->
    <div class="text-[#a78bfa] font-bold">
      CYBERCOMM
    </div>

    <input 
      class="bg-black/30 px-3 py-1 rounded text-sm border border-[#a78bfa]  focus:ring-2 focus:ring-[#a78bfa]"
      placeholder="Search gamers..."
    >

    <!-- NAV LINKS -->
    <nav class="flex gap-6 text-base text-gray-300">
      <a class="hover:text-[#a78bfa]" href="{{ route('home')}}">Home</a>
      <a class="hover:text-[#a78bfa]" href="{{ route('explore')}}">Explore</a>
      <a class="hover:text-[#a78bfa]" href="{{ route('community')}}">Communities</a>
      <a class="hover:text-[#a78bfa]" href="{{ route('profile', auth()->user()) }}">Profile</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="hover:text-red-400">
            Logout
        </button>
      </form>
    </nav>

  </div>
</header>

@php
  $noHasSideBar = ['explore', 'community'];   
  $hasSideBar = !request()->routeIs($noHasSideBar);
@endphp

<!-- MAIN CONTENT -->
<div class="max-w-6xl mx-auto pt-20 px-4 grid gap-6 {{ $hasSideBar? 'lg:grid-cols-[1fr_300px]' : 'grid-cols-1' }}">
  
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
          <p>Lv. {{ auth()->user()->level }} • {{ auth()->user()->xp }} XP</p>
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

@livewireScripts
</body>
</html>