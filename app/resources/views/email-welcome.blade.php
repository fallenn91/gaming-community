<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TITLE -->
  <title>CYBERCOMM | Email Verify</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#100828]">

  <!-- FONDO FIJO -->
  <div class="fixed inset-0 -z-10 bg-[#100828]"></div>

  <!-- Blob 1 — violeta grande, arriba izquierda -->
  <div class="blob-a fixed -z-10 pointer-events-none will-change-transform"
       style="width:820px;height:820px;top:-250px;left:-250px;
              background:radial-gradient(circle, rgba(139,92,246,0.65) 0%, transparent 65%);
              filter:blur(75px);">
  </div>

  <!-- Blob 2 — fuchsia, abajo derecha -->
  <div class="blob-b fixed -z-10 pointer-events-none will-change-transform"
       style="width:620px;height:620px;bottom:-200px;right:-200px;
              background:radial-gradient(circle, rgba(217,70,239,0.6) 0%, transparent 65%);
              filter:blur(75px);">
  </div>

  <!-- Blob 3 — indigo, centro -->
  <div class="blob-c fixed -z-10 pointer-events-none will-change-transform"
       style="width:420px;height:420px;top:35%;left:50%;
              background:radial-gradient(circle, rgba(99,102,241,0.5) 0%, transparent 70%);
              filter:blur(55px);">
  </div>

  <!-- Blob 4 — violeta cálido, esquina superior derecha -->
  <div class="blob-d fixed -z-10 pointer-events-none will-change-transform"
       style="width:360px;height:360px;top:-100px;right:10%;
              background:radial-gradient(circle, rgba(167,139,250,0.45) 0%, transparent 70%);
              filter:blur(65px);">
  </div>

  <div class="w-full min-h-screen flex flex-col items-center">

    <!-- HEADER -->
    <header class="w-full bg-black/20 backdrop-blur-md border-b border-white/5 fixed top-0 left-0 z-50">
      <div class="max-w-6xl mx-auto px-4 py-3 text-[20px] flex items-center justify-between">

        <!-- LOGO -->
        <div class="text-[#a78bfa] font-bold">
          CYBERCOMM
        </div>

        <!-- NAV LINKS -->
        <nav class="flex gap-6 text-base text-gray-300 inline-flex items-center">
          <a class="hover:text-[#a78bfa] transition-colors" href="{{ route('home') }}">Home</a>
          <a class="hover:text-[#a78bfa] transition-colors" href="#cards-explore">Explore</a>
          <a class="bg-[#6246ea] hover:bg-[#4f3bd6] text-white rounded-full px-4 py-2 transition-colors" href="{{ route('login') }}">Join Us</a>
        </nav>

      </div>
    </header>

    <section class="w-full min-h-screen pt-[68px] flex flex-col justify-center items-center relative">
      <!-- Glass card que envuelve el hero content -->
      <div class="text-center px-6 md:px-12 py-10 md:py-16 rounded-3xl flex flex-col items-center gap-3 max-w-3xl"
           style="
             background: rgba(255,255,255,0.08);
             backdrop-filter: blur(16px);
             -webkit-backdrop-filter: blur(16px);
             border: 1px solid rgba(167,139,250,0.5);
             box-shadow: 0 8px 48px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.05) inset, 0 0 80px rgba(139,92,246,0.2) inset;
           ">
        <h1 class="text-4xl font-bold text-[#ddd6fe] tracking-widest"
            style="text-shadow: 0 0 24px #a78bfa, 0 0 60px rgba(139,92,246,0.4);">
          Email Verified
        </h1>
        <p class="text-[#e5e7eb] text-xl mt-2 max-w-xl mx-auto">
          Welcome back, <span class="font-semibold text-white">{{ $user->name }}</span>. Your account is now verified.
        </p>

        <form action="{{ route('home') }}" method="GET" class="mt-8">
          <button type="submit"
                  class="px-8 py-4 rounded-full bg-[#6246ea] text-white text-lg hover:bg-[#4f3bd6] hover:shadow-lg transition duration-300">
            Go to dashboard
          </button>
        </form>

        <p class="text-gray-400 text-sm mt-4">
          Start exploring communities and gaming content now.
        </p>
      </div>
    </section>

  </div>
</body>
</html>
