<div class="w-full">
    @if ($success)
        <div class="mb-4 px-4 py-3 rounded-xl text-sm relative overflow-hidden"
            style="
                background: rgba(139,92,246,0.12);
                border: 1px solid rgba(217,70,239,0.35);
                color: #ddd6fe;
                backdrop-filter: blur(12px);
                box-shadow: 0 8px 30px rgba(0,0,0,0.35);
            ">

            {{-- glow effect --}}
            <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full pointer-events-none"
                style="
                    background: radial-gradient(circle, rgba(217,70,239,0.4) 0%, transparent 70%);
                    filter: blur(20px);
                ">
            </div>

            <div class="absolute -bottom-10 -left-10 w-32 h-32 rounded-full pointer-events-none"
                style="
                    background: radial-gradient(circle, rgba(139,92,246,0.5) 0%, transparent 70%);
                    filter: blur(20px);
                ">
            </div>

            {{-- content --}}
            <div class="flex items-center gap-2 relative z-10">
                <span class="text-purple-300">⚡</span>

                <span class="font-semibold" style="color:#ddd6fe;">
                    {{ $message }}
                </span>
            </div>

        </div>
    @endif
    {{-- HEADER --}}
    <div class="rounded-2xl overflow-hidden"
         style="background: rgba(255,255,255,0.07); backdrop-filter: blur(16px); border: 1px solid rgba(139,92,246,0.35); box-shadow: 0 8px 40px rgba(0,0,0,0.4);">

        {{-- BANNER PREVIEW --}}
        <div class="h-40 relative overflow-hidden p-4"
             style="background: linear-gradient(135deg, #100828 0%, #1e0f45 50%, #100828 100%);">

            @if($banner)
                <img src="{{ $banner->temporaryUrl() }}"
                     class="absolute inset-0 w-full h-full object-cover">
            @elseif(auth()->user()->banner)
                <img src="{{ asset('storage/' . auth()->user()->banner) }}"
                     class="absolute inset-0 w-full h-full object-cover">
            @endif

            <label class="absolute right-4 bottom-4 px-4 py-2 rounded-lg cursor-pointer text-sm"
                   style="background: rgba(139,92,246,0.25); border:1px solid rgba(139,92,246,.5); color:#ddd6fe;">
                Change Banner
                <input type="file" wire:model="banner" class="hidden">
            </label>
        </div>

        {{-- PROFILE --}}
        <div class="px-6 p-4 relative">

            {{-- AVATAR --}}
            <div class="absolute -top-12">

                <div class="w-24 h-24 rounded-full p-[2px]"
                     style="background: linear-gradient(135deg, #8b5cf6, #d946ef);">

                    <div class="w-full h-full rounded-full overflow-hidden bg-[#100828]">

                        @if($avatar)
                            <img src="{{ $avatar->temporaryUrl() }}"
                                 class="w-full h-full object-cover">
                        @elseif(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                 class="w-full h-full object-cover">
                        @endif

                    </div>
                </div>

                <label class="absolute bottom-0 right-0 w-8 h-8 rounded-full flex items-center justify-center cursor-pointer"
                       style="background:#8b5cf6;">
                    📷
                    <input type="file" wire:model="avatar" class="hidden">
                </label>

            </div>

            <div class="pt-16">
                <h2 class="text-xl font-bold"
                    style="color:#ddd6fe;">
                    Edit Profile
                </h2>

                <p class="text-sm"
                   style="color:rgba(217,70,239,.8)">
                    Customize your gaming identity
                </p>
            </div>

        </div>
    </div>

    {{-- FORM --}}
    <form wire:submit.prevent="editUser" class="mt-6 space-y-5">

        {{-- BASIC INFO --}}
        <div class="rounded-2xl p-6"
             style="background: rgba(255,255,255,0.07); backdrop-filter: blur(16px); border:1px solid rgba(139,92,246,.35);">

            <h3 class="font-semibold mb-5"
                style="color:#ddd6fe;">
                Basic Information
            </h3>

            <div class="grid md:grid-cols-2 gap-4">

                <div>
                    <label class="text-sm block mb-2"
                           style="color:rgba(217,70,239,.8)">
                        Display Name
                    </label>

                    <input type="text"
                           wire:model="name"
                           class="w-full rounded-xl px-4 py-3 bg-transparent outline-none"
                           style="border:1px solid rgba(139,92,246,.35); color:#ddd6fe;">

                    @error('name')
                        <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="text-sm block mb-2"
                           style="color:rgba(217,70,239,.8)">
                        Username
                    </label>

                    <input type="text"
                           wire:model="username"
                           class="w-full rounded-xl px-4 py-3 bg-transparent outline-none"
                           style="border:1px solid rgba(139,92,246,.35); color:#ddd6fe;">

                    @error('username')
                        <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>

        {{-- ACCOUNT --}}
        <div class="rounded-2xl p-6"
             style="background: rgba(255,255,255,0.07); backdrop-filter: blur(16px); border:1px solid rgba(139,92,246,.35);">

            <h3 class="font-semibold mb-5"
                style="color:#ddd6fe;">
                Account
            </h3>

            <div class="space-y-4">

                <div>
                    <label class="text-sm block mb-2"
                           style="color:rgba(217,70,239,.8)">
                        Email
                    </label>

                    <input type="email"
                           wire:model="email"
                           class="w-full rounded-xl px-4 py-3 bg-transparent outline-none"
                           style="border:1px solid rgba(139,92,246,.35); color:#ddd6fe;">
                </div>

                <div>
                    <label class="text-sm block mb-2"
                           style="color:rgba(217,70,239,.8)">
                        New Password
                    </label>

                    <input type="password"
                           wire:model="password"
                           placeholder="Leave blank to keep current password"
                           class="w-full rounded-xl px-4 py-3 bg-transparent outline-none"
                           style="border:1px solid rgba(139,92,246,.35); color:#ddd6fe;">
                </div>

            </div>
        </div>

        {{-- BIO --}}
        <div class="rounded-2xl p-6"
             style="background: rgba(255,255,255,0.07); backdrop-filter: blur(16px); border:1px solid rgba(139,92,246,.35);">

            <h3 class="font-semibold mb-5"
                style="color:#ddd6fe;">
                Bio
            </h3>

            <textarea
                wire:model="bio"
                rows="5"
                class="w-full rounded-xl px-4 py-3 bg-transparent outline-none resize-none"
                style="border:1px solid rgba(139,92,246,.35); color:#ddd6fe;"
                placeholder="Tell the world who you are..."></textarea>

        </div>

        {{-- SAVE BUTTON --}}
        <div class="flex justify-end">

            <button type="submit"
                    class="px-8 py-3 rounded-xl font-semibold transition cursor-pointer"
                    style="background: linear-gradient(135deg,#8b5cf6,#d946ef); color:white;">

                Save Changes

            </button>

        </div>

    </form>

</div>