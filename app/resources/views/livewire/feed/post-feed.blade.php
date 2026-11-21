<div>
  @foreach ($posts as $post)
      <div wire:key="post-item-{{ $post->id }}-{{ $post->updated_at->timestamp }}" class="post mb-3 relative">
          <div class="flex items-center gap-3 mb-2">
  
              <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#a78bfa] to-fuchsia-500"></div>
  
              <div>
                  <div class="flex items-center gap-2">
                      <div class="w-2 h-2 rounded-full
                          {{ $post->user->isOnline() ? 'bg-green-400' : 'bg-gray-500' }}">
                      </div>
  
                      <span class="text-sm text-cyan-300">
                          <a href="{{ route('profile', $post->user->id) }}">{{ $post->user->username }}</a>                          
                      </span>
                  </div>
  
                  <p class="text-xs text-purple-400">
                      {{ $post->user->role ?? 'Member' }}
                  </p>
  
                  <p class="text-xs text-gray-500">
                      {{ $post->created_at->diffForHumans() }}

                      @if ($post->updated_at->gt($post->created_at))
                          <span class="text-gray-400">(editado)</span>
                      @endif
                  </p>
                  
              </div>
          </div>
          @if ($editingPostId === $post->id)
            <div class="mt-2">
              <textarea wire:model="content" class="w-full rounded-lg bg-gray-800 border border-gray-700 p-3 text-sm" rows="4">
              </textarea>

              <input
                  type="file"
                  wire:model="image"
                  class="mt-3 block w-full text-sm">

              @if ($image)
                  <img
                      src="{{ $image->temporaryUrl() }}"
                      class="w-full max-w-sm mt-3 rounded-lg border border-cyan-500">
              @endif

              <div class="flex gap-2 mt-2">
                <button wire:click="saveEdit"
                class="px-3 py-1 bg-cyan-600 hover:bg-cyan-700 rounded text-white text-sm">
                  Save
                </button>
                <button wire:click="$set('editingPostId', null)" class="px-3 py-1 bg-gray-600 hover:bg-gray-700 rounded text-white text-sm">
                  Cancel
                </button>
              </div>
            </div>
          @else 
            <p class="text-sm">
                {{ $post->content }}
            </p>
          @endif
  
          @if ($post->image)
              <img src="{{ asset('storage/' . $post->image) }}" class="w-full max-w-sm mt-3 rounded-lg border border-white/5 object-cover">
          @endif
  
          <div class="flex gap-4 mt-4 text-sm text-gray-400">
              <livewire:interactions.like-button :post="$post" wire:key="like-button-{{ $post->id }}" />
              <button class="btnComment hover:text-cyan-400 cursor-pointer" data-post="{{ $post->id }}">💬 {{ $post->comments->count() ?? 0 }}</button>
              <button class="hover:text-green-400 transition">🔁 Share</button>
          </div>
          @if ($post->user_id === auth()->id())
          <div class="flex items-center gap-3">          
              <button wire:click="deletePost({{ $post->id }})" class="text-red-400 hover:text-red-600 transition duration-300 cursor-pointer mt-3">Delete</button>
              <button wire:click="startEditing({{ $post->id }})" class="aboslute text-gray-400 hover:text-cyan-400 transition cursor-pointer mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
              </button>
          </div>
          @endif
          <livewire:interactions.comment-box :post="$post" :key="'comment-box-' . $post->id" />
      </div>
  @endforeach
  <div class="m-5">
      {{ $posts->links() }}
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {

    const comments = document.querySelectorAll('.post-comments');
    const btnComments = document.querySelectorAll('.btnComment');
  
    btnComments.forEach((btn, index) => {
      btn.addEventListener('click', function() {
        if(comments[index]) {
          comments[index].classList.toggle('show');
        }
      });
    });
    
  });
</script>
