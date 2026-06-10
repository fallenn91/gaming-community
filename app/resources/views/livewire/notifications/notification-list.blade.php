<div class="p-4">
    <div class="flex jusitfy-center items-center mb-3 gap-2">
      <h3 class="font-semibold text-sm text-[#100828]">Notifications</h3>
      <button wire:click="markAllAsRead" class="text-xs text-[#6246ea] hover:text-[#d946ef]">
        Mark All As Read
      </button>
    </div>

    <div class="flex flex-col gap-1">
      @forelse ($notifications as $notification)
      <div wire:click="markAsRead('{{ $notification->id }}')"
        class="flex items-start gap-3 p-2 rounded-lg cursor-pointer hover:bg-gray-50
        {{ $notification->read_at ? 'opacity-60' : 'bg-blue-50' }} ">

        <div class="shrink-0 w-8 h-8 rounded-full bg-[#6366f1] flex items-center justify-center text-xs font-bold">
          {{ strtoupper(substr($notification->data['follower_username'] ?? '?', 0 , 1)) }}
        </div>
        
        <div class="flex flex-col min-w-0">
          <span class="text-sm font-medium text-[#100828] truncate">
            {{ $notification->data['title'] ?? '' }}
          </span>
          <span class="text-xs text-gray-500 truncate">
            {{ $notification->data['message'] ?? '' }}
          </span>
          <span class="text-xs text-gray-500 truncate">
            {{ $notification->created_at->diffForHumans() }}
          </span>

          @if (!$notification->readt_at)
            <div class="shrink-0 w-2 h-2 bg-blue-500 rounded-full mt-1.5"></div>
          @endif
        </div>

      </div>
      @empty
        <p class="text-sm text-gray-400 text-center py-6">
            No tienes notificaciones
        </p>
      @endforelse
    </div>
</div>
