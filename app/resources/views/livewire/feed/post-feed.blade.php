<div>
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
                          {{ $post->user->username }}
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
              <img src="{{ asset('storage/' . $post->image) }}" class="mt-2 rounded-lg">
          @endif
  
          <div class="flex gap-4 mt-4 text-sm text-gray-400">
              <button class="hover:text-pink-400">❤️ {{ $post->likes->count() ?? 0 }}</button>
              <button class="hover:text-cyan-400">💬 {{ $post->comments->count() ?? 0 }}</button>
          </div>
  
      </div>
  @endforeach
  <div class="m-5">
      {{ $posts->links() }}
  </div>
</div>