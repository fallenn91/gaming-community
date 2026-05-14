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

<body class="auth relative overflow-hidden" style="background: #100828;">

  <!-- Blobs de fondo — misma paleta que la landing -->
  <div class="fixed -z-10 pointer-events-none"
       style="width:700px;height:700px;top:-200px;left:-200px;
              background:radial-gradient(circle, rgba(139,92,246,0.6) 0%, transparent 65%);
              filter:blur(80px);">
  </div>
  <div class="fixed -z-10 pointer-events-none"
       style="width:500px;height:500px;bottom:-150px;right:-150px;
              background:radial-gradient(circle, rgba(217,70,239,0.55) 0%, transparent 65%);
              filter:blur(75px);">
  </div>
  <div class="fixed -z-10 pointer-events-none"
       style="width:300px;height:300px;top:40%;left:55%;
              background:radial-gradient(circle, rgba(99,102,241,0.4) 0%, transparent 70%);
              filter:blur(60px);">
  </div>

  <!-- Overlay sutil -->
  <div class="fixed inset-0 -z-10" style="background: rgba(16,8,40,0.45); backdrop-filter: blur(2px);"></div>

  <main class="h-screen flex items-center justify-center px-4 py-24">

    @if (session('message'))
      <div class="fixed top-4 left-1/2 -translate-x-1/2 px-4 py-2 rounded-lg text-sm font-medium z-50"
           style="background: rgba(139,92,246,0.2); border: 1px solid rgba(139,92,246,0.5); color: #ddd6fe;">
        {{ session('message') }}
      </div>
    @endif

    @if (session('error'))
      <div class="fixed top-4 left-1/2 -translate-x-1/2 px-4 py-2 rounded-lg text-sm font-medium z-50"
           style="background: rgba(217,70,239,0.15); border: 1px solid rgba(217,70,239,0.4); color: #f0abfc;">
        {{ session('error') }}
      </div>
    @endif

    <div class="form-login w-full max-w-[380px] p-6 rounded-2xl text-white"
         style="
           background: rgba(255,255,255,0.07);
           backdrop-filter: blur(20px);
           -webkit-backdrop-filter: blur(20px);
           border: 1px solid rgba(139,92,246,0.45);
           box-shadow: 0 8px 60px rgba(0,0,0,0.5),
                       0 0 0 1px rgba(255,255,255,0.04) inset,
                       0 0 80px rgba(139,92,246,0.15) inset;
         ">

      <!-- Logo -->
      <div class="text-center mb-6">
        <span class="text-lg font-bold tracking-widest"
              style="color: #ddd6fe; text-shadow: 0 0 20px rgba(139,92,246,0.8);">
          CYBERCOMM
        </span>
      </div>

      <!-- Tabs -->
      <div class="relative flex mb-6">
        <button id="tab-login"
                class="flex-1 py-2 text-white transition-colors"
                onclick="switchTab('login')">
          Login
        </button>
        <button id="tab-register"
                class="flex-1 py-2 text-gray-400 transition-colors"
                onclick="switchTab('register')">
          Register
        </button>
        <div id="tab-indicator"
             class="absolute bottom-0 left-0 h-[2px] w-1/2 transition-transform duration-300"
             style="background: linear-gradient(90deg, rgba(139,92,246,0.8), rgba(217,70,239,0.8));">
        </div>
      </div>

      <!-- LOGIN -->
      <div id="section-login" class="flex flex-col justify-center items-center">
        <form method="POST" action="{{ route('login') }}" class="w-full">
          @csrf

          <input
            class="w-full mb-3 p-2 rounded-lg text-white text-sm outline-none transition"
            style="background: rgba(16,8,40,0.6); border: 1px solid rgba(139,92,246,0.4);"
            onfocus="this.style.borderColor='rgba(139,92,246,0.9)'; this.style.boxShadow='0 0 0 3px rgba(139,92,246,0.15)'"
            onblur="this.style.borderColor='rgba(139,92,246,0.4)'; this.style.boxShadow='none'"
            placeholder="Email"
            type="email"
            name="email"
          >

          <input
            class="w-full mb-4 p-2 rounded-lg text-white text-sm outline-none transition"
            style="background: rgba(16,8,40,0.6); border: 1px solid rgba(139,92,246,0.4);"
            onfocus="this.style.borderColor='rgba(139,92,246,0.9)'; this.style.boxShadow='0 0 0 3px rgba(139,92,246,0.15)'"
            onblur="this.style.borderColor='rgba(139,92,246,0.4)'; this.style.boxShadow='none'"
            placeholder="Password"
            type="password"
            name="password"
          >

          <div class="flex items-center gap-2 w-full mb-4">
            <input type="checkbox" id="remember" class="w-4 h-4 cursor-pointer rounded"
                   style="accent-color: #8b5cf6;">
            <label for="remember" class="text-sm cursor-pointer" style="color: rgba(221,214,254,0.6);">
              Recordarme
            </label>
          </div>

          <button type="submit"
                  class="w-full py-3 rounded-full text-white font-medium transition duration-300"
                  style="background: linear-gradient(135deg, #8b5cf6, #6246ea);"
                  onmouseover="this.style.boxShadow='0 0 30px rgba(139,92,246,0.5)'; this.style.opacity='0.9'"
                  onmouseout="this.style.boxShadow='none'; this.style.opacity='1'">
            Enter
          </button>
        </form>
      </div>

      <!-- REGISTER -->
      <div id="section-register" class="hidden flex flex-col items-center">
        <form method="POST" action="{{ route('register') }}" class="w-full">
          @csrf

          @foreach([['Name','text','name'],['Username','text','username'],['Email','email','email'],['Password','password','password'],['Confirm Password','password','password_confirmation']] as [$placeholder, $type, $name])
          <input
            class="w-full mb-3 p-2 rounded-lg text-white text-sm outline-none transition"
            style="background: rgba(16,8,40,0.6); border: 1px solid rgba(139,92,246,0.4);"
            onfocus="this.style.borderColor='rgba(139,92,246,0.9)'; this.style.boxShadow='0 0 0 3px rgba(139,92,246,0.15)'"
            onblur="this.style.borderColor='rgba(139,92,246,0.4)'; this.style.boxShadow='none'"
            placeholder="{{ $placeholder }}"
            type="{{ $type }}"
            name="{{ $name }}"
          >
          @endforeach

          <button type="submit"
                  class="w-full py-3 rounded-full text-white font-medium transition duration-300 mt-1"
                  style="background: linear-gradient(135deg, #8b5cf6, #6246ea);"
                  onmouseover="this.style.boxShadow='0 0 30px rgba(139,92,246,0.5)'; this.style.opacity='0.9'"
                  onmouseout="this.style.boxShadow='none'; this.style.opacity='1'">
            Register
          </button>
        </form>
      </div>

    </div>
  </main>
</body>
</html>