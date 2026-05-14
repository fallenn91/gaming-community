<button
    wire:click="toggleFollow"
    wire:loading.attr="disabled"
    class="px-4 py-1.5 rounded-full text-sm font-medium text-white transition duration-200"
    style="background: linear-gradient(135deg, #8b5cf6, #6246ea);"
    onmouseover="this.style.boxShadow='0 0 20px rgba(139,92,246,0.5)'"
    onmouseout="this.style.boxShadow='none'"
>
    <span wire:loading.remove>
        {{ $isFollowing ? 'Following' : 'Follow' }}
    </span>

    <span wire:loading>
        Loading...
    </span>
</button>