<div wire:poll.8s="checkForUpdates">
  @foreach ($posts as $post)
      <div class="post mb-3">
  
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
                  </p>
              </div>
  
          </div>
  
          <p class="text-sm">
              {{ $post->content }}
          </p>
  
          @if ($post->image)
              <img src="{{ asset('storage/' . $post->image) }}" class="w-full max-w-sm mt-3 rounded-lg border border-white/5 object-cover">
          @endif
  
          <div class="flex gap-4 mt-4 text-sm text-gray-400">
              <livewire:interactions.like-button :post="$post" wire:key="like-button-{{ $post->id }}" />
              <button class="btnComment hover:text-cyan-400 cursor-pointer" data-post="{{ $post->id }}">💬 {{ $post->comments->count() ?? 0 }}</button>
              <button class="hover:text-green-400 transition">🔁 Share</button>
          </div>
          @if ($post->user_id === auth()->id())
            <button wire:click="deletePost({{ $post->id }})" class="text-red-400 hover:text-red-600 transition duration-300 cursor-pointer mt-3">Delete</button>
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
