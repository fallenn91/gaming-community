<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
<script>
  function switchTab(tab) {
    const isLogin = tab === 'login';

    document.getElementById('section-login').classList.toggle('hidden', !isLogin);
    document.getElementById('section-register').classList.toggle('hidden', isLogin);

    document.getElementById('tab-indicator').style.transform = isLogin ? 'translateX(0%)' : 'translateX(100%)';

    document.getElementById('tab-login').className = `flex-1 py-2 border-b-2 transition-colors ${isLogin ? 'border-white text-white' : 'border-transparent text-gray-400'}`;
    document.getElementById('tab-register').className = `flex-1 py-2 border-b-2 transition-colors ${!isLogin ? 'border-white text-white' : 'border-transparent text-gray-400'}`;
  }
</script>
<body class="auth relative overflow-hidden">

  <!-- overlay -->
  <div class="fixed inset-0 bg-black/30 backdrop-blur-sm -z-10"></div>

  <main class="h-screen flex items-center justify-center px-[50px] py-24">
    @if (session('message'))
        <div class="bg-green-400 border border-green-800">
            {{ session('message') }}
        </div>
    @endif
    @if (session('error'))
      <div class="bg-red-400">
          {{ session('error') }}
      </div>
    @endif
    <div class="form-login w-full max-w-[380px] gap-5 p-6 
                border border-[#6246ea] rounded-xl
                bg-white/10 backdrop-blur-md text-white
                shadow-[0_8px_60px_25px_rgba(191,178,255,0.4)] h-[450px]">

    <!-- Tabs -->
      <div class="relative flex mb-6">
        <button id="tab-login" class="flex-1 py-2 text-white transition-colors" onclick="switchTab('login')">Login</button>
        <button id="tab-register" class="flex-1 py-2 text-gray-400 transition-colors" onclick="switchTab('register')">Register</button>
        <div id="tab-indicator" class="absolute bottom-0 left-0 h-[2px] w-1/2 bg-white transition-transform duration-300"></div>
      </div>
      <!-- Avatar preview -->
      <div id="section-login" class="flex flex-col justify-center items-center mb-4 min-h-[300px]">

      <form method="POST" action="{{ route('login') }}" class="w-full">
        @csrf

        <input
          class="w-full mb-3 p-2 bg-black/30 border border-[#a78bfa] rounded-lg text-white"
          placeholder="Email"
          type="email"
          name="email"
        >

        <input
          class="w-full mb-4 p-2 bg-black/30 border border-[#a78bfa] rounded-lg text-white"
          placeholder="Password"
          type="password"
          name="password"
        >

        <div class="flex items-center gap-2 w-full mb-3">
          <input type="checkbox" id="remember" class="accent-[#6246ea] w-4 h-4 cursor-pointer">
          <label for="remember" class="text-sm text-gray-400 cursor-pointer">Recordarme</label>
        </div>

        <button type="submit"
          class="w-full p-4 rounded-full bg-[#6246ea] text-white text-lg
          hover:bg-[#4f3bd6] hover:shadow-lg transition duration-300">
          Enter
        </button>
      </form>

      </div>

      <!-- REGISTER -->
      <div id="section-register" class="hidden flex flex-col items-center mb-4">

        <form method="POST" action="{{ route('register') }}" class="w-full">
          @csrf

          <input
            class="w-full mb-3 p-2 bg-black/30 border border-[#a78bfa] rounded-lg text-white"
            placeholder="Name"
            type="text"
            name="name"
          >

          <input
            class="w-full mb-3 p-2 bg-black/30 border border-[#a78bfa] rounded-lg text-white"
            placeholder="Username"
            type="text"
            name="username"
          >

          <input
            class="w-full mb-3 p-2 bg-black/30 border border-[#a78bfa] rounded-lg text-white"
            placeholder="Email"
            type="email"
            name="email"
          >

          <input
            class="w-full mb-3 p-2 bg-black/30 border border-[#a78bfa] rounded-lg text-white"
            placeholder="Password"
            type="password"
            name="password"
          >

          <input
            class="w-full mb-4 p-2 bg-black/30 border border-[#a78bfa] rounded-lg text-white"
            placeholder="Confirm Password"
            type="password"
            name="password_confirmation"
          >

          <button type="submit"
            class="w-full p-4 rounded-full bg-[#6246ea] text-white text-lg
            hover:bg-[#4f3bd6] hover:shadow-lg transition duration-300">
            Register
          </button>
        </form>

      </div>
    </div>
  </main>
</body>
</html>