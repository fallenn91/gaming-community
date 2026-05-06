<div class="post-comments bg-[#6366f1]/20 mt-4 rounded-lg border border-[#ddd6fe]/30 p-3">
  @error('content') <span>{{ $message }}</span> @enderror

  <div class="space-y-2">
    @foreach($comments as $comment)
      <div class="flex gap-3">
        <strong class="text-cyan-300">{{ $comment->user->username}}: </strong>
        <p class="text-white">{{ $comment->content }}</p>

        @if ($comment->user_id === auth()->id())
            <button wire:click="deleteComment({{ $comment->id }})" class="text-red-400 hover:text-red-600 transition duration-300 cursor-pointer">Delete</button>
        @endif
      </div>
    @endforeach
  </div>
  <form wire:submit.prevent="addComment" class="mt-3">
    <input type="text" wire:model="content" placeholder="Write new comment...">
    <button type="submit" class="hover:text-[var(--primary)] transition duration-300 cursor-pointer">Comment</button>
  </form>
</div>
