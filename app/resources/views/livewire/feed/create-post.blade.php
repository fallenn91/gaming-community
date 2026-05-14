<form wire:submit.prevent="createPost" class="post">

  <textarea 
    wire:model="content"
    placeholder="What are you playing?" 
    class="w-full p-2 bg-black/30 rounded mb-3">
  </textarea>

  @error('content')
    <p class="text-red-400 text-xs mb-2">{{ $message }}</p>
  @enderror

  <input type="file" wire:model="image">

  @if ($image)
    <img src="{{ $image->temporaryUrl() }}" class="mt-2 rounded w-32">
  @endif

  <div class="flex justify-between items-center mt-3">

    <div class="text-xs text-gray-400 flex gap-2">
      <span>+ Image</span>
      <span>+ tag</span>
    </div>

    <button type="submit" class="bg-[#6246ea] px-4 py-2 rounded-full cursor-pointer hover:bg-[#8b5cf6] transition duration-300">
      Post
    </button>

  </div>

</form>