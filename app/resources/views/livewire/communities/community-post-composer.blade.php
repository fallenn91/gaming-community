<div class="rounded-3xl border border-white/10 bg-black/20 p-5">
    <h3 class="text-lg font-semibold text-white">Create a community post</h3>
    <textarea wire:model.defer="body" rows="3" class="mt-3 w-full rounded-2xl border border-white/10 bg-zinc-900/80 p-3 text-sm text-white" placeholder="Share something with your community..."></textarea>
    <div class="mt-3 flex justify-end">
        <button wire:click="publish" class="rounded-full bg-cyan-500/20 px-4 py-2 text-sm font-medium text-cyan-300 hover:bg-cyan-500/30">
            Publish
        </button>
    </div>
</div>
