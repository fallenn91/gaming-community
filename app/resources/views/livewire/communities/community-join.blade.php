<div class="rounded-2xl border border-white/10 bg-black/20 p-4">
    @if($isMember)
        <div class="text-sm text-emerald-300">
            @if(auth()->check() && auth()->id() === $community->owner_id)
                ✅ You are the owner and already belong to this community.
            @else
                ✅ You are already a member of this community.
            @endif
        </div>
    @elseif($isPending)
        <div class="text-sm text-cyan-300">⏳ Your join request is pending approval.</div>
    @elseif($isRejected)
        <div class="text-sm text-rose-300">🚫 Your previous join request was rejected. You cannot re-request.</div>
    @elseif($isBanned)
        <div class="text-sm text-rose-300">⛔ You have been banned from this community and cannot join.</div>
    @else
        <button wire:click="join" class="rounded-full border border-cyan-400/30 bg-cyan-400/10 px-4 py-2 text-sm font-medium text-cyan-300 transition hover:bg-cyan-400/20">
            Join community
        </button>
    @endif
</div>
