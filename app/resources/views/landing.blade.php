<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div class="w-full min-h-screen bg-gradient-to-br from-[#1a1333] to-[#0f0a24] relative overflow-hidden flex flex-col items-center justify-center ">
    <header class="w-full bg-black/20 backdrop-blur-md border-b border-white/5 fixed top-0 left-0 z-50">
      <div class="max-w-6xl mx-auto px-4 py-3 text-[20px] flex items-center justify-between">

        <!-- LOGO -->
        <div class="text-[#a78bfa] font-bold">
          CYBERCOMM
        </div>
        
        <!-- NAV LINKS -->
        <nav class="flex gap-6 text-base text-gray-300">
          <a class="hover:text-[#a78bfa]" href="{{ route('home')}}">Home</a>
          <a class="hover:text-[#a78bfa]" href="#">Explore</a>
          <a class="hover:text-[#a78bfa]" href="{{ route('login')}}">Join Us</a>
        </nav>

      </div>
    </header>
    <div class="w-full h-[100vh] bg-gradient-to-br from-[#1e163a] via-[#15102c] to-[#0b071a] relative overflow-hidden flex items-center justify-center">
      <!-- Glow circles -->
      <div class="absolute w-72 h-72 bg-[#a78bfa]/25 blur-3xl rounded-full top-[-50px] left-[-50px]"></div>
      <div class="absolute w-72 h-72 bg-fuchsia-500/25 blur-3xl rounded-full bottom-[-50px] right-[-50px]"></div>

      <div class="absolute w-[600px] h-[600px] bg-[#a78bfa]/10 blur-[120px] rounded-full top-[-200px] left-[-200px]"></div>
      <div class="absolute w-[500px] h-[500px] bg-fuchsia-500/10 blur-[120px] rounded-full bottom-[-200px] right-[-200px]"></div>
      <!-- Content -->
      <div class="text-center z-10">
        <h1 class="text-4xl font-bold text-[#a78bfa] tracking-widest"
            style="text-shadow: 0 0 20px #a78bfa;">
          Build. Play. Connect.
        </h1>
        <h2 class="text-gray-400 text-xl mt-2">
          CYBERCOMM is a social hub for gamers, creators, and digital explorers. Share posts, join discussions, and level up your network.
        </h2>
        <button class="max-w-md p-4 rounded-full bg-[#6246ea] text-white text-lg hover:bg-[#4f3bd6] hover:shadow-lg transition duration-300 cursor-pointer mt-6">
          Join the network
        </button>
      </div>
    </div>

    <div class="w-full h-[75vh] flex justify-center items-center gap-6">
      <div class="cards">
        <h2 class="text-2xl font-bold text-[#a78bfa] mb-4">Discover. Create. Connect.</h2>
        <p class="text-gray-400 text-sm mb-6">Join a vibrant community of gamers and creators. Share your passion, find teammates, and level up your gaming experience.</p>
        <button class="px-4 py-2 bg-[#6246ea] text-white rounded-full hover:bg-[#4f3bd6] transition duration-300">
          Get Started
        </button>
      </div>
      <div class="cards">
        <h2 class="text-2xl font-bold text-[#a78bfa] mb-4">Level up your digital world</h2>
        <p class="text-gray-400 text-sm mb-6">🎮 10,000+ players already inside</p>
        <p class="text-gray-400 text-sm mb-6">🔥 Trending communities every day</p>
        <p class="text-gray-400 text-sm mb-6">⚡ Level-based profiles & XP system</p>
        <button class="px-4 py-2 bg-[#6246ea] text-white rounded-full hover:bg-[#4f3bd6] transition duration-300">
          Join CYBERCOMM
        </button>
      </div>
      <div class="cards">
        <h2 class="text-xl font-bold text-[#a78bfa] mb-4">
          Community Stats
        </h2>

        <div class="space-y-2 text-sm text-gray-400">
          <p>👾 1,240 online now</p>
          <p>📝 8,320 posts created</p>
          <p>⚡ 120 active communities</p>
        </div>

        <button class="mt-6 px-4 py-2 bg-[#6246ea] text-white rounded-full hover:bg-[#4f3bd6] transition">
          See Analytics
        </button>
      </div>
    </div>
  </div>
</body>
</html>

