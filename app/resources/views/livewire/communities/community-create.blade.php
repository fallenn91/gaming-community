<div class="max-w-lg mx-auto">

  <form wire:submit.prevent="create"
        class="bg-black/20 border border-white/10 rounded-2xl p-5 flex flex-col gap-4 backdrop-blur-md">

    <h2 class="text-lg text-[#a78bfa] font-semibold">
      Create Community
    </h2>

    <!-- NAME -->
    <div class="flex flex-col gap-1">
      <label class="text-xs text-gray-400">Name</label>

      <input
        type="text"
        wire:model.live="name"
        placeholder="Community name"
        class="w-full p-2 bg-black/40 border border-white/10 rounded-lg text-sm
               focus:ring-2 focus:ring-[#a78bfa]"
      >
    </div>

    <!-- DESCRIPTION -->
    <textarea
      wire:model="description"
      placeholder="What's your community about?"
      class="w-full p-2 bg-black/40 border border-white/10 rounded-lg text-sm h-24
             focus:ring-2 focus:ring-[#a78bfa]"
    ></textarea>

    <!-- GAME SELECT -->
    <div class="flex flex-col gap-1">
      <label class="text-xs text-gray-400">Related Game (optional)</label>

      <select wire:model="game_id"
              class="w-full p-2 bg-black/40 border border-white/10 rounded-lg text-sm">
        <option value="">None</option>
        @foreach($games as $game)
          <option value="{{ $game->id }}">{{ $game->name }}</option>
        @endforeach
      </select>
    </div>

    <!-- IMAGE -->
    <div class="flex flex-col gap-1">
      <label class="text-xs text-gray-400">Image</label>

      <input type="file"
             wire:model="image"
             class="text-sm text-gray-400">
    </div>

    <!-- TAGS -->
    <input
      type="text"
      wire:model="tags"
      placeholder="Tags (e.g. gaming, indie, chill)"
      class="w-full p-2 bg-black/40 border border-white/10 rounded-lg text-sm"
    >

    <!-- PREVIEW -->
    <div class="p-3 bg-black/30 border border-white/10 rounded-lg text-xs">
      <p class="text-[#a78bfa] font-semibold">
        Preview:
      </p>

      <p class="text-white">
        {{ $name ?: 'Community name...' }}
      </p>

      <p class="text-gray-400">
        {{ $description ?: 'Description...' }}
      </p>

      @if($tags)
        <p class="text-gray-500 mt-1">
          #{{ str_replace(',', ' #', $tags) }}
        </p>
      @endif
    </div>

    <!-- BUTTON -->
    <button type="submit"
            class="bg-[#6246ea] hover:bg-[#7c5cff] transition
                   px-4 py-2 rounded-lg text-sm font-medium cursor-pointer hover:bg-[#8b5cf6] transition duration-300">
      Create Community
    </button>

  </form>

</div>