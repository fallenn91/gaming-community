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
<header class="w-full border-b border-white/10 bg-[#1a1333]/95 backdrop-blur-xl fixed top-0 left-0 z-50">
  <div class="max-w-6xl mx-auto px-4 py-3 text-[20px] flex items-center relative gap-4">
    <a href="{{ route('home') }}" class="text-[#a78bfa] font-bold tracking-[0.25em]">
      CYBERCOMM
    </a>
    <div class="absolute left-1/2 transform -translate-x-1/2 w-2/3 max-w-xl hidden lg:block">
      <livewire:utils.global-search />
    </div>
    <div class="flex items-center gap-8 ml-auto">
      @auth
        <livewire:notifications.notification-bell />
      @endauth
      <a href="{{ route('profile', auth()->user()->id) }}" class="ml-2">
        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-9 h-9 rounded-full border border-white/10 object-cover">
      </a>
    </div>
  </div>
</header>

<!-- Sliding left sidebar (outside main) -->
<div class="fixed top-16 bottom-0 left-0 w-56 bg-black/20 p-4 border-r border-white/10 backdrop-blur-xl transform transition-transform duration-300 z-40 lg:translate-x-0">
  <nav class="space-y-2 text-sm">
    <a href="{{ route('home') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 transition hover:bg-[#a78bfa]/10 hover:text-cyan-300">🏠 Home</a>
    <a href="{{ route('explore') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 transition hover:bg-[#a78bfa]/10 hover:text-cyan-300">🧭 Explore</a>
    <a href="{{ route('discover') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 transition hover:bg-[#a78bfa]/10 hover:text-cyan-300">✨ Discover</a>
    <a href="{{ route('events') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 transition hover:bg-[#a78bfa]/10 hover:text-cyan-300">🎉 Events</a>
    <a href="{{ route('community') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 transition hover:bg-[#a78bfa]/10 hover:text-cyan-300">🛡️ Guilds</a>
    <a href="{{ route('messages.index') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 transition hover:bg-[#a78bfa]/10 hover:text-cyan-300">💬 Chat</a>
    <a href="{{ route('profile', auth()->user()->id) }}" class="flex items-center gap-2 rounded-xl px-3 py-2 transition hover:bg-[#a78bfa]/10 hover:text-cyan-300">👤 Profile</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-left transition hover:bg-red-500/10 hover:text-red-400 cursor-pointer">🚪 Logout</button>
    </form>
  </nav>
  <div class="mt-4 pt-4 border-t border-white/10">
    <h4 class="mb-2 text-sm font-semibold text-[#a78bfa]">Leaderboard</h4>
    <nav class="space-y-2 text-sm">
      <a href="{{ route('weekly.leaderboard') }}" class="block rounded-xl px-3 py-2 transition hover:bg-[#a78bfa]/10">Top Weekly</a>
      <a href="{{ route('discover') }}" class="block rounded-xl px-3 py-2 transition hover:bg-[#a78bfa]/10">Top Global</a>
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
        <div class="rounded-2xl border border-[#a78bfa]/20 bg-gradient-to-br from-[#24174a] to-[#120d24] p-4 shadow-[0_0_35px_rgba(167,139,250,0.14)]">
          <h3 class="mb-3 text-lg font-semibold text-[#d8c8ff]">{{ auth()->user()->username }}</h3>
          <livewire:users.xp-bar />
        </div>
        <div class="rounded-xl border border-white/10 bg-black/20 p-3 text-xs text-slate-300">
          🔔 You have 3 new interactions
        </div>
        <div class="rounded-xl border border-white/10 bg-black/20 p-3">
            <h3 class="mb-3 text-sm font-semibold text-[#a78bfa]">Trending Tags</h3>
            <div class="flex flex-wrap gap-2 text-xs text-gray-300">
                <span class="rounded-full border border-[#a78bfa]/20 px-2 py-1">#gaming</span>
                <span class="rounded-full border border-[#a78bfa]/20 px-2 py-1">#ai</span>
                <span class="rounded-full border border-[#a78bfa]/20 px-2 py-1">#dev</span>
                <span class="rounded-full border border-[#a78bfa]/20 px-2 py-1">#indie</span>
            </div>
        </div>
        <div class="rounded-xl border border-white/10 bg-black/20 p-4 text-xs text-slate-300">
          <div class="flex justify-between gap-2">
            <span>👾 1,240 online</span>
            <span>📝 8,320 posts</span>
          </div>
          <div class="mt-2">🔥 120 trends</div>
        </div>
        <div class="rounded-xl border border-white/10 bg-black/20 p-4">
            <h3 class="mb-3 text-sm font-semibold text-[#a78bfa]">Suggested Users</h3>
            <div class="space-y-3 text-sm">
              @foreach ($users->take(3) as $user)
              <div class="flex items-center gap-2">
                  <div class="h-7 w-7 rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500"></div>
                  <a href="{{ route('profile', $user->id) }}" class="transition hover:text-cyan-300"><span>{{ $user->username }}</span></a>
              </div>
              @endforeach
            </div>
        </div>
        <div class="rounded-xl border border-white/10 bg-black/20 p-4">
          <h3 class="mb-2 text-sm font-semibold text-[#a78bfa]">💬 Global Chat</h3>
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