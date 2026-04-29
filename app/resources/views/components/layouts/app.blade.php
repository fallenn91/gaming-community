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
  <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">

    <!-- LOGO -->
    <div class="text-[#a78bfa] font-bold">
      CYBERCOMM
    </div>

    <input 
      class="bg-black/30 px-3 py-1 rounded text-sm"
      placeholder="Search gamers..."
    >

    <!-- NAV LINKS -->
    <nav class="flex gap-6 text-sm text-gray-300">
      <a class="hover:text-[#a78bfa]" href="{{ route('home')}}">Home</a>
      <a class="hover:text-[#a78bfa]" href="#">Explore</a>
      <a class="hover:text-[#a78bfa]" href="#">Create</a>
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

<!-- MAIN CONTENT -->
<div class="w-full pt-20 px-4 md:px-12 gap-6 flex">
  
    <!-- SLOT (aquí entra Livewire o Blade) -->
    <main class="space-y-4 flex-1">
        {{ $slot }}
    </main>

    <!-- RIGHT SIDEBAR -->
    @if (request()->routeIs('home'))
    <aside class="space-y-6">
        <div>
          <h3 class="text-[#a78bfa] mb-3 text-lg">{{ auth()->user()->username }}</h3>
          <p>Lv. {{ auth()->user()->level }} • {{ auth()->user()->xp }} XP</p>
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

        <div>
            <h3 class="text-[#a78bfa] mb-3 text-sm">Suggested Users</h3>

            <div class="space-y-3 text-sm">

                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500"></div>
                    <span>@creator_one</span>
                </div>

                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-fuchsia-500 to-[#a78bfa]"></div>
                    <span>@dev_master</span>
                </div>

                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500"></div>
                    <span>@indie_dev</span>
                </div>

            </div>
        </div>

    </aside>
    @endif
</div>

@livewireScripts
</body>
</html>