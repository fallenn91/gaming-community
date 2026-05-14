<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Open Graph (Facebook / Discord / LinkedIn) -->
  <meta property="og:title" content="CYBERCOMM - Level up your gaming identity">
  <meta property="og:description" content="Join a gaming community where every action gives you XP and reputation.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://tu-dominio.com">
  <meta property="og:image" content="https://tu-dominio.com/preview.jpg">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="CYBERCOMM - Gaming Community">
  <meta name="twitter:description" content="Earn XP, level up and build your gamer identity.">
  <meta name="twitter:image" content="https://tu-dominio.com/preview.jpg">
    <!-- TITLE -->
  <title>CYBERCOMM | Gaming Community with XP & Level System</title>

  <!-- META DESCRIPTION -->
  <meta name="description" content="CYBERCOMM is a gaming community where you earn XP, level up, and build your gamer reputation by posting, commenting, and engaging with others.">

  <!-- KEYWORDS (opcional, poco impacto hoy en día) -->
  <meta name="keywords" content="gaming community, XP system, gamer ranking, level up, gaming social network">

  <!-- AUTHOR -->
  <meta name="author" content="CYBERCOMM">
  <link rel="canonical" href="https://tu-dominio.com">
  <link rel="icon" href="/favicon.ico">
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

    <!-- HERO -->
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
          Level up your gaming identity
        </h1>
        <p class="text-[#e5e7eb] text-xl mt-2 max-w-xl mx-auto">
          Join a gaming community where every action earns XP and reputation.
        </p>
        <p class="text-gray-400 text-sm mt-3">
          No passive scrolling. Every post gives you XP.
        </p>
        <a href="{{ route('login') }}" class="px-8 py-4 rounded-full bg-[#6246ea] text-white text-lg hover:bg-[#4f3bd6] hover:shadow-lg transition duration-300 cursor-pointer  min-w-[200px] max-w-xs">
          Start earning XP
        </a>
        <p class="text-gray-400 text-sm mt-4">
          👾 12,340 players already leveling up
        </p>
      </div>
    </section>

    {{-- CARDS SECTION --}}
    <section id="cards-explore" class="w-full h-full flex flex-wrap justify-center items-stretch gap-6 px-6 py-16">

      <div class="card-glass rounded-2xl p-8 w-full max-w-sm flex flex-col">
        <h2 class="text-2xl font-bold text-[#a78bfa] mb-4">Discover. Create. Connect.</h2>
        <p class="text-gray-300 text-sm mb-6 flex-1">Join a vibrant community of gamers and creators. Share your passion, find teammates, and level up your gaming experience.</p>
        <a href="{{ route('login') }}" class="w-full px-4 py-2 bg-[#6246ea] text-white rounded-full hover:bg-[#4f3bd6] transition duration-300 text-center">
          Get Started
        </a>
      </div>

      <div class="card-glass rounded-2xl p-8 w-full max-w-sm flex flex-col">
        <h2 class="text-2xl font-bold text-[#a78bfa] mb-4">Level up your digital world</h2>
        <div class="flex-1 space-y-2 mb-6">
          <p class="text-gray-300 text-sm">🎮 10,000+ players already inside</p>
          <p class="text-gray-300 text-sm">🔥 Trending communities every day</p>
          <p class="text-gray-300 text-sm">⚡ Level-based profiles &amp; XP system</p>
        </div>
        <a href="{{ route('login') }}" class="w-full px-4 py-2 bg-[#6246ea] text-white rounded-full hover:bg-[#4f3bd6] transition duration-300 text-center">
          Join CYBERCOMM
        </a>
      </div>

      <div class="card-glass rounded-2xl p-8 w-full max-w-sm flex flex-col">
        <h2 class="text-2xl font-bold text-[#a78bfa] mb-6">Community Stats</h2>
        <div class="flex-1 space-y-2 text-sm text-gray-300 mt-6">
          <p>👾 1,240 online now</p>
          <p>📝 8,320 posts created</p>
          <p>⚡ 120 active communities</p>
        </div>
        <a href="{{ route('login') }}" class="w-full px-4 py-2 bg-[#6246ea] text-white rounded-full hover:bg-[#4f3bd6] transition duration-300 text-center">
          See Analytics
        </a>
      </div>

    </section>

    {{-- PROGRESSION SECTION --}}
    <section id="section-xp" class="w-full min-h-screen flex flex-col justify-center items-center gap-6 px-6">
  
      <!-- TITLE -->
      <h2 class="text-5xl font-bold text-[#a78bfa] text-center">How progression works</h2>

      <!-- EXPLANATION (AÑADIDO) -->
      <p class="text-white max-w-xl text-center">
        Earn XP by posting, commenting and getting likes. The more you engage, the higher your level and reputation.
      </p>

      <!-- ACTIONS (AÑADIDO) -->
      <div class="grid md:grid-cols-2 gap-4 max-w-3xl w-full mt-6">

        <div class="bg-white/5 border border-white/10 p-4 rounded-xl backdrop-blur-md">
          📝 Post → earn XP
        </div>

        <div class="bg-white/5 border border-white/10 p-4 rounded-xl backdrop-blur-md">
          💬 Comment → gain activity
        </div>

        <div class="bg-white/5 border border-white/10 p-4 rounded-xl backdrop-blur-md">
          🔥 Likes → boost your rank
        </div>

        <div class="bg-white/5 border border-white/10 p-4 rounded-xl backdrop-blur-md">
          🏆 Level up → unlock badges
        </div>

      </div>

      <!-- XP BAR -->
      <div class="flex flex-col gap-2 mt-8">
        <div class="flex justify-between text-base text-gray-400 gap-2">
          <span class="text-[#a78bfa] font-semibold">Level 99</span>
          <span>6,500 / 10,000 XP</span>
        </div>
        <div class="w-full bg-gray-700 rounded-full h-3">
          <div id="xp-bar" class="h-3 bg-[#6246ea] rounded-full transition-none" style="width: 0%"></div>
        </div>
      </div>

      <!-- EXTRA VISUAL (AÑADIDO) -->
      <p class="text-sm text-white mt-4">
        Reach the next level to unlock rewards and increase your visibility.
      </p>

    </section>
    {{-- REPUTACIÓN Y ESTATUS --}}
    <section class="w-full min-h-screen flex flex-col justify-center items-center gap-12 px-6">

      <!-- TITLE -->
      <div class="text-center">
        <h2 class="text-5xl font-bold text-[#a78bfa] text-center">
          Build your gamer identity
        </h2>
        <p class="text-white max-w-xl mx-auto text-center mt-5">
          Your activity defines your reputation. Gain visibility, climb rankings and stand out in the community.
        </p>
      </div>

      <!-- CONTENT -->
      <div class="grid md:grid-cols-2 gap-12 w-full max-w-6xl items-center">

        <!-- LEFT: FEATURES -->
        <div class="flex flex-col gap-4">

          <div class="bg-white/5 border border-white/10 p-5 rounded-xl backdrop-blur-md">
            <p class="text-white font-semibold">👤 Public profiles</p>
            <p class="text-gray-400 text-sm">Show your level, XP and achievements</p>
          </div>

          <div class="bg-white/5 border border-white/10 p-5 rounded-xl backdrop-blur-md">
            <p class="text-white font-semibold">🌍 Global leaderboard</p>
            <p class="text-gray-400 text-sm">Compete with players across the platform</p>
          </div>

          <div class="bg-white/5 border border-white/10 p-5 rounded-xl backdrop-blur-md">
            <p class="text-white font-semibold">🔥 Weekly top players</p>
            <p class="text-gray-400 text-sm">Earn recognition for your activity every week</p>
          </div>

          <div class="bg-white/5 border border-white/10 p-5 rounded-xl backdrop-blur-md">
            <p class="text-white font-semibold">🏅 Exclusive badges</p>
            <p class="text-gray-400 text-sm">Unlock unique rewards as you level up</p>
          </div>

        </div>

        <!-- RIGHT: LEADERBOARD MOCKUP -->
        <div class="bg-white/5 border border-white/10 backdrop-blur-md p-6 rounded-2xl w-full max-w-md mx-auto">

          <h3 class="text-white font-semibold mb-4">Top players this week</h3>

          <div class="flex flex-col gap-3 text-sm">

            <div class="flex justify-between items-center bg-white/5 p-3 rounded-lg">
              <div class="flex items-center gap-3">
                <span>🥇</span>
                <span class="text-white">ShadowX</span>
              </div>
              <span class="text-[#a78bfa]">Lv. 28</span>
            </div>

            <div class="flex justify-between items-center bg-white/5 p-3 rounded-lg">
              <div class="flex items-center gap-3">
                <span>🥈</span>
                <span class="text-white">NovaFPS</span>
              </div>
              <span class="text-[#a78bfa]">Lv. 24</span>
            </div>

            <div class="flex justify-between items-center bg-white/5 p-3 rounded-lg">
              <div class="flex items-center gap-3">
                <span>🥉</span>
                <span class="text-white">PixelWarrior</span>
              </div>
              <span class="text-[#a78bfa]">Lv. 22</span>
            </div>

            <div class="flex justify-between items-center bg-white/5 p-3 rounded-lg">
              <div class="flex items-center gap-3">
                <span>#4</span>
                <span class="text-white">You?</span>
              </div>
              <span class="text-gray-400">Lv. ?</span>
            </div>

          </div>

        </div>

      </div>

      <!-- EXTRA HOOK -->
      <p class="text-white text-center max-w-md">
        The more you contribute, the more visible and respected you become.
      </p>

    </section>

    {{-- DIFERENCIACIÓN --}}
    <section class="w-full min-h-screen flex flex-col justify-center items-center gap-12 px-6">

      <!-- TITLE -->
      <div class="text-center">
        <h2 class="text-5xl font-bold text-[#a78bfa] mb-4">
          Not just another community
        </h2>
        <p class="text-white max-w-xl mx-auto">
          Unlike Discord or Reddit, every interaction here has meaning, progression and reward.
        </p>
      </div>

      <!-- COMPARISON -->
      <div class="grid md:grid-cols-2 gap-6 w-full max-w-5xl">

        <!-- OLD STYLE -->
        <div class="bg-white/5 border border-white/10 backdrop-blur-md p-6 rounded-xl">
          <p class="text-white font-semibold mb-3">Traditional platforms</p>

          <p class="text-gray-400 text-sm mb-2">❌ No progression system</p>
          <p class="text-gray-400 text-sm mb-2">❌ Passive scrolling</p>
          <p class="text-gray-400 text-sm mb-2">❌ No identity growth</p>
          <p class="text-gray-400 text-sm">❌ Content gets lost</p>
        </div>

        <!-- YOUR PLATFORM -->
        <div class="bg-white/5 border border-[#a78bfa]/30 backdrop-blur-md p-6 rounded-xl">
          <p class="text-[#a78bfa] font-semibold mb-3">CYBERCOMM</p>

          <p class="text-gray-300 text-sm mb-2">✔ Every action gives XP</p>
          <p class="text-gray-300 text-sm mb-2">✔ Active progression system</p>
          <p class="text-gray-300 text-sm mb-2">✔ Evolving gamer identity</p>
          <p class="text-gray-300 text-sm">✔ Visibility through ranking</p>
        </div>

      </div>

      <!-- HOOK -->
      <p class="text-white text-center max-w-md">
        Your activity should mean something — not disappear into the feed.
      </p>

    </section>

    {{-- CONFIANZA --}}
    <section class="w-full min-h-screen flex flex-col justify-center items-center gap-12 px-6">

      <!-- TITLE -->
      <div class="text-center">
        <h2 class="text-5xl font-bold text-[#a78bfa] mb-4">
          A safe place to grow
        </h2>
        <p class="text-white max-w-xl mx-auto">
          We care about building a healthy gaming community where everyone can participate safely.
        </p>
      </div>

      <!-- FEATURES -->
      <div class="grid md:grid-cols-3 gap-6 w-full max-w-5xl">

        <div class="bg-white/5 border border-white/10 p-6 rounded-xl backdrop-blur-md text-center">
          <p class="text-2xl mb-2">🛡️</p>
          <p class="text-white font-semibold">Moderation system</p>
          <p class="text-gray-400 text-sm mt-2">Content is monitored to keep the community healthy</p>
        </div>

        <div class="bg-white/5 border border-white/10 p-6 rounded-xl backdrop-blur-md text-center">
          <p class="text-2xl mb-2">🔒</p>
          <p class="text-white font-semibold">Safe environment</p>
          <p class="text-gray-400 text-sm mt-2">Designed to reduce toxicity and spam</p>
        </div>

        <div class="bg-white/5 border border-white/10 p-6 rounded-xl backdrop-blur-md text-center">
          <p class="text-2xl mb-2">🚩</p>
          <p class="text-white font-semibold">Report tools</p>
          <p class="text-gray-400 text-sm mt-2">Users can easily report inappropriate behavior</p>
        </div>

      </div>

      <!-- TRUST HOOK -->
      <p class="text-white text-center max-w-md">
        A strong community starts with respect, safety and moderation.
      </p>

    </section>

    {{-- CTA FINAL --}}
    <section class="w-full min-h-screen flex flex-col justify-center items-center text-center px-6 gap-8">

      <!-- HEADLINE -->
      <h2 class="text-5xl font-bold text-[#a78bfa]">
        Ready to level up your gaming identity?
      </h2>

      <p class="text-white max-w-xl">
        Join CYBERCOMM and turn your activity into reputation, status and progression.
      </p>

      <!-- BUTTONS -->
      <div class="flex flex-col sm:flex-row gap-4">

        <a href="{{ route('login') }}"
          class="px-6 py-3 rounded-full bg-[#6246ea] text-white font-semibold hover:bg-[#4f3bd6] transition">
          Join now
        </a>

        <a href="#section-xp"
          class="px-6 py-3 rounded-full border border-[#a78bfa] text-[#a78bfa] hover:bg-[#a78bfa]/10 transition">
          Start earning XP
        </a>

      </div>

      <!-- MICRO TRUST -->
      <p class="text-white text-sm">
        Free to join • No pay-to-win • Built for gamers
      </p>

    </section>

    {{-- FOOTER --}}
    <footer class="w-full bg-black/30 backdrop-blur-md border-t border-white/10 mt-20">

      <div class="max-w-4xl mx-auto px-6 py-12 grid md:grid-cols-4 gap-8">

        <!-- BRAND -->
        <div>
          <h3 class="text-[#a78bfa] font-bold text-xl">CYBERCOMM</h3>
          <p class="text-gray-400 text-sm mt-2">
            Level up your gaming identity.
          </p>
        </div>

        <!-- PRODUCT -->
        <div>
          <p class="text-white font-semibold mb-3">Product</p>
          <ul class="text-gray-400 text-sm space-y-2">
            <li>XP System</li>
            <li>Level Progression</li>
            <li>Leaderboard</li>
            <li>Badges</li>
          </ul>
        </div>

        <!-- COMMUNITY -->
        <div>
          <p class="text-white font-semibold mb-3">Community</p>
          <ul class="text-gray-400 text-sm space-y-2">
            <li>Explore</li>
            <li>Leaderboard</li>
            <li>Guidelines</li>
            <li>Support</li>
          </ul>
        </div>

        <!-- LEGAL -->
        <div>
          <p class="text-white font-semibold mb-3">Legal</p>
          <ul class="text-gray-400 text-sm space-y-2">
            <li>Privacy Policy</li>
            <li>Terms of Service</li>
            <li>Report Abuse</li>
          </ul>
        </div>

      </div>

      <!-- BOTTOM BAR -->
      <div class="border-t border-white/10 py-4 text-center text-gray-500 text-sm">
       <span id="year"></span>
      </div>

    </footer>
  </div>

  <script>
    const yearSpan = document.getElementById('year');
    const currentYear = new Date().getFullYear();
    yearSpan.textContent = `© ${currentYear} CYBERCOMM. All rights reserved.`;

    // Mouse parallax suave — los blobs siguen el cursor levemente
    const blobs = [
      { el: document.querySelector('.blob-a'), strength: 0.015 },
      { el: document.querySelector('.blob-b'), strength: -0.012 },
      { el: document.querySelector('.blob-c'), strength: 0.02  },
      { el: document.querySelector('.blob-d'), strength: -0.018 },
    ];

    let mouseX = 0;
    let mouseY = 0;
    const currentPos = blobs.map(() => ({ x: 0, y: 0 }));

    document.addEventListener('mousemove', (e) => {
      mouseX = e.clientX - window.innerWidth  / 2;
      mouseY = e.clientY - window.innerHeight / 2;
    });

    function animate() {
      blobs.forEach((b, i) => {
        if (!b.el) return;
        const targetX = mouseX * b.strength;
        const targetY = mouseY * b.strength;
        // Lerp suave para que el movimiento sea fluido
        currentPos[i].x += (targetX - currentPos[i].x) * 0.05;
        currentPos[i].y += (targetY - currentPos[i].y) * 0.05;
        b.el.style.marginLeft = currentPos[i].x + 'px';
        b.el.style.marginTop  = currentPos[i].y + 'px';
      });
      requestAnimationFrame(animate);
    }
    animate();

    document.addEventListener('DOMContentLoaded', () => {
      const bar = document.getElementById('xp-bar');
      const xpActual = 6500;
      const xpTotal = 10000;
      const porcentaje = (xpActual / xpTotal) * 100;

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            requestAnimationFrame(() => { // Ejectura este código justo antes de pintar el siguiente frame para asegurar que el DOM esté listo
              requestAnimationFrame(() => { // Frame 2 para garantizar que el estilo 'transition-none' se haya aplicado antes de cambiar a 'transition-all'
                bar.classList.remove('transition-none');
                bar.classList.add('transition-all', 'duration-1000', 'ease-out');
                bar.style.width = porcentaje + '%';
              });
            });

            observer.disconnect(); // Dispara solo una vez

          }
        });
      }, { threshold: 0.4 }); // Arranca cuando se ve un 40% del contenedor
      observer.observe(document.getElementById('section-xp'));
    });
  </script>

</body>
</html>