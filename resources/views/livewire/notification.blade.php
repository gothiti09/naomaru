<div x-cloak x-data="{ isOpen: false }" class="ml-3 relative">
    <div>
        <button type="button" @click="isOpen = !isOpen"
            class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            <span class="sr-only">View notifications</span>
            <!-- Heroicon name: outline/bell -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            @if ($unreadNotifications->count())
                <span class="animate-ping absolute inline-flex top-1 right-1 h-2 w-2 rounded-full bg-red-500 opacity-75"></span>
                <span class="absolute inline-flex top-1 right-1 h-2 w-2 rounded-full bg-red-500"></span>
            @endif
        </button>
    </div>
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="origin-top-right absolute right-0 mt-2 w-72 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

        @foreach ($notifications as $notification)
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1"
                id="user-menu-item-0" wire:click="read('{{ $notification->uuid }}')">
                <div class="flex x-space-2">
                    <p>
                        {{ $notification->data['text'] }}
                    </p>
                    @if (!$notification->read_at)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            NEW
                        </span>
                    @endif
                </div>
                <span class="text-xs text-gray-500">{{ $notification->created_at->format('Y/m/d H:i:s') }}</span>
            </a>
        @endforeach
    </div>
</div>
