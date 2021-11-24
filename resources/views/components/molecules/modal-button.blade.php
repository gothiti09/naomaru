@props([
    'action' => '',
    'method' => 'POST',
    'validate' => 'true',
    'color' => 'primary',
    'confirmTitle' => '保存しますか？',
    'confirmText' => '',
    'buttonName' => '登録する',
])
<div class="flex flex-col justify-stretch" x-cloak x-data="{ isOpen: false }">
    <x-atoms.button-primary
        @click="'{{ $validate }}' === 'true' ? (document.forms['form'].reportValidity() ? isOpen = !isOpen : null) : isOpen = !isOpen"
        color="{{ $color }}" size="xl" round="true">
        {{ $buttonName }}
    </x-atoms.button-primary>
    <div x-show="isOpen" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="isOpen" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="isOpen" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-{{ $color }}-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-{{ $color }}-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            {{ $confirmTitle }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                {{ $confirmText }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="my-6 flex flex-col justify-stretch space-y-4 sm:justify-center sm:space-y-0 space-x-2 sm:space-x-reverse sm:flex-row-reverse">
                    <x-atoms.button-primary type="button" @click="isOpen = !isOpen" class="submit"
                        data-action="{{ $action }}" data-method="{{ $method }}"
                        data-validate="{{ $validate }}" color="{{ $color }}">
                        {{ $buttonName }}
                    </x-atoms.button-primary>
                    <x-atoms.button-outline type="button" @click="isOpen = !isOpen" color="gray">
                        キャンセル
                    </x-atoms.button-outline>
                </div>
            </div>
        </div>
    </div>
</div>
