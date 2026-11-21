<div class="flex items-center gap-2">
    <button
        wire:click="vote('upvote')"
        class="transition {{ $myVote === 'upvote' ? 'text-green-400' : 'text-gray-500 hover:text-green-400' }}"
        {{ $myVote ? 'disabled' : '' }}
    >▲</button>

    <span class="text-sm font-bold text-white">{{ $reputation }}</span>

    <button
        wire:click="vote('downvote')"
        class="transition {{ $myVote === 'downvote' ? 'text-red-400' : 'text-gray-500 hover:text-red-400' }}"
        {{ $myVote ? 'disabled' : '' }}
    >▼</button>

    @if ($errorMessage)
        <span class="text-xs text-red-400">{{ $errorMessage }}</span>
    @endif
</div>