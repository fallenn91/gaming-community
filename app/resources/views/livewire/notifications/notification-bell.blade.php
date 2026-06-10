<div class="relative" x-data="{ open: false }" wire:poll.15s="refreshCount">
    <button
      @click="open = !open"
      class="relative p-2"  
    >
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hover:text-[#a78bfa] size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
      </svg>

      @if ($unreadCount > 0)
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-semibold rounded-full w-5 h-5 flex items-center justify-center">
          {{ $unreadCount > 9 ? '9+' : $unreadCount }}
        </span>
      @endif

    </button>

    <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg z-50">
      <livewire:notifications.notification-list />
    </div>
</div>
