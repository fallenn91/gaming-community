<div class="max-w-2xl mx-auto px-4 py-8">

    <form
        wire:submit.prevent="create"
        class="relative overflow-hidden rounded-3xl border border-white/10 bg-zinc-900/70 p-6 md:p-8 shadow-2xl shadow-black/30 backdrop-blur-xl"
    >

        {{-- Glow --}}
        <div class="absolute inset-0 bg-gradient-to-br from-violet-500/5 via-fuchsia-500/5 to-cyan-500/5"></div>

        <div class="relative z-10 flex flex-col gap-6">

            {{-- Header --}}
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-violet-300">
                    Create Community
                </h2>

                <p class="mt-1 text-sm text-zinc-400">
                    Build your own space for players, creators and fans.
                </p>
            </div>

            {{-- Success --}}
            @if (session()->has('success'))
                <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            {{-- NAME --}}
            <div class="flex flex-col gap-2">
                <label class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Community Name
                </label>

                <input
                    type="text"
                    wire:model.live="name"
                    placeholder="Ex: Indie Gamers Hub"
                    class="w-full rounded-xl border border-white/10 bg-black/40 px-4 py-3 text-sm text-white placeholder:text-zinc-500 focus:border-violet-500/40 focus:outline-none focus:ring-2 focus:ring-violet-500/30"
                >

                @error('name')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div class="flex flex-col gap-2">
                <label class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Description
                </label>

                <textarea
                    wire:model.live="description"
                    placeholder="What's your community about?"
                    class="h-32 w-full rounded-xl border border-white/10 bg-black/40 px-4 py-3 text-sm text-white placeholder:text-zinc-500 focus:border-violet-500/40 focus:outline-none focus:ring-2 focus:ring-violet-500/30"
                ></textarea>

                @error('description')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                @enderror
            </div>

            {{-- VISIBILITY + GAME --}}
            <div class="grid gap-4 md:grid-cols-2">

                {{-- Visibility --}}
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        Visibility
                    </label>

                    <select
                        wire:model="visibility"
                        class="rounded-xl border border-white/10 bg-black/40 px-4 py-3 text-sm text-white focus:border-violet-500/40 focus:outline-none focus:ring-2 focus:ring-violet-500/30"
                    >
                        <option value="public">🌍 Public</option>
                        <option value="private">🔒 Private</option>
                    </select>

                    @error('visibility')
                        <span class="text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Game --}}
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        Related Game
                    </label>

                    <select
                        wire:model="game_id"
                        class="rounded-xl border border-white/10 bg-black/40 px-4 py-3 text-sm text-white focus:border-violet-500/40 focus:outline-none focus:ring-2 focus:ring-violet-500/30"
                    >
                        <option value="">None</option>

                        @foreach($games as $game)
                            <option value="{{ $game->id }}">
                                {{ $game->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('game_id')
                        <span class="text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            {{-- TAGS --}}
            <div class="flex flex-col gap-2">
                <label class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Tags
                </label>

                <input
                    type="text"
                    wire:model.live="tags"
                    placeholder="gaming, indie, chill"
                    class="w-full rounded-xl border border-white/10 bg-black/40 px-4 py-3 text-sm text-white placeholder:text-zinc-500 focus:border-violet-500/40 focus:outline-none focus:ring-2 focus:ring-violet-500/30"
                >

                <p class="text-xs text-zinc-500">
                    Separate tags with commas.
                </p>

                @error('tags')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                @enderror
            </div>

            {{-- IMAGE --}}
            <div class="flex flex-col gap-2">
                <label class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Community Banner
                </label>

                <input
                    type="file"
                    wire:model="image"
                    class="rounded-xl border border-dashed border-white/10 bg-black/20 px-4 py-6 text-sm text-zinc-400 file:mr-4 file:rounded-lg file:border-0 file:bg-violet-500/20 file:px-4 file:py-2 file:text-violet-200 hover:file:bg-violet-500/30"
                >

                @error('image')
                    <span class="text-xs text-red-400">{{ $message }}</span>
                @enderror

                {{-- Preview --}}
                @if ($image)
                    <div class="mt-3 overflow-hidden rounded-2xl border border-white/10">
                        <img
                            src="{{ $image->temporaryUrl() }}"
                            alt="Preview"
                            class="h-52 w-full object-cover"
                        >
                    </div>
                @endif
            </div>

            {{-- LIVE PREVIEW --}}
            <div class="rounded-2xl border border-white/10 bg-black/30 p-5">
                <div class="flex items-start justify-between gap-3">

                    <div>
                        <p class="text-lg font-semibold text-violet-300">
                            {{ $name ?: 'Community name...' }}
                        </p>

                        <p class="mt-1 text-sm text-zinc-400">
                            {{ $description ?: 'Your community description will appear here...' }}
                        </p>
                    </div>

                    <span class="rounded-full border border-violet-500/30 bg-violet-500/10 px-3 py-1 text-xs font-medium text-violet-200">
                        {{ ucfirst($visibility) }}
                    </span>
                </div>

                
            </div>

            {{-- BUTTON --}}
            <button
                type="submit"
                class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-violet-600 to-fuchsia-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-900/30 transition duration-300 hover:scale-[1.01] hover:from-violet-500 hover:to-fuchsia-500"
            >
                <span class="relative z-10">
                    Create Community
                </span>

                <div class="absolute inset-0 bg-white/10 opacity-0 transition duration-300 group-hover:opacity-100"></div>
            </button>

        </div>
    </form>
</div>