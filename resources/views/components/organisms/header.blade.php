<div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
    <button type="button" @click="isOpenOffCanvasMenu = true"
        class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500 md:hidden">
        <span class="sr-only">Open sidebar</span>
        <!-- Heroicon name: outline/menu-alt-2 -->
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
        </svg>
    </button>
    <div class="flex-1 px-4 flex justify-between">
        <div class="flex-1 flex">
        </div>
        <div class="ml-4 flex items-center md:ml-6">

            <livewire:notification />

            <!-- Profile dropdown -->
            <div x-cloak x-data="{ isOpen: false }" class="ml-3 relative">
                <button type="button" @click="isOpen = !isOpen" id="user-menu-button" aria-expanded="false"
                    aria-haspopup="true">
                    <span class="sr-only">Open user menu</span>
                    <span class="inline-block h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </span>
                </button>
                <div x-show="isOpen" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <!-- Active: "bg-gray-100", Not Active: "" -->
                    <a href="/setting-visitation" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        role="menuitem" tabindex="-1" id="user-menu-item-0">面会交流設定</a>
                    <a href="/message" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                        tabindex="-1" id="user-menu-item-0">緊急連絡</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                            tabindex="-1" id="user-menu-item-2"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            ログアウト
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
