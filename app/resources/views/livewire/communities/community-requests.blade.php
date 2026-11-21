<div class="rounded-3xl border border-white/10 bg-black/20 p-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-white">Join requests</h3>
        <span class="rounded-full border border-cyan-400/20 bg-cyan-500/10 px-3 py-1 text-xs font-medium text-cyan-300">
            {{ $requests->count() }} pending
        </span>
    </div>

    @if($requests->isEmpty())
        <p class="mt-4 text-sm text-zinc-400">There are no pending requests right now.</p>
    @else
        <div class="mt-4 space-y-3">
            @foreach($requests as $request)
                <div class="flex flex-col gap-3 rounded-2xl border border-white/10 bg-zinc-900/70 p-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="font-medium text-white">{{ $request->user?->name ?? 'User' }}</p>
                        <p class="text-sm text-zinc-400">Requested to join this community</p>
                    </div>

                    <div class="flex gap-2">
                        <button wire:click="approve({{ $request->id }})" class="rounded-full bg-emerald-600/80 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-500">
                            Approve
                        </button>
                        <button wire:click="deny({{ $request->id }})" class="rounded-full bg-rose-600/80 px-3 py-2 text-sm font-medium text-white hover:bg-rose-500">
                            Deny
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
