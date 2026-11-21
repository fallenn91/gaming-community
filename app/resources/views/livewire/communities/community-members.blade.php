<div class="rounded-3xl border border-white/10 bg-black/20 p-5">
    <h3 class="text-lg font-semibold text-white">Members</h3>
    <div class="mt-4 space-y-2">
        @foreach($members as $member)
            <div class="flex items-center justify-between gap-2 rounded-2xl border border-white/10 bg-zinc-900/70 px-3 py-2">
                <div class="min-w-0">
                    <span class="block text-sm text-white">{{ $member->username ?? $member->name }}</span>
                    <span class="rounded-full bg-violet-500/10 px-2 py-1 text-xs uppercase tracking-wide text-violet-300">
                        {{ $member->pivot->role ?? 'member' }}
                    </span>
                    @if($member->pivot->is_banned)
                        <span class="ml-2 rounded-full bg-rose-500/10 px-2 py-1 text-[10px] uppercase tracking-wide text-rose-300">
                            banned
                        </span>
                    @endif
                </div>

                @if($canModerate)
                    <div class="flex shrink-0 items-center gap-2">
                        <a href="{{ route('profile', $member) }}" class="rounded-full border border-cyan-400/20 px-2 py-1 text-xs text-cyan-300 hover:bg-cyan-500/10">
                            Ver
                        </a>
                        <button wire:click="kickMember({{ $member->id }})" class="rounded-full border border-amber-400/20 px-2 py-1 text-xs text-amber-300 hover:bg-amber-500/10">
                            Expulsar
                        </button>
                        <button wire:click="banMember({{ $member->id }})" class="rounded-full border border-rose-400/20 px-2 py-1 text-xs text-rose-300 hover:bg-rose-500/10">
                            Banear
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
